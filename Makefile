.PHONY: fix
fix:
	ddev php vendor/friendsofphp/php-cs-fixer/php-cs-fixer --config=/var/www/html/.php-cs-fixer.php fix --diff

.PHONY: test
test:
	ddev exec /var/www/html/vendor/phpunit/phpunit/phpunit --bootstrap /var/www/html/UnitTestsBootstrap.php --configuration /var/www/html/UnitTests.xml

.PHONY: start
start:
	ddev start
