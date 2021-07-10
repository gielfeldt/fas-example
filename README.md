[![Build Status](https://github.com/gielfeldt/fas-example/actions/workflows/test.yml/badge.svg)][4]
![Test Coverage](https://img.shields.io/endpoint?url=https://gist.githubusercontent.com/gielfeldt/74c795e02f2f06f70239c7d801736caf/raw/fas-example__main.json)

[![Latest Stable Version](https://poser.pugx.org/fas/example/v/stable.svg)][1]
[![Latest Unstable Version](https://poser.pugx.org/fas/example/v/unstable.svg)][2]
[![License](https://poser.pugx.org/fas/example/license.svg)][3]
![Total Downloads](https://poser.pugx.org/fas/example/downloads.svg)

# Installation

```bash
composer create-project fas/example myproject
```

# Usage (dev mode)
```bash
docker-compose up --build -d
```

# Files

```
cache/                   # contains precompiled container, routes, preloads, etc.
coverage/                # phpunits test coverage in html

docker/apache.conf       # apache configuration
docker/php.ini           # general php configuration
docker/prod.sh           # init script for docker container in prod mode
docker/php.dev.ini       # php overrides for dev mode
docker/dev.sh            # init script for docker container in dev mode

public/.htaccess         # standard htaccess for sending requests to index.php
public/index.php         # entrypoint for php application

src/ContainerFactory.php # di container setup
src/RouterFactory.php    # routes setup

bin/compile.php          # script for compiling container and routes for prod
bin/compile.config.php   # script for compiling configuration for prod
bin/preload.php          # preload entry point for production
bin/preload.app.php      # preloads specific to this application

config.yaml              # custom configuration file for your project
```


# Simplest form

If not using docker, compiled builds or tests, the code sums down to this:

```
public/.htaccess         # standard htaccess for sending requests to index.php
public/index.php         # entrypoint for php application
src/ContainerFactory.php # di container setup
src/RouterFactory.php    # routes setup
```

# Create prod build
```bash
docker build -t fas:prod --target prod .
```

# Run the prod build
```bash
docker run -d --name fas --rm -it -p8081:80 -v`pwd`/config.yaml:/app/config.yaml:ro fas:prod
````


[1]:  https://packagist.org/packages/fas/example
[2]:  https://packagist.org/packages/fas/example#dev-main
[3]:  https://github.com/gielfeldt/fas-example/blob/main/LICENSE.md
[4]:  https://github.com/gielfeldt/fas-example/actions/workflows/test.yml
