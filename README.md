# Simple Web Upload Docker

![http support](https://badgen.net/badge/http/yes/97ca00?icon=https%3A%2F%2Fwww.svgrepo.com%2Fdownload%2F491433%2Flock-open.svg)
![https support](https://badgen.net/badge/https/yes/97ca00?icon=https%3A%2F%2Fwww.svgrepo.com%2Fdownload%2F491434%2Flock.svg)
[![Docker](https://badgen.net/badge/icon/docker?icon=docker&label)](https://ghcr.io/fabalexsie/simple-web-upload-docker)

![Screenshot-PC](src/images/screenshot-pc.png)

Example execution:

```bash
docker run --rm -it \
  -v "$PWD/uploads:/var/www/html/uploads" \
  -e HOSTIP=$(hostname -I | awk '{print $1}') \
  -p 1337:443 \
  --pull always \
  ghcr.io/fabalexsie/simple-web-upload-docker:master
```

One click usage in Windows

```bash
for /f "delims=[] tokens=2" %a in ('ping -4 -n 1 %ComputerName% ^| findstr [') do set LocalIP=%a
docker run --rm -it -v "%CD%/uploads:/var/www/html/uploads" -e HOSTIP=%LocalIP% -p 1337:443 --pull always ghcr.io/fabalexsie/simple-web-upload-docker:master
```

> `HOSTIP` can also be set manually to the local ip for example 192.168.X.X
> It is only needed for the self signed certificate, when reaching the webapp via https (necessary for PWA).

> The webserver is visible on host port 1337 with http and https (self-signed).

or via compose.yml:

```yaml
services:
  app:
    image: ghcr.io/fabalexsie/simple-web-upload-docker:master
    ports:
      - "1337:443" # webserver is visible on host port 1337
    volumes:
      - ./uploads:/var/www/html/uploads
    environment:
      - HOSTIP=192.168.X.X # IP of the host machine for the self signed certificate (https is needed for PWA)
```

Go to http://localhost:1337 to upload files.

Files will be uploaded to ./uploads

Upload limit size: 10000MB

## Usage as PWA (Progressive Web App)

After initial start you find the root ca certificate in the uploads folder. Install it on your device to trust the self signed certificates for the local ip defined by the `HOSTIP` environment variable.
After that you can install the webapp as PWA on your device. You may need to reload the page after the certificate is installed.

A PWA can only be installed via https. So please open the webapp via https://localhost:1337 after installing the ca certificate.

**Advantage**: You can directly share files from your native share menu on the device to the webapp.
