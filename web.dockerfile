FROM nginx:1.10

ARG APP_ENV=${APP_ENV}

ADD ./docker/$APP_ENV/vhost.conf /etc/nginx/conf.d/default.conf
ADD ./docker/gzip.conf /etc/nginx/conf.d/gzip.conf
