#!/bin/sh

set -eux
sed -i -e 's/v[[:digit:]]\..*\//edge\//g' '/etc/apk/repositories'
printf '%s\n' 'http://dl-cdn.alpinelinux.org/alpine/edge/testing' >> /etc/apk/repositories
apk update
cd 'vendor/apks/'
xargs -a 'apks.txt' -- apk fetch -R -o . --
xargs -a 'apks.txt' -- apk dot -- > apk.dot
xargs -I '{}' -a 'apks.txt' -- find -name '{}-*.apk' > apks_versioned.txt
