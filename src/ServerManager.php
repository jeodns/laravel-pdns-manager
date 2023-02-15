<?php

namespace Jeodns\PDNSManager;

use dnj\Filesystem\Local\File;
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
        /** @var Server|null */
        $server = null;
        DB::beginTransaction();

        try {
            /** @var Server */
            $server = Server::create([
                'title' => $title,
                'type' => $type,
                'status' => Status::ACTIVE,
                'connectionArgs' => $connectionArgs,
            ]);

            $this->serverConnection->verifyConnection($server->getID());

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw new Exception('Can not connect to server '.$title.' with these connections args');
        }

        return $server;
    }

    public function update(int $id, array $changes): Server
    {
        $server = $this->getByID($id);

        DB::beginTransaction();

        try {
            foreach ($changes as $name => $value) {
                if (!in_array($name, ['title', 'status', 'connectionArgs'])) {
                    throw new Exception('Can not edit server parameter with name: '.$name);
                }

                $server->$name = $value;
            }

            if (isset($changes['connectionArgs'])) {
                $this->serverConnection->verifyConnection($server->getID());
            }

            $server->save();
        } catch (\Throwable $e) {
            DB::rollback();
            throw new Exception('Can not connect to server '.$server->getTitle().' with these connections args');
        }

        return $server;
    }

    public function delete(int $id): Server
    {
        $server = $this->getByID($id);

        DB::beginTransaction();

        try {
            $server->delete();
        } catch (\Throwable $t) {
            DB::rollback();

            throw $t;
        }

        return $server;
    }

    public function reload(File $file): void
    {
        $query = Server::where('status', Status::ACTIVE);
        $servers = $query->get();

        foreach ($servers as $server) {
            $this->serverConnection->reload($server->getID(), $file);
        }
    }
}
