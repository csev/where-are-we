This is a little project I am playing with in my spare time for fun.

This uses composer to manage dependencies.  To install composer, do the following:

    curl -sS https://getcomposer.org/installer | /usr/bin/php5.5-cli

Then pull in the dependencies:

    php composer.phar install

That will create the folders `vendor` and `composer.lock` and install
all the needed library code in the `vendor` folders as well as the
PSR-4 autoloader for PHP.

