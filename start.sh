#!/bin/bash
if ! ( which php > /dev/null ); then
    echo 'error: php not installed'
    exit 1
fi

php -S localhost:8080 --docroot=website-vuln/public/ 2>> vuln.log >> vuln.log &
php -S localhost:42069 --docroot=website-evil/public/ 2>> evil.log >> evil.log &
echo vuln server @ localhost:8080
echo evil server @ localhost:42069
