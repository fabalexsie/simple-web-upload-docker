LABEL org.opencontainers.image.title="Simple Web Upload Docker"
LABEL org.opencontainers.image.source=https://github.com/fabalexsie/simple-web-upload-docker
LABEL org.opencontainers.image.authors="fabalexsie"
LABEL org.opencontainers.image.description="Spin up a simple web upload server with Docker to receive files on your local machine via a web interface."

FROM richarvey/nginx-php-fpm:latest
ENV PHP_UPLOAD_MAX_FILESIZE 10000
ENV PHP_POST_MAX_SIZE 10000
ENV PHP_MEM_LIMIT 10000

ARG HOSTIP
ENV HOSTIP=${HOSTIP}

WORKDIR /app
RUN curl -JLO "https://dl.filippo.io/mkcert/latest?for=linux/amd64"
RUN chmod +x mkcert-v*-linux-amd64
RUN cp mkcert-v*-linux-amd64 /usr/local/bin/mkcert

VOLUME /etc/nginx/ssl
WORKDIR /var/www/html
RUN mkdir -p /var/www/html/uploads
COPY nginx.conf /etc/nginx/
COPY ssl.conf /etc/nginx/sites-enabled/

COPY src/ /var/www/html/
COPY start.sh /app/
RUN chmod +x /app/start.sh

CMD ["/app/start.sh"]
