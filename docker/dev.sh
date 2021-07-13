#!/bin/bash

runuser -s /bin/bash -l www-data -c 'cd /app && composer install --optimize-autoloader'

apache2-foreground &

cd /app

while true; do

    runuser -s /bin/bash -l www-data -c 'cd /app && composer update --optimize-autoloader'

    find /app/src/ -type f -name '*.php' -exec php -l {} \; | (! grep -v "No syntax errors detected" )
    runuser -s /bin/bash -l www-data -c '/app/vendor/bin/phpcs --standard=psr12 /app/src'
    runuser -s /bin/bash -l www-data -c '/app/vendor/bin/phpmd /app/src text cleancode,codesize,controversial,design,naming,unusedcode'
    runuser -s /bin/bash -l www-data -c 'XDEBUG_MODE=coverage /app/vendor/bin/phpunit --coverage-html /app/coverage --whitelist /app/src/ /app/tests/'

    inotifywait -r --event modify,create,delete,move /app/public/ /app/src/ /app/tests/ composer.lock composer.json || exit 1
done
