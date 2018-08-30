# URL Shortener Test Task

## Installation

Execute to make the application runnable:
```sh
$ composer install                   # install application dependencies
$ bin/console doctrine:schema:create # make database in sync with current entity metadata (migrations not implemented)
$ yarn run encore dev                # build frontent application
``` 

## Running

Execute to run the application:
```sh
$ bin/console server:start
```
Now an application available on `http://127.0.0.1:8000`. 

Follow the link to [http://127.0.0.1:8000](http://127.0.0.1:8000) and generate a new short URL from a long one. 
To view the statistics on clicks on short URL just add "/stats" path to your short URL (e.g. in case you have 
`http://127.0.0.1:8000/jF` short URL, you need to change it to `http://127.0.0.1:8000/jF/stats` to view the 
statistics).

## Tests

Execute to run the tests:
```sh
$ bin/phpunit
```
There're implemented only few tests, just to show that I can write the tests.