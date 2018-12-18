#  Clic & Coupe Web Api
## Tools
Symfony 4.2
PHP 7.3
API Platform
Composer 1.6.3

## Getting Started
Be sure that you are in the **/api** folder
First of all, install dependencies with the command : 
    $ composer install
Then, create the database and its schema:

    $ bin/console doctrine:database:create
    $ bin/console doctrine:schema:create
And start the built-in PHP server or the Symfony WebServerBundle

    # Built-in PHP server
    $ php -S 127.0.0.1:8000 -t public
    
    # Symfony WebServerBundle
    $ bin/console server:run

## It's Ready!
Open http://localhost:8000 in your web browser

## Fixtures
You can generate the fixtures to hydrate the database

    # Create the migration
    $ bin/console doctrine:make:diff
    # Generate the database
    $ bin/console doctrine:make:migration
    # Run fixtures
    $ bin/console doctrine:fixtures:load

## Jwt token 
Before trying to connect the Api with web client create public and private key for the server
[documentation here](https://github.com/lexik/LexikJWTAuthenticationBundle)

    $ openssl genrsa -out config/jwt/private.pem -aes256 4096  
    $ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem

## Database configuration

* UserId( __id__, name, surname, email, phone, roles, password, sex, #city, #salon)
 
 *#city can't be null*
 *#salon can be null*
 
* Stylist(__id__, name, surname, #salon)

*#salon can't be null* 

* Salon(__id__, name, phone, gps_address, email, password, #city)

*#city can't be null

* Rdv(__id__, date_start, date_end, #userId, #stylist)

*#userId can't be null*
*#stylist can't be null*

*Prestation(__id__, label, price, #salon)

*#salon can't be null*
* City(__id__, name, cp)

## Standards

CamelCase is the wait to go here. :camel: 

