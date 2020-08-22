FROM nginx:1.19-alpine as base

COPY ./infrastructure/docker/nginx/conf.d/sites-enabled/* /etc/nginx/conf.d/
COPY ./app/public /var/www/app/public

FROM base as development

FROM base as production


