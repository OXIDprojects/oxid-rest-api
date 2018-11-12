#!/usr/bin/env bash
set -e

# install oxid rest api
if [ ! -f /var/www/html/vendor/autoload.php ]
then
	echo "### START installation ###"
	chown -R www-data:www-data /var/www/html/public/
	echo "### 1/3 composer install ###"
	composer install
	echo "### 2/3 migrate db ###"
	php artisan migrate
	echo "### 3/3 seed db ###"
	php artisan db:seed
	echo "### FINISH installation ###"
	echo "###"
	echo "Let´s test http://localhost/rest/v1/articles?apiToken=t6PEqwkBpbdsf93osDSF913Bmcsd78pYWLtEgvs"
	echo "###"
fi
