FROM nginx:alpine

RUN rm -rf /var/www/*
COPY ./site /var/www

# Configuring nginx
COPY ./nginx.conf /etc/nginx/conf.d/default.conf
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]