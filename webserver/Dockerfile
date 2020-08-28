FROM php:7.4.6-cli-alpine3.11
VOLUME /srv/webserver
COPY ./provision.sh /root/
RUN /root/provision.sh
WORKDIR /srv/webserver/
ENV PATH "$PATH:/opt/mssql-tools/bin/"
