#! /bin/sh
if (php --version | grep -i HipHop > /dev/null); then
    echo "Skipping Memcache/Memcached installation for HHVM..."
    exit 0
fi

if (php --version | grep -i "PHP 7" > /dev/null); then
    echo "Skipping Installation Memcache/Memcached for PHP 7..."
    exit 0
fi

echo "Installing default extensions for Travis..."
echo "extension = memcached.so" >> ~/.phpenv/versions/$(phpenv version-name)/etc/php.ini
echo "extension = memcache.so" >> ~/.phpenv/versions/$(phpenv version-name)/etc/php.ini
echo "extension = redis.so" >> ~/.phpenv/versions/$(phpenv version-name)/etc/php.ini
exit 0
