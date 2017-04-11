<?php namespace App\Libraries;

/**
 * Class NotTheDateLibrary
 * @package App\Libraries
 */
class NotTheDateLibrary
{

    private $date_string = '';
    private $day = 0;
    private $month = 0;
    private $year = 0;

    /**
     * NotTheDateLibrary constructor.
     * @param $date
     */
    public function __construct($date)
    {
        $this->date_string = trim($date);
        $date_arr  = explode(' ', $date);
        if (count($date_arr) === 3) {
            $this->day = (int)$date_arr[0];
            $this->month = (int)$date_arr[1];
            $this->year = (int)$date_arr[2];
        } else {
            throw new \InvalidArgumentException('Provided string is not a valid date ['.$date.']');
        }
    }

    /**
     * Checks if the provided date is valid
     *
     * @return bool
     */
    public function isDateValid()
    {
        // Day is last as it relies on month/year to be valid
        return ( $this->isMonthValid() && $this->isYearValid() && $this->isDayValid());
    }

    /**
     * @return string
     */
    public function getDateString()
    {
        return $this->date_string;
    }

    /**
     * @return int
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @return int
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Convert date to JulianDays
     * https://en.wikipedia.org/wiki/Julian_day#Converting_Julian_or_Gregorian_calendar_date_to_Julian_day_number
     *
     * @return int
     */
    public function getJulianDays()
    {

        $a = (int)floor((14-$this->getMonth())/12);
        $y = ($this->getYear()+4800) - $a;
        $m = ($this->getMonth()+(12*$a)-3);

        return (int)(
            $this->getDay()
            + (int)floor(((153*$m) + 2)/5)
            + (365*$y)
            + (int)floor($y/4)
            - (int)floor($y/100)
            + (int)floor($y/400)
            - 32045);
    }

    /**
     * @return bool
     */
    private function isYearValid()
    {
        return ($this->getYear() >= 0) && ($this->getYear() <= PHP_INT_MAX);
    }

    /**
     * @return bool
     */
    private function isMonthValid()
    {
        return ($this->getMonth() > 0) && ($this->getMonth() < 13);
    }

    /**
     * Checks if the day for this date is a valid one
     * (Takes into consideration leap years)
     *
     * @return bool
     */
    private function isDayValid()
    {
        if (($this->getDay() > 0) && ($this->getDay() <= 31)) {
            return ($this->getDay() <= $this->getDaysInMonth());
        } else {
            return false;
        }
    }

    /**
     * Returns the number of days in that particular month/year
     *
     * @return int
     */
    private function getDaysInMonth()
    {
        // Days are ordered from January to December, 0 to 12 where 0 is a null pad
        $days_in_each_month = [null, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        $days_in_each_month_in_a_leap_year = [null, 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        if($this->isLeap()) {
            return (int)$days_in_each_month_in_a_leap_year[$this->getMonth()];
        } else {
            return (int)$days_in_each_month[$this->getMonth()];
        }
    }

    /**
     * Check if current date is in a leap year
     *
     * @return bool
     */
    private function isLeap()
    {
        if ($this->year % 400 == 0) {
            return true;
        } else if ($this->year % 100 == 0) {
            return true;
        } else if ($this->year % 4 == 0) {
            return true;
        } else {
            return false;
        }
    }
}