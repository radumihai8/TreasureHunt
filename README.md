# TreasureHunt
TreasureHunt game website developed with Laravel 9 and MySQL

# User Stories

## User
1. Ca User, vreau sa ma pot inregistra pentru a avea acces la servicii.

2. Ca User, vreau sa ma pot loga pentru a avea acces la servicii.

3. Ca User, vreau sa aleg daca sunt organizator sau player pentru a-mi putea decide rolul in cadrul jocului.

## Organizator

4. Ca Organizator, vreau sa pot crea o camera ca sa existe un spatiu de desfasurare al jocului.

5. Ca Organizator, vreau sa adaug ghicitori pentru a stabili regulile jocului.

6. Ca Organizator, vreau sa vad progresul jocului pentru a ma asigura ca jocul progreseaza.

## Player

7. Ca Player, vreau sa ma alatur unei camere pentru a ma juca,

8. Ca Player, vreau sa raspund la ghicitori pentru a castiga puncte si eventual a casgtiga jocul.

9. Ca Player, vreau sa pot vedea clasamentul cu ceilalti jucatori din camera ca sa vad unde ma aflu ca punctaj.

## Administrator

10. Ca Administrator, vreau sa vad toti Playerii si toate jocurile pentru a tine evidenta aplicatiei.

# Instructiuni

Clone the repository

    git clone https://github.com/radumihai8/

Switch to the repo folder

    cd TreasureHunt

Run the database migrations (**Set the database connection in .env**)

    php artisan migrate

Start the local development server

    php artisan serve
    
# Diagrama UML

![DiagramaUML](https://user-images.githubusercontent.com/17956023/173894446-f84629a9-2169-4e34-866e-0f547bba43ff.png)

# Design patterns

For this project we used Laravel 9, which is an open source framework for PHP, intended for the development of web applications following the model–view–controller architectural pattern

This framework implements the following design patterns:

- [x] Builder pattern
- [x] Factory pattern
- [x] Strategy pattern
- [x] Provider pattern
- [x] Repository pattern
- [x] Facade pattern

# Tools

For this project we used PHPStorm which is a popular IDE for PHP. 
For building and deploying our app we used the php artisan tool which provides a number of useful commands.
To make sure the app looks amazing on any device, we used Bootstrap, a collection of HTML, CSS and JavaScript tools. 
