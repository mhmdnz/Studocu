# Studocu Project

Welcome to the Studocu project! This document serves as a comprehensive guide to help you understand, install, and use the project effectively.

## Table of Contents
- [Project Overview](#project-overview)
- [Project Stack](#project-stack)
- [Installation](#installation)
    - [With Docker](#with-docker)
    - [With Sail](#with-sail)
- [How to Use the Project](#how-to-use-the-project)
- [Running Tests](#running-tests)
- [Technical Aspects](#technical-aspects)
- [Modular Architecture](#modular-architecture)
- [Design Patterns](#design-patterns)
- [Tests](#tests)
- [Contact](#contact)

## Project Overview
**Studocu** is a collaborative platform designed for users to store, access, and interact with flashcards. It allows multiple users to save flashcards with questions and answers, engage in self-assessment quizzes, and monitor their learning progress through statistics. This platform is especially beneficial for students and educators looking for an efficient way to organize study material and enhance learning outcomes.

## Project Stack
### PHP 8.3
A popular general-purpose scripting language that is especially suited to web development. It is fast, flexible, and pragmatic.

### Laravel 11
A web application framework with expressive, elegant syntax. Laravel aims to make the development process a pleasing one for the developer without sacrificing application functionality.

### MySQL
An open-source relational database management system. It is a central component of the LAMP web application software stack.

### Docker - Sail (Optional)
Docker provides a way to run applications securely isolated in a container, packaged with all its dependencies and libraries. For those preferring a Docker-based environment, Laravel Sail is an optional tool that offers a simple command-line interface for interacting with Laravel's default Docker development environment.

## Installation
### **With Docker**
1. Clone the repository.
2. `cd <project directory>`
3. Run the following command:
`docker-compose up -d`
4. **Important Note:** After running containers, please wait for couple of minutes, or check your container to see when composer install, migrations, seeds are done. Then, you are good to go. For the first setup, it normally takes 3 to 8 minutes, depending on your computer and network speeds.

### **With Sail**
1. Clone the repository.
2. `cd <project directory>`
3. Rename `docker-compose-sail.yml` to `docker-compose.yml`.
4. Execute `composer install`.
5. Use `./vendor/bin/sail up`.

## How to Use the Project
You can start using the project by running the following command:
`docker-compose exec laravel.test php artisan flashcard:interactive`

## Running Tests
You can run tests by using this command:
`docker-compose exec laravel.test php artisan test`


## Technical Aspects
Please note that the project was written in two days and will have some issues. To me, it's a 70% good project. For example, creating a user (as it was sort of optional for the task) doesn't have enough validation, and you will encounter errors if looking for edge cases. However, I added sufficient validation for a similar situation with creating flashcards, and you can check validation and test coverage for it.

## Modular Architecture
Please check the `app/Modules/FlashCards` directory to see all the codes. I wrote it in a modular way to have everything in one place, making the project expandable. The manipulation of it is focused, and each team can work on one module. Also, if needed, we can easily extract each module into a separate microservice.

## Application Layers
In this application, I used four different layers: InteractiveCommand, Actions, Services, and Repositories. Each layer interacts with the others, making it easily manageable. This separation ensures that the logic representing business processes is distinct from the database layer.

## Design Patterns
Alongside all patterns that Laravel gives us to use (like the Command Pattern, which is used in Laravel migration), I also added some to my code as examples:

### Dependency Injection
I used Dependency Injection as much as I could (I might have missed some cases) but I believe its covering most of the services. Most classes will be auto-wired by Laravel, but to be sure, I added providers for most of them. In some cases, I needed to use instant binding so my workflow would have access to that through the container.

### Factory
I created one factory as an example in my module. This Factory follows the Open/Close principle so that you can easily add more services under its command without touching my code.

### Adapter
I created one Adapter as an example so that Laravel's "search function", which we are not able to write tests for, is used in this class. It can be easily used and changed if needed as it is injected, also it gives the power to Mock in my test classes in the future.

### Bridge
I created one bridge class also to aggregate some codes, helping me to decouple codes and preparation so that my services can focus on their purposes instead of generating
## Tests
I tried to use Test-Driven Development (TDD) as much as I could. The test coverage might not be full, but I tried to cover as much as I had time for.

## Contact
Feel free to contact me if you had any issues running the project at mhmd_nzri@yahoo.com.
