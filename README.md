# docker-nginx-php-upload

Example execution:

```
docker run --rm -it -v "$PWD/uploads:/var/www/html/uploads" -p 1337:80 ghcr.io/fabalexsie/simple-web-upload-docker:master
```

or via compose.yml:

```yaml
services:
  app:
    image: ghcr.io/fabalexsie/simple-web-upload-docker:master
    ports:
      - "1337:80" # webserver is visible on host port 1337
    volumes:
      - ./uploads:/var/www/html/uploads
```

Go to http://localhost:1337 to upload files.

Files will be uploaded to ./uploads

Upload limit size: 10000MB
