#!/bin/bash
./vendor/phpstan/phpstan/phpstan analyse -l 7 plugins/miles-plugin/src
if [ $? -eq 0 ]
then
    ./vendor/phpspec/phpspec/bin/phpspec run
    if [ $? -eq 0 ]
    then
        exit 0
    fi
fi

exit 1
