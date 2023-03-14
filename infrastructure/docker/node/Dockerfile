ARG NODE_VERSION

FROM node:${NODE_VERSION}-alpine

RUN apk update --no-cache

WORKDIR /var/www/html

RUN rm -rf /var/cache/apk/*
