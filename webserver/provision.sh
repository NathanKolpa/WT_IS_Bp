#!/bin/sh

set -eux

sed -i -e 's/v[[:digit:]]\..*\//edge\//g' '/etc/apk/repositories'
printf '%s\n' 'http://dl-cdn.alpinelinux.org/alpine/edge/testing' >>/etc/apk/repositories
apk update
apk add --no-cache 'git' 'nodejs-current' 'npm'
npm install -g 'npm'
npm install -g 'hint' 'prettier' 'stylelint' 'stylelint-config-standard' 'stylelint-no-unsupported-browser-features'

cd -- "${TMPDIR:-/tmp/}/vendor/"

mv 'php-cs-fixer.phar' '/usr/local/bin/php-cs-fixer'
mv 'phpcbf.phar' '/usr/local/bin/phpcbf'
mv 'phpcs.phar' '/usr/local/bin/phpcs'
mv 'phpmd.phar' '/usr/local/bin/phpmd'
mv 'phpstan.phar' '/usr/local/bin/phpstan'

# Install SQL Server ODBC drivers and tools (required for the sqlsrv driver).
yes | apk add --allow-untrusted 'msodbcsql17_17.6.1.1-1_amd64.apk'
yes | apk add --allow-untrusted 'mssql-tools_17.6.1.1-1_amd64.apk'

cd -

apk add --no-cache 'php7' 'php7-dev' 'php7-pear' 'php7-pecl-xdebug' 'php7-pdo' 'php7-openssl' 'autoconf' 'make' 'g++' 'unixodbc-dev' 'openjdk11-jre-headless' 'shellcheck'

php -i
cp '/usr/local/etc/php/php.ini-development' '/usr/local/etc/php/php.ini'
pecl config-set php_ini '/usr/local/etc/php/php.ini'

# Procedural sqlsrv. Enable for debugging only.
#pecl install 'sqlsrv-5.9.0beta2'
#docker-php-ext-enable 'sqlsrv'

cd -- "${TMPDIR:-/tmp/}"'/vendor/pdo_sqlsrv-5.9.0beta2/pdo_sqlsrv-5.9.0beta2/'
phpize
./configure
make
make install
cd -

docker-php-ext-enable 'pdo_sqlsrv'

printf '%s\n' 'file_uploads = Off
allow_url_fopen = Off

[Session]
session.use_strict_mode = On
session.use_cookies = On
session.use_only_cookies = On
session.cache_limiter = nocache
session.cookie_httponly = On
session.cookie_samesite = "Strict"
session.use_trans_sid = Off
' >>/usr/local/etc/php/conf.d/security.ini

printf '%s\n' '[XDebug]
xdebug.remote_enable = 1
xdebug.remote_autostart = 1
# Required to extend beyond localhost, because of Docker networking.
xdebug.remote_host = "0.0.0.0"
' >>/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

printf '%s\n' '[PHP]
include_path = "/srv/webapplicatie/applicatie/:applicatie/"
' >/usr/local/etc/php/conf.d/webapplicatie.ini
