TBuddies
===

The goal of this recruitment task is to verify your PHP level and understanding of Zend Framework 2 and ORM Doctrine 2 by a person applying for a PHP Developer position. The app created during this task should support adding, editing, deleting and browsing database records.

The first assumption of the app is the capability to managing persons (CRUD)

* Id – automatically generated value

* Name – deleting white spaces from the begining and end of string, changing first letter to capital letter

* Last name - deleting white spaces from the begining and end of string, changing first letter to capital letter

* Email – validation if e-mail address is correct

* Phone number – force following enter format ddd-ddd-ddd (only numbers)

The second assumption of the app is the capability to match persons as friends (Create, Delete, connection type many to many) - with a assumption that when a person X is a friend of person Y, then person Y is a friend of person X, you can't be a friend to yourself and the "declaration of friendship" can occur only once (you can add persons as a friend only after you deleted them from your list of friends). Short task description:

* Download Zend Skeleton Application with GIT

* Update libraries with Composer

* Integrate ORM Doctrine with the app

* Design and create classes for the database

* Generate database with Doctrine ORM console tool

* Create a form for adding new persons (with prompts about validation)

* Create a table displaying persons (with a "Action" column containing "Details", "Edit" and "Delete" buttons transfering to adequate views)

* Create a person edition form

* Create a "Details" page displaying all data about a person, list of friends (table with column names: "Name", "Last name" and "Action" with a delete button in column) and "Add friend" button below (transfering to "Add a new friend" form)

* Create a form for adding new friends (display all persons with dropdown list or checkbox group)

* Add links to "Persons list" and "Add person" in the navigation bar

The app will be verified by the code estetics, correctness, optymalization and usage of ZF2 solutions. We put a lot of emphasis on usage of newest versions of libraries and modules.

Every improvement in guidelines (i.e. usage of Twitter Bootstrap, jQuery, AJAX and additional functionality of Zend 2 framework such as: filters, decorators, AJAX + JSON, pagination, translations, authorization, ACL, cache, captcha, sessions etc.) will be a trump card (of course it may widen the app functionality - we like to work with creative people).