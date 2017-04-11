### Description
An experimental library for date comparison.

This experiment doesn't use any of the PHP/C/HHVM libraries to solve the challenge.
Calculating the days between two dates is not a trivial issue, to avoid inelegant solutions, I opted for using the Julian day number as an epoch, then running a simple subtraction.
After a long research, the most reliable formula is the one on [wikipedia](https://en.wikipedia.org/wiki/Julian_day#Converting_Julian_or_Gregorian_calendar_date_to_Julian_day_number) which had to be adapted to work around PHP notorious issues with floats.

This library does some basic validations and takes into consideration leap year.
Year range: 0 to INT_MAX

### INSTALL
```composer install```
Please note that the required libraries are just for testing and easier CLI output/input.

### USAGE
```php do.php app:dateDiff "DD MM YYYY" "DD MM YYYY"```
Or use the included bash script which runs several dates in a row: ```bash doLots.bash```

Command will output ```EARLIEST_DATE, LATEST_DATE, DAY_DIFF```

### TESTS
```./vendor/bin/phpunit```
Please note that system wide installs of phpunit might not work, relying on the composer installed bin is the safest bet.