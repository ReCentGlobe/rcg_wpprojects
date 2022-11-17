FROM nginx:latest
COPY /docker/vhost.conf /etc/nginx/conf.d/default.conf
COPY /docker/nginx.conf /etc/nginx/nginx.conf