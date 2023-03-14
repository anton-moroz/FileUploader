ARG NGINX_VERSION

FROM nginx:${NGINX_VERSION}

RUN apt-get update

COPY infrastructure/docker/nginx/default.conf /etc/nginx/conf.d/default.conf

