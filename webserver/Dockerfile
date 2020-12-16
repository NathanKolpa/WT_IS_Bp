FROM php:7.4.13-cli-alpine3.12
VOLUME /srv/webserver
COPY ./provision.sh /root/
COPY vendor "${TMPDIR:-/tmp/}"/vendor
RUN /root/provision.sh
WORKDIR /srv/webserver/
ENV PATH "$PATH:/opt/mssql-tools/bin/"
