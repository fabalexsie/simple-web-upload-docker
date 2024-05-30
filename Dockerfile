FROM richarvey/nginx-php-fpm:latest
ENV PHP_UPLOAD_MAX_FILESIZE 10000
ENV PHP_POST_MAX_SIZE 10000
ENV PHP_MEM_LIMIT 10000
ENV RUN_SCRIPTS 1

ARG HOSTIP
ENV HOSTIP=${HOSTIP}

WORKDIR /app
RUN curl -JLO "https://dl.filippo.io/mkcert/latest?for=linux/amd64"
RUN chmod +x mkcert-v*-linux-amd64
RUN cp mkcert-v*-linux-amd64 /usr/local/bin/mkcert

WORKDIR /var/www/html
RUN mkdir -p /var/www/html/uploads
COPY nginx.conf /etc/nginx/
COPY ssl.conf /etc/nginx/sites-enabled/

COPY src/ /var/www/html/
COPY start.sh /app/

CMD ["/app/start.sh"]
