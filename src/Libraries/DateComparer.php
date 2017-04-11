<?php namespace App\Libraries;

use App\Libraries\NotTheDateLibrary;

/**
 * Class DateComparer
 * @package App\Libraries
 */
class DateComparer
{
    /**
     * Compare two dates and return an array with the earliest as index 0
     *
     * @param NotTheDateLibrary $date_one
     * @param NotTheDateLibrary $date_two
     * @return array
     */
    public static function orderDatesAsc(NotTheDateLibrary $date_one, NotTheDateLibrary $date_two)
    {
        $d1 = $date_one->getDay();
        $m1 = $date_one->getMonth();
        $y1 = $date_one->getYear();

        $d2 = $date_two->getDay();
        $m2 = $date_two->getMonth();
        $y2 = $date_two->getYear();

        if ($y1 !== $y2) {
            if ($y1 < $y2) {
                return [$date_one, $date_two];
            } else {
                return [$date_two, $date_one];
            }
        } else if ($m1 !== $m2) {
            if ($m1 < $m2){
                return [$date_one, $date_two];
            } else {
                return [$date_two, $date_one];
            }
        } elseif ($d1 !== $d2) {
            if ($d1 < $d2){
                return [$date_one, $date_two];
            } else {
                return [$date_two, $date_one];
            }
        } else {
            // They are equals so we return first and last
            return [$date_one, $date_two];
        }
    }

    /**
     * Get difference between two dates
     *
     * @param \App\Libraries\NotTheDateLibrary $date_one
     * @param \App\Libraries\NotTheDateLibrary $date_two
     * @return int
     */
    public static function getDaysDiffBetweenDates(NotTheDateLibrary $date_one, NotTheDateLibrary $date_two)
    {
        return (int)abs( $date_one->getJulianDays() - $date_two->getJulianDays() );
    }

}