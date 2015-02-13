# claroline-archiver
archive tool for claroline

## Architecture

app/config : config files for the application
module/*.php : module init functions for the modules

## Roadmap

* Split views into views/MODULENAME and views/core
* Split config into config/MODULENAME and config/core and load them module init functions

## Some useful links :

### Silex best practices

* http://srcmvn.com/blog/2013/03/08/silex-service-providers-and-controller-providers-what-is-safe-to-do-where/

### Doctrine and DBAL

* http://akrabat.com/php/using-doctrine-migrations-outside-of-doctrine-orm-or-symfony/
* http://www.codediesel.com/mysql/creating-sql-schemas-with-doctrine-dbal/
* http://doctrine-dbal.readthedocs.org/en/latest/reference/schema-representation.html
