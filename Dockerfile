### main
FROM alpine:3.13.0

# packages and dev packages
RUN \
	# install required system packages
	apk add --no-cache \
		composer icu nginx openssl supervisor \
		php7-apcu php7-ctype php7-curl php7-dom php7-fileinfo php7-fpm php7-intl php7-opcache php7-pecl-amqp php7-pdo_mysql php7-pdo_pgsql \
		php7-session php7-simplexml php7-tokenizer php7-xml php7-xmlwriter

# copy configs
COPY /etc/infrastructure/php7 /etc/php7/
COPY /etc/infrastructure/nginx /etc/nginx/
COPY /etc/infrastructure/supervisor /etc/
COPY /etc/infrastructure/crontab /etc/crontabs/
COPY /etc/infrastructure/profile.sh /etc/profile.d/
COPY /etc/infrastructure/ssl /etc/ssl/

# xdebug
ARG WITH_XDEBUG=0
ARG WITH_XDEBUG_PROFILER=0
RUN if [ "$WITH_XDEBUG" = "1" ] ; then \
		apk add php7-pecl-xdebug \
    	&& sed -i -r 's/;(zend_extension=xdebug.so)/\1/' /etc/php7/conf.d/50_xdebug.ini \
    	&& if [ "$WITH_XDEBUG_PROFILER" = "1" ] ; then \
			sed -i -r 's/;(;xdebug.profiler_enable=1)/\1/' /etc/php7/conf.d/50_xdebug.ini; \
		fi; \
    fi;

# supervisord
RUN mkdir /var/log/supervisor

# user 1000
RUN addgroup -S -g 1000 user && adduser -S -u 1000 -G user user

# copy code
COPY --chown=user . /var/www/service/

# prepare var directory
RUN mkdir -p /var/www/service/var && chown 1000:1000 /var/www/service/var

# prepare local storage directory
RUN mkdir -p /tmp/local_storage && chown 1000:1000 /tmp/local_storage

WORKDIR /var/www/service
EXPOSE 80 443 9001

ENV PS1="\u@tuup-api \w \$ "

# copy entrypoint script to root path
COPY /etc/infrastructure/entrypoint.sh /

CMD ["/bin/sh", "/entrypoint.sh"]