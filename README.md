# Crossfit Tracker RESTful API
PHP RESTful API for the Crossfit Tracker Application

## Stack
- PHP (v7)
- Symfony (v4)
- Doctrine (v2.5.11)

## Design Decisions
The Symfony framework was chosen when designing this API as the web client is written
in Angular and what both of these frameworks have in common is the use of Dependency Injection.

Doctrine was used as an Object Relational Mapping tool. Doctrine integrates seamlessly into
the Symfony framework.

I attempted to follow OOP principles as much as possible with the design of this application by ensuring
each object is responsible for its own behaviour and by abstracting the code as much as possible.