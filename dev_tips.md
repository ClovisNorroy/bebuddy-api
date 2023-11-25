## How to setup step by step debugging

https://marketplace.visualstudio.com/items?itemName=xdebug.php-debug

## Create a new table

```Bash
symfony console make:entity
symfony console make:migration
symfony console doctrine:migrations:migrate
```

## Deployment

Do not forget to add symfony/apache-pack

## React environment variables

Variable's name must be preceded by "REACT_APP_"

## Launch react with HTTPS

($env:HTTPS="true") -and ($env:SSL_CRT_FILE="C:/Windows/System32/cert.crt") -and ($env:SSL_KEY_FILE="C:/Windows/System32/cert.key")