#!/bin/sh
set -eux
cd -- "${TMPDIR:-/tmp/}/vendor/apks/"
apk add --repositories-file='/dev/null' --allow-untrusted --no-cache --no-network -- *.apk
cd ..
# Installeer SQL Server ODBC-drivers en tools (nodig voor de sqlsrv driver).
yes | apk add --repositories-file=/dev/null --allow-untrusted --no-network --no-cache 'msodbcsql17_17.6.1.1-1_amd64.apk'
yes | apk add --repositories-file=/dev/null --allow-untrusted --no-network --no-cache 'mssql-tools_17.6.1.1-1_amd64.apk'
# Installeer NodeJS-afhankelijke tools
npm install -g 'npm'
npm install -g 'hint' 'prettier' 'stylelint' 'stylelint-config-standard' 'stylelint-no-unsupported-browser-features'
# Installeer PHP-tools
mv 'php-cs-fixer.phar' '/usr/local/bin/php-cs-fixer'
mv 'phpcbf.phar' '/usr/local/bin/phpcbf'
mv 'phpcs.phar' '/usr/local/bin/phpcs'
mv 'phpmd.phar' '/usr/local/bin/phpmd'
mv 'phpstan.phar' '/usr/local/bin/phpstan'
php -i
cd /root/
cp 'php.ini' '/usr/local/etc/php/'
pecl config-set php_ini '/usr/local/etc/php/php.ini'
cp 'docker-php-ext-xdebug.ini' 'security.ini' '/usr/local/etc/php/conf.d/'
cd "${TMPDIR:-/tmp/}/vendor/"
# Procedurele sqlsrv. Zet alleen aan voor debugging.
#pecl install 'sqlsrv-5.9.0beta2'
#docker-php-ext-enable 'sqlsrv'
cd 'pdo_sqlsrv-5.9.0beta2/pdo_sqlsrv-5.9.0beta2/'
phpize
./configure
make
make install
cd -
docker-php-ext-enable 'pdo_sqlsrv'
