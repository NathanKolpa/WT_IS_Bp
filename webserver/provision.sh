#!/bin/sh
apt-get update
apt install curl apt-transport-https wget git lsb-release gnupg2 -y

curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
curl https://packages.microsoft.com/config/debian/10/prod.list > /etc/apt/sources.list.d/mssql-release.list
apt-get update

ACCEPT_EULA=Y apt-get install -y msodbcsql17
# optional: for bcp and sqlcmd
ACCEPT_EULA=Y apt-get install -y mssql-tools
echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bashrc
# optional: for unixODBC development headers
apt-get install -y unixodbc-dev unixodbc
# optional: kerberos library for debian-slim distributions
apt-get install -y libgssapi-krb5-2

wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list
apt-get update
apt-get install -y php8.0 php8.0-dev php8.0-xml php8.0-intl php8.0-curl php8.0-mbstring php8.0-xdebug

# very obscure hack, but pecl searches for sed in /usr/bin/sed instead of /sed
ln -s /bin/sed /usr/bin/sed
sed -i 's/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/g' /etc/locale.gen
locale-gen


pecl install sqlsrv
pecl install pdo_sqlsrv
printf "; priority=20\nextension=sqlsrv.so\n" > /etc/php/8.0/mods-available/sqlsrv.ini
printf "; priority=30\nextension=pdo_sqlsrv.so\n" > /etc/php/8.0/mods-available/pdo_sqlsrv.ini
phpenmod -v 8.0 sqlsrv pdo_sqlsrv

cp /root/php.ini /etc/php/8.0/cli/
cat /root/docker-php-ext-xdebug.ini >> /etc/php/8.0/cli/conf.d/20-xdebug.ini
cp /root/security.ini /etc/php/8.0/cli/conf.d/
pecl config-set php_ini /etc/php/8.0/cli/php.ini

wget -O phive.phar https://phar.io/releases/phive.phar
wget -O phive.phar.asc https://phar.io/releases/phive.phar.asc
gpg --keyserver hkps://keys.openpgp.org --recv-keys 0x9D8A98B29B2D5D79
gpg --verify phive.phar.asc phive.phar
chmod +x phive.phar
mv phive.phar /usr/local/bin/phive
cd /root

phive install php-cs-fixer --trust-gpg-keys E82B2FB314E9906E -g
phive install phpcbf --trust-gpg-keys 31C7E470E2138192 -g
phive install phpcs -g
phive install phpmd --trust-gpg-keys 0F9684B8B16B7AB0 -g
phive install phpstan --trust-gpg-keys CF1A108D0E7AE720 -g


# # node js
cd /root
curl -sL https://deb.nodesource.com/setup_12.x -o nodesource_setup.sh
chmod +x ./nodesource_setup.sh
./nodesource_setup.sh
apt-get update
apt-get -y install nodejs
node -v
npm install -g 'hint' 'prettier' 'stylelint' 'stylelint-config-standard' 'stylelint-no-unsupported-browser-features'
