Laminas API Tools Skeleton Application
======================================

Requirements
------------

Please see the [composer.json](composer.json) file.

Installation
------------

### Docker

If you develop or deploy using Docker, we provide configuration for you.

Prepare your development environment using [docker compose](https://docs.docker.com/compose/install/):

```bash
$ git clone https://github.com/dadbob/laminas-swoole
$ cd laminas-swoole
$ docker-compose build
# Install dependencies via composer, if you haven't already:
$ docker-compose run api-tools composer install
# Enable development mode:
$ docker-compose run api-tools composer development-enable
```

Start the container:

```bash
$ docker-compose up
```

Access Laminas API Tools from `http://localhost:8080/` or `http://<boot2docker ip>:8080/` if on Windows or Mac.

Run Swool server:
```bash
$ docker-compose run api-tools php server.php
```
Access Swoole from `http://localhost:8181/`


You may also use the provided `Dockerfile` directly if desired.

Once installed, you can use the container to update dependencies:


```bash
$ docker-compose run api-tools composer update
```

Or to manipulate development mode:

```bash
$ docker-compose run api-tools composer development-enable
$ docker-compose run api-tools composer development-disable
$ docker-compose run api-tools composer development-status
```

