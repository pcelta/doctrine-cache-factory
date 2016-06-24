# Cache Service Provider
[![Build Status](https://img.shields.io/travis/pcelta/doctrine-cache-factory/master.svg?style=flat-square)](https://travis-ci.org/pcelta/doctrine-cache-factory)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/pcelta/doctrine-cache-factory/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/pcelta/doctrine-cache-factory/?branch=master)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/pcelta/doctrine-cache-factory/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/pcelta/doctrine-cache-factory/?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/pcelta/doctrine-cache-factory.svg?style=flat-square)](https://packagist.org/packages/pcelta/doctrine-cache-factory)
[![Total Downloads](https://img.shields.io/packagist/dt/pcelta/doctrine-cache-factory.svg?style=flat-square)](https://packagist.org/packages/pcelta/doctrine-cache-factory)
[![License](https://img.shields.io/packagist/l/pcelta/doctrine-cache-factory.svg?style=flat-square)](https://packagist.org/packages/pcelta/doctrine-cache-factory)

# doctrine-cache-factory
Doctrine Cache Factory it's better way to uncouple your application of the cache adapters. Changing the configuration only the factory will load a difference client.

## Instalation

```json
{
    "require": {
        "pcelta/doctrine-cache-factory": "dev-master"
    }
}
```

## Adapters Availables

- Custom
- Array
- Memcache
- Memcached
- Redis


## Write your own adapter
Use the adapter namespace to specify the location of your adapter.
```php

use Pcelta\Doctrine\Cache\Factory;

$factory = new Factory();
$cacheSettings [
    'adapter'           => 'Memcache',
    'adapter_namespace' => '\Doctrine\Common\Cache\%sCache',
    'host'              => '127.0.0.1',
    'port'              => 11211,
];

$cacheProvider = $factory->create($cacheSettings);

```


## How to use Array

```php

use Pcelta\Doctrine\Cache\Factory;

$factory = new Factory();
$cacheSettings [
    'adapter'       => 'Array',
];

$cacheProvider = $factory->create($cacheSettings);

```


## How to use Memcache

Install php5-memcache

~~~
sudo apt-get install php5-memcache

~~~

```php

use Pcelta\Doctrine\Cache\Factory;

$factory = new Factory();
$cacheSettings [
    'adapter_name' => 'Memcache',
    'host'         => '127.0.0.1',
    'port'         => 11211,
];

$cacheProvider = $factory->create($cacheSettings);

```


## How to use Memcached

Install php5-memcached

~~~
sudo apt-get install php5-memcached

~~~


```php

use Pcelta\Doctrine\Cache\Factory;

$factory = new Factory();
$cacheSettings [
    'adapter_name' => 'Memcached',
    'host'         => '127.0.0.1',
    'port'         => 11211,
];

$cacheProvider = $factory->create($cacheSettings);

```


## How to use Redis

install [PHPRedis](https://github.com/phpredis/phpredis)

~~~
git clone git@github.com:phpredis/phpredis.git
cd phpredis
phpize
./configure
make && make install
~~~


```php

use Pcelta\Doctrine\Cache\Factory;

$factory = new Factory();
$cacheSettings [
    'adapter_name' => 'Redis',
    'host'         => '127.0.0.1',
    'port'         => 11211,
];

$cacheProvider = $factory->create($cacheSettings);

```

## General Usage

```php

use Pcelta\Doctrine\Cache\Factory;

$factory = new Factory();
$cacheSettings [
    'adapter_name' => 'Memcache',
    'host'         => '127.0.0.1',
    'port'         => 11211,
];

$cacheProvider = $factory->create($cacheSettings);

$cacheProvider->save('your-key', 'your-data');
$data = $cacheProvider->fetch('your-key');

echo $data; // your-data

```


## Comparing Doctrine Cache Factory with Doctrine Cache Pure

# [Doctrine Cache](http://doctrine-orm.readthedocs.org/en/latest/reference/caching.html)

```php

$memcache = new Memcache(); // it's bad to uncouple
$memcache->connect('memcache_host', 11211);

$cacheDriver = new \Doctrine\Common\Cache\MemcacheCache();
$cacheDriver->setMemcache($memcache);
$cacheDriver->save('cache_id', 'my_data');

```


# [Doctrine Cache Factory](https://github.com/pcelta/doctrine-cache-factory)

```php

$factory = new \Pcelta\Doctrine\Cache\Factory();
$cacheSettings [
    'adapter_name' => 'Memcache', // very better
    'host'         => '127.0.0.1',
    'port'         => 11211,
];

$cacheProvider = $factory->create($cacheSettings); 
$cacheProvider->save('cache_id', 'your-data');

```

## Road Map

- Couchbase

## License

MIT License
