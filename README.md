# claroline-archiver
archive tool for claroline

## Architecture

app/config : config files for the application
module/*.php : module init functions for the modules

## Roadmap

* Split views into views/MODULENAME and views/core
* Split config into config/MODULENAME and config/core and load them module init functions
* Add user provider (https://packagist.org/packages/jasongrimes/silex-simpleuser)

## Some useful links :

### Silex best practices

* http://srcmvn.com/blog/2013/03/08/silex-service-providers-and-controller-providers-what-is-safe-to-do-where/

### Providers

* https://github.com/silexphp/Silex-WebProfiler

### Illuminate, Eloquent, Silluminate

* https://github.com/sjdaws/silluminate
* https://github.com/illuminate/database
