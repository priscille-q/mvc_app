# Priscille Quistin Technical Test

## Setup
### Database
import schema.sql
'mysql -u [username] -p technicalTest < schema.sql'

### composer
On your command line do 'composer install'

## Usage
The application start from index.php in the public folder.
sample : 'mvc.com/index.php?c=index&a=index' or 'mvc.com/?c=index&a=index'

## Development choices

### MVC
The Bootstrap is use for select the controller and action requested, with some checking. If the controller or action do not exist a default controller and action are use.

The basic controller 'Controller' is able to manage POST and GET to avoid their usage everywhere else. Each controller have to extend 'Controller' to be able to use this functionality.

### Database
Usage of the database is separate from Person and JobRole class so no class have to do a lot of job, and with the DI some child can be created and use without have to modify the code.

Because Person and JobRole extend DB, they avoid repetition of data, and a config file could be add without any modification for them.

### private constructor
Usage of static function/attribute to manage the number of Person and JobRole with in addition a few personalized exception to avoid them to exceed limitation.
