<?php

namespace Jeodns\PDNSManager;

use Illuminate\Support\Facades\DB;
use Jeodns\Models\Server;
use Jeodns\PDNSManager\Contracts\IServer;
use Jeodns\PDNSManager\Contracts\IServerConnection;
use Jeodns\PDNSManager\Contracts\IServerManager;
use Jeodns\PDNSManager\Contracts\Server\Status;
use Jeodns\PDNSManager\Exceptions\Exception;

/**
 * @phpstan-import-type ConnectionArgs from IServer
 */
class ServerManager implements IServerManager
{
    public IServerConnection $serverConnection;

    public function __construct(IServerConnection $serverConnection)
    {
        $this->serverConnection = $serverConnection;
    }

    public function getByID(int $id): Server
    {
        $server = Server::find($id);

        if (!$server) {
            throw new Exception('Can not find any server by id: '.$id);
        }

        return $server;
    }

    public function add(string $title, string $type, array $connectionArgs): Server
    {
        return DB::transaction(function () use ($title, $type, $connectionArgs) {
            $server = Server::create([
                'title' => $title,
                'type' => $type,
                'status' => Status::ACTIVE,
                'connectionArgs' => $connectionArgs,
            ]);

            $this->serverConnection->verifyConnection($server->getID());

            return $server;
        });
    }

    public function update(int $id, array $changes): Server
    {
        foreach ($changes as $name => $value) {
            if (!in_array($name, ['title', 'status', 'connectionArgs'])) {
                throw new Exception('Can not edit server parameter with name: '.$name);
            }
        }

        return DB::transaction(function () use ($id, $changes) {
            $server = $this->getByID($id);

            foreach ($changes as $name => $value) {
                $server->$name = $value;
            }

            $server->save();

            if (isset($changes['connectionArgs'])) {
                $this->serverConnection->verifyConnection($server->getID());
            }

            return $server;
        });
    }

    public function delete(int $id): Server
    {
        return DB::transaction(function () use ($id) {
            $server = $this->getByID($id);

            $server->delete();

            return $server;
        });
    }
}
