# Shop review

A test task for demonstration.

## Deployment

1. Clone the repository.
2. Run composer (```composer update```). It will install the dependencies.
3. Edit the ```./config/application.config.php``` file. At least you need to change the database settings to run the application.
4. Edit your apache configuration file (case of vhost):
  * The webroot should point to the ```./public``` directory.
  * You need to set the apache config files to process the ```./public/.htaccess``` file to get short URLs.
5. Add write access to these directories (create them first):
  * ```./view/cache```
  * ```./view/templates_c```
6. (optional) Use the sample database dump file located in ```./data``` directory to load some sample data into the database (MySql).

## Dependecies (installed by composer)

Thank you:

* [Bootstrap 3 front-end framework ](https://github.com/twbs/bootstrap)
* [Smarty 3 template engine](https://github.com/smarty-php/smarty)
* [PHPMailer email creation and transfer class for PHP](https://github.com/PHPMailer/PHPMailer)

And [password_compat](https://github.com/ircmaxell/password_compat) "to provide forward compatibility with the password_* functions being worked on for PHP 5.5".
