<?php

namespace Jeodns\PDNSManager\Tests\Feature;

use Jeodns\Models\Server;
use Jeodns\PDNSManager\Contracts\IServerConnection;
use Jeodns\PDNSManager\Contracts\IServerManager;
use Jeodns\PDNSManager\Exceptions\Exception;
use Jeodns\PDNSManager\ServerManager;
use Jeodns\PDNSManager\Tests\TestCase;

class ServerManagerTest extends TestCase
{
    public function testCreate(): void
    {
        $server = $this->getManager()->add(
            title: 'ca-s3',
            type: ServerManagerTest::class,
            connectionArgs: [
                'hostname' => 'hostname',
                'password' => 'password',
            ],
        );

        $this->assertInstanceOf(Server::class, $server);
    }

    public function testGetByID(): void
    {
        $server = Server::factory()->create();
        $serverCopy = $this->getManager()->getByID($server->getID());

        $this->assertTrue(
            $server->getID() == $serverCopy->getID() and
            $server->getType() == $serverCopy->getType() and
            $server->getTitle() == $serverCopy->getTitle() and
            $server->getConnectionArgs() == $serverCopy->getConnectionArgs() and
            $server->getStatus() == $serverCopy->getStatus()
        );
    }

    public function testGetByIDWithException(): void
    {
        $this->expectException(Exception::class);

        $server = $this->getManager()->getByID(2);
    }

    public function testUpdate(): void
    {
        $server = Server::factory()->create();

        $updatedServer = $this->getManager()->update(
            id: $server->getID(),
            changes: [
                'title' => 'US-s3',
                'connectionArgs' => [
                    'api' => 'api',
                    'token' => 'token',
                ],
            ],
        );

        $this->assertTrue(
            $server->getID() == $updatedServer->getID() and
            'US-s3' == $updatedServer->getTitle()
        );
    }

    public function testUpdateWithException(): void
    {
        $this->expectException(Exception::class);

        $server = Server::factory()->create();

        $updatedServer = $this->getManager()->update(
            id: $server->getID(),
            changes: [
                'name' => 'US-s3',
            ],
        );
    }

    public function testDelete(): void
    {
        $server = Server::factory()->create();

        $this->getManager()->delete($server->getID());

        $this->assertDatabaseMissing(Server::class, [
            'id' => $server->getID(),
        ]);
    }

    protected function getManager(): ServerManager
    {
        if (!$this->app) {
            throw new \Exception('App is not defined.');
        }

        $this->app->singleton(IServerConnection::class, fn () => $this->createMock(IServerConnection::class));

        return $this->app->make(IServerManager::class);
    }
}
