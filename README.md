## todosBackend
 [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Marc-Calafell/todosBackend/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Marc-Calafell/todosBackend/?branch=master)
 [![Code Coverage](https://scrutinizer-ci.com/g/Marc-Calafell/todosBackend/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Marc-Calafell/todosBackend/?branch=master)
 [![Build Status](https://scrutinizer-ci.com/g/Marc-Calafell/todosBackend/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Marc-Calafell/todosBackend/build-status/master)
 
 [![Build Status](https://travis-ci.org/Marc-Calafell/todosBackend.svg?branch=master)](https://travis-ci.org/Marc-Calafell/todosBackend)
 
 [![StyleCI](https://styleci.io/repos/71569611/shield?branch=master)](https://styleci.io/repos/71569611)
 
 
 ## Installation
 Clone the repo in a clean folder:
 ``` bash
 $ git clone git@github.com:Marc-Calafell/todosBackend.git
 ```
 
 Enter to the directory:
 ``` bash
 $ cd todosBackend
 ```
 
 Make a composer install:
 ``` bash
 $ composer install
 ```
 
 And make npm install:
 ``` bash
 $ npm install
 ```
 
 Prepare the environments:
 ``` bash
 $ cp .env.example .env
 ```
 
 Generate a new key:
 ``` bash
 $ php artisan key:generate
 ```
 
 ## Database
 
 To run the migrations, first you have to create a SQL Database (for example, sqlite).
 Then, you have to change the "DB_CONNECTION" parameter on .env file to sqlite and comment other DB parameters.
 ```
 DB_CONNECTION=sqlite
 #DB_HOST=127.0.0.1
 #DB_PORT=3306
 #DB_DATABASE=homestead
 #DB_USERNAME=homestead
 #DB_PASSWORD=secret
 ```
    
 Run the following command to perform the migrations:
 ``` bash
 $ php artisan migrate:refresh
 ```
 
 If you want to populate the database with example records use this command
 ``` bash
 $ php artisan migrate:refresh --seed
 ```
 
 ## Change log
 
 
 ## Testing
 
 To run tests, use:
 ``` bash
 $ phpunit
 ```