#!/bin/bash

runuser -s /bin/bash -l www-data -c 'php /app/bin/compile.config.php'

apache2-foreground
