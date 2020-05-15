FROM php:7.4.5-cli-alpine3.11
VOLUME /srv/webserver
COPY ./provision.sh /root/
RUN /root/provision.sh
WORKDIR /srv/webserver/
