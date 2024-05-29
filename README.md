# docker-nginx-php-upload

Example execution:

```
docker run --rm -it -v "$PWD/uploads:/uploads" -p 32773:80 ghcr.io/fabalexsie/simple-web-upload-docker:master
```

or via compose.yml: See [docker-compose.yml](docker-compose.yml)

Go to http://localhost:32773 to upload files.

Files will be uploaded to ./uploads

Upload limit size: 10000MB
