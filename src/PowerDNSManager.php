<?php

namespace Jeodns\PDNSManager;

use dnj\Filesystem\Local\File;
use Jeodns\Models\Record;
use Jeodns\Models\Record\Data;
use Jeodns\Models\Server;
use Jeodns\Models\Zone;
use Jeodns\PDNSManager\Contracts\IPowerDNSManager;
use Jeodns\PDNSManager\Contracts\IRecordManager;
use Jeodns\PDNSManager\Contracts\IServerConnection;
use Jeodns\PDNSManager\Contracts\IServerManager;
use Jeodns\PDNSManager\Contracts\IZoneManager;
use Jeodns\PDNSManager\Contracts\Record\Data\Status as RecordDataStatus;
use Jeodns\PDNSManager\Contracts\Record\IData;
use Jeodns\PDNSManager\Contracts\Record\IDataManager;
use Jeodns\PDNSManager\Contracts\Record\Status as RecordStatus;
use Jeodns\PDNSManager\Contracts\Record\Type;
use Jeodns\PDNSManager\Contracts\Server\Status as ServerStatus;
use Jeodns\PDNSManager\Contracts\Zone\Status as ZoneStatus;

/**
 * @phpstan-import-type Content from IData
 *
 * @phpstan-type RecordData non-empty-array<'a'|'aaaa'|'cname'|'mx'|'ns'|'ptr'|'soa'|'srv'|'txt', array{ttl: int<min, 3599>|int<3601, max>, content: string}|array{ttl?: int<min, 3599>|int<3601, max>, default: string}|string>
 */
class PowerDNSManager implements IPowerDNSManager
{
    public IZoneManager $zoneManager;
    public IRecordManager $recordManager;
    public IDataManager $dataManager;
    public IServerManager $serverManager;
    public IServerConnection $serverConnection;

    public function __construct(IZoneManager $zoneManager, IRecordManager $recordManager, IDataManager $dataManager, IServerManager $serverManager, IServerConnection $serverConnection)
    {
        $this->zoneManager = $zoneManager;
        $this->recordManager = $recordManager;
        $this->dataManager = $dataManager;
        $this->serverManager = $serverManager;
        $this->serverConnection = $serverConnection;
    }

    public function generateConfigYaml(): File
    {
        $query = Zone::where('status', ZoneStatus::ACTIVE);
        $zones = $query->get();

        $config = [
            'domains' => [],
        ];
        foreach ($zones as $zone) {
            $zoneConfig = [
                'domain' => $zone->getName(),
                'ttl' => 3600,
            ];

            $query = Record::where('zone_id', $zone->getID());
            $query->where('status', RecordStatus::ACTIVE);
            $recordItems = $query->get();

            $services = $recordItems->filter(function ($record) {
                return $record->isGeobase();
            });

            $records = $recordItems->filter(function ($record) {
                return !$record->isGeobase();
            });

            if (!$records->isEmpty()) {
                $zoneConfig['records'] = [];

                $items = [];
                foreach ($records as $record) {
                    if (!isset($zoneConfig['records'][$record->getName()])) {
                        $zoneConfig['records'][$record->getName()] = [];
                    }

                    $zoneConfig['records'][$record->getName()] = array_merge($zoneConfig['records'][$record->getName()], $this->getRecordYaml($record->getID()));
                }
            }

            if (!$services->isEmpty()) {
                $zoneConfig['services'] = [];

                foreach ($services as $record) {
                    if (!isset($zoneConfig['services'][$record->getName()])) {
                        $zoneConfig['services'][$record->getName()] = [];
                    }

                    $zoneConfig['services'][$record->getName()] = array_merge($zoneConfig['services'][$record->getName()], $this->getRecordYaml($record->getID()));
                }
            }

            $config['domains'][] = $zoneConfig;
        }

        $file = new File(__DIR__.'/../storage/private/dnsmanager.yaml');

        $directory = $file->getDirectory();
        if (!$directory->exists()) {
            $directory->make(true);
        }

        $file->write(yaml_emit($config));

        return $file;
    }

    public function reload(int $serverID): void
    {
        $server = $this->serverManager->getByID($serverID);

        $this->serverConnection->reload($server->getID(), $this->generateConfigYaml());
    }

    public function reloadAll(): void
    {
        $query = Server::where('status', ServerStatus::ACTIVE);
        $servers = $query->get();

        foreach ($servers as $server) {
            $this->serverConnection->reload($server->getID(), $this->generateConfigYaml());
        }
    }

    /**
     * @return RecordData[]
     */
    public function getRecordYaml(int $recordID): array
    {
        $record = $this->recordManager->getByID($recordID);

        $query = Data::where('status', RecordDataStatus::ACTIVE);
        $query->where('record_id', $record->getID());

        $datas = $query->get();

        $response = [];
        foreach ($datas as $data) {
            $response[] = $this->getRecordData($data->getID());
        }

        return $response;
    }

    /**
     * @return RecordData
     */
    public function getRecordData(int $recordDataID): array
    {
        $data = $this->dataManager->getByID($recordDataID);
        $record = $data->getRecord();

        $response = [];
        $value = implode(' ', $data->getContent());

        if (3600 != $record->getTTL()) {
            $response['ttl'] = $record->getTTL();
        }

        if ($record->isGeobase()) {
            $response['default'] = $value;
        } else {
            if (3600 != $record->getTTL()) {
                $response['content'] = $value;
            } else {
                $response = $value;
            }
        }

        $type = strtolower($record->getType()->value);

        return [
            $type => $response,
        ];
    }
}
