
# Usage (dev mode)
```
%> docker-compose up --build -d
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
```
%> docker build -t fas:prod --target prod .
```

# Run the prod build
```
%> docker run -d --name fas --rm -it -p8081:80 -v`pwd`/config.yaml:/app/config.yaml:ro fas:prod
````

