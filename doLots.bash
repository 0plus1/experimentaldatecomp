#!/usr/bin/env bash

php do.php app:date-diff "01 01 1970" "11 04 2017"
php do.php app:date-diff "29 02 1980" "01 03 1980"
php do.php app:date-diff "18 01 1788" "01 01 1901"
php do.php app:date-diff "10 01 2058" "19 10 2011"
php do.php app:date-diff "03 03 3030" "03 03 3030"
php do.php app:date-diff "01 01 0" "10 10 1330"