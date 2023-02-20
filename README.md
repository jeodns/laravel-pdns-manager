# Laravel Recording
 
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]][link-license]
[![Testing status][ico-workflow-test]][link-workflow-test]
 
## Introduction 

This package will help you for manage DNS zones and records.
* Features include: 
   * Zone Management 
   * Record Management 
   * Server Management 
* Latest versions of PHP and PHPUnit and PHPCsFixer
* Best practices applied:
  * [`README.md`][link-readme] (badges included)
  * [`LICENSE`][link-license]
  * [`composer.json`][link-composer-json]
  * [`phpunit.xml`][link-phpunit]
  * [`.gitignore`][link-gitignore]
  * [`.php-cs-fixer.php`][link-phpcsfixer]

## Installation

Require this package with composer.

```shell
composer require jeodns/laravel-pdns-manager
```

Laravel uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.

## Working With Zones:

Create new zone:

```php
use Jeodns\PDNSManager\Contracts\IZoneManager;
use Jeodns\PDNSManager\Contracts\Zone\Status;

$zoneManager = app(IZoneManager::class);

 /**
 * @param  string $name
 * @param  Status $status
 * @return IZone
 */

$zone = $zoneManager->add(
  name: 'domain.com',
  status: Status::ACTIVE,
);

```

Show zone:

```php
use Jeodns\PDNSManager\Contracts\IZoneManager;

$zoneManager = app(IZoneManager::class);

/**
 * @param  int $id
 * @return IZone
 */
$zone = $zoneManager->getByID(id:1);

```

Update zone:

```php
use Jeodns\PDNSManager\Contracts\IZone;
use Jeodns\PDNSManager\Contracts\IZoneManager;
use Jeodns\PDNSManager\Contracts\Zone\Status;

$zoneManager = app(IZoneManager::class);

/**
 * @param  int                                $id
 * @param  array{name?:string,status?:Status} $changes
 * @return IZone
 */
$zone = $zoneManager->update(
  id: 1,
  changes: [
    'name' => 'new-domain.com',
    'status' => Status::DEACTIVE,
  ],
);

```

Delete zone:

```php
use Jeodns\PDNSManager\Contracts\IZone;
use Jeodns\PDNSManager\Contracts\IZoneManager;

$zoneManager = app(IZoneManager::class);

/**
 * @param int $id
 * @return IZone deleted zone
 */
$zone = $zoneManager->delete(id: 1);

```

***

## Working With Records:

Create new zone record:

```php
use Jeodns\PDNSManager\IRecord;
use Jeodns\PDNSManager\IRecordManager;
use Jeodns\PDNSManager\Record\Status;
use Jeodns\PDNSManager\Record\Type;

$recordManager = app(IRecordManager::class);

/**
 * @param  int    $zoneID
 * @param  string $name
 * @param  Type   $type
 * @param  int    $ttl base on second
 * @param  bool   $geobase
 * @param  Status $status
 * @return IRecord
 */
$record = $recordManager->add(
  zoneID: 1,  
  name: 'ns1',
  type: Type::NS,
  ttl: 30,
  geobase: false,
  status: Status::ACTIVE,
);

```

Show record:
```php
use Jeodns\PDNSManager\IRecord;
use Jeodns\PDNSManager\IRecordManager;

$recordManager = app(IRecordManager::class);

/**
 * @param  int $id
 * @return IRecord
 */
$record = $recordManager->getByID(id:1);

```

Update record :

```php
use Jeodns\PDNSManager\IRecord;
use Jeodns\PDNSManager\IRecordManager;
use Jeodns\PDNSManager\Record\Status;
use Jeodns\PDNSManager\Record\Type;

$recordManager = app(IRecordManager::class);

/**
 * @param  int                                                                  $id
 * @param  array{type?:Type,name?:string,ttl?:int,geobase?:bool,status?:Status} $changes
 * @return IRecord
 */
$record = $recordManager->update(
  id: 1,
  changes: [
    'type' => Type::A,
  ],
);

```

Delete record :

```php
use Jeodns\PDNSManager\IRecord;
use Jeodns\PDNSManager\IRecordManager;

$recordManager = app(IRecordManager::class);

/**
 * @param  int $id
 * @return IRecord deleted record
 */
$record = $recordManager->delete(id:1);

```

***

## Working With Record Data:

Create new record data :
***

```php
use Jeodns\PDNSManager\Contracts\Record\Data\Status;
use Jeodns\PDNSManager\Contracts\Record\IData;
use Jeodns\PDNSManager\Contracts\Record\IDataManager;

$dataManager = app(IDataManager::class);

/**
 * @param int      $recordID
 * @param int      $weight
 * @param int      $priority
 * @param int      $locationID
 * @param string[] $content
 * @param Status   $status
 */
$data = $dataManager->add(
  recordId: 1,
  weight: 1,
  priority: 1,
  locationID: 1,
  content: ['127.0.0.1', '127.0.0.2'],
  status: Status::ACTIVE,
);

```

Show record data:
***

```php
use Jeodns\PDNSManager\Contracts\Record\IData;
use Jeodns\PDNSManager\Contracts\Record\IDataManager;

$dataManager = app(IDataManager::class);

/**
 * @param  int id
 * @return IData
 */
$data = $dataManager->getByID(id:4);

```

Update record data:
***

```php
use Jeodns\PDNSManager\Contracts\Record\Data\Status;
use Jeodns\PDNSManager\Contracts\Record\IData;
use Jeodns\PDNSManager\Contracts\Record\IDataManager;

$dataManager = app(IDataManager::class);

/**
 * @param  int                                                                               $id
 * @param  array{weight?:int,priority?:int,location_id?:int,content?:Content,status?:Status} $changes
 * @return IData
 */
$data = $dataManager->update(
  id: 1,
  changes: [
    'content' => ['192.168.1.1', '192.168.2.1'],
    'status' => Status::DEACTIVE,
  ],
);

```

Delete record data:

```php
use Jeodns\PDNSManager\Contracts\Record\IData;
use Jeodns\PDNSManager\Contracts\Record\IDataManager;

$dataManager = app(IDataManager::class);

/**
 * @param  int $id
 * @return IData
 */
$data = $dataManager->delete(id:1);

```

***

## Working With Servers:

Create new server:

***

```php
use Jeodns\PDNSManager\Contracts\IServer;
use Jeodns\PDNSManager\Contracts\IServerManager;

$serverManager = app(IServerManager::class);

/**
 * @param  int      $recordID
 * @param  int      $weight
 * @param  int      $priority
 * @param  int      $locationID
 * @param  string[] $content
 * @param  Status   $status
 * @return IServer
 */
$server = $serverManager->add(
  title: 'ns1.domain.com',
  type: Foo::class,
  connectionArgs: [
    'hostname' => '192.168.1.1',
    'password' => 'PASSWORD',
  ],
);

```

Show server:

***

```php
use Jeodns\PDNSManager\Contracts\IServer;
use Jeodns\PDNSManager\Contracts\IServerManager;

$serverManager = app(IServerManager::class);

/**
 * @param  int  $id
 * @return IServer
 */
$server = $serverManager->getByID(id: 1);

```

Reload server Config Zone file:

***

```php
use dnj\Filesystem\Local\File;
use Jeodns\PDNSManager\Contracts\IPowerDNSManager;
use Jeodns\PDNSManager\Contracts\IServerManager;

$serverManager = app(IServerManager::class);
$powerDNSManager = app(IPowerDNSManager::class);

/**
 * @param  File  $file
 * @return void
 */
$serverManager->reload(file: $powerDNSManager->generateConfigYaml());

```

Update server:

***

```php
use Jeodns\PDNSManager\Contracts\IServer;
use Jeodns\PDNSManager\Contracts\IServerManager;

$serverManager = app(IServerManager::class);

/**
 * @param  int      $recordID
 * @param  int      $weight
 * @param  int      $priority
 * @param  int      $locationID
 * @param  string[] $content
 * @param  Status   $status
 * @return IServer
 */
$server = $serverManager->update(
  id: 1,
  changes: [
    'title': 'ns2.domain.com',
    'type': Foo2::class,
    'connectionArgs': [
      'hostname' => '192.168.1.1',
      'password' => 'PASSWORD',
    ],
  ],
);

```
***

## Working With PowerDNS:

Get Config Yaml file:

***

```php
use Jeodns\PDNSManager\Contracts\IPowerDNSManager;
use dnj\Filesystem\Local\File;

$powerDNSManager = app(IPowerDNSManager::class);

/**
 * @param  int  $id
 * @return File
 */
$file = $powerDNSManager->generateConfigYaml();

```

Reload server config file:

***

```php
use Jeodns\PDNSManager\Contracts\IPowerDNSManager;
use dnj\Filesystem\Local\File;

$powerDNSManager = app(IPowerDNSManager::class);

/**
 * @param  int  $id
 * @return void
 */
$powerDNSManager->reload(serverID: 1);

```

Reload All servers config file:

***

```php
use Jeodns\PDNSManager\Contracts\IPowerDNSManager;
use dnj\Filesystem\Local\File;

$powerDNSManager = app(IPowerDNSManager::class);

/**
 * @return void
 */
$powerDNSManager->reloadAll();

```

## Contribution

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are greatly appreciated.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement". Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request


## Security
If you discover any security-related issues, please email [security@jeodns.com](mailto:security@jeodns.com) instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File][link-license] for more information.


[ico-version]: https://img.shields.io/packagist/v/jeodns/laravel-pdns-manager.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/jeodns/laravel-pdns-manager.svg?style=flat-square
[ico-workflow-test]: https://github.com/jeodns/laravel-pdns-manager/actions/workflows/ci.yml/badge.svg

[link-workflow-test]: https://github.com/jeodns/laravel-pdns-manager/actions/workflows/ci.yml
[link-packagist]: https://packagist.org/packages/jeodns/laravel-pdns-manager
[link-license]: https://github.com/jeodns/laravel-pdns-manager/blob/master/LICENSE
[link-downloads]: https://packagist.org/packages/jeodns/laravel-pdns-manager
[link-readme]: https://github.com/jeodns/laravel-pdns-manager/blob/master/README.md
[link-docs]: https://github.com/jeodns/laravel-pdns-manager/blob/master/docs/openapi.yaml
[link-composer-json]: https://github.com/jeodns/laravel-pdns-manager/blob/master/composer.json
[link-phpunit]: https://github.com/jeodns/laravel-pdns-manager/blob/master/phpunit.xml
[link-gitignore]: https://github.com/jeodns/laravel-pdns-manager/blob/master/.gitignore
[link-phpcsfixer]: https://github.com/jeodns/laravel-pdns-manager/blob/master/.php-cs-fixer.php
[link-author]: https://github.com/dnj
