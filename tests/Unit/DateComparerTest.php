<?php namespace Tests\Unit;

use App\Libraries\DateComparer;
use App\Libraries\NotTheDateLibrary;
use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * @covers DateComparer
 */
class DateComparerTest extends TestCase
{
    public function testAreDatesOrderedCorretly()
    {
        $date_one_string = '01 01 2010';
        $date_two_string = '01 01 2011';

        list($smallest_date, $larger_date) = $this->doOrderDatesAscFromString($date_one_string, $date_two_string);

        $this->assertEquals($smallest_date->getDateString().$larger_date->getDateString(), $date_one_string.$date_two_string);

        $date_one_string = '01 08 2010';
        $date_two_string = '01 11 2010';

        list($smallest_date, $larger_date) = $this->doOrderDatesAscFromString($date_one_string, $date_two_string);

        $this->assertEquals($smallest_date->getDateString().$larger_date->getDateString(), $date_one_string.$date_two_string);

        $date_one_string = '12 02 2010';
        $date_two_string = '16 02 2010';

        list($smallest_date, $larger_date) = $this->doOrderDatesAscFromString($date_one_string, $date_two_string);

        $this->assertEquals($smallest_date->getDateString().$larger_date->getDateString(), $date_one_string.$date_two_string);
    }

    public function testIsDateDiffInDayCalculatedCorrectly()
    {
        $date_one_string = '01 01 2000';
        $date_two_string = '01 01 2001';
        $this->assertEquals(366, $this->doGetDaysDiffFromStrings($date_one_string, $date_two_string));

        $date_one_string = '01 01 1980';
        $date_two_string = '01 04 1980';
        $this->assertEquals(91, $this->doGetDaysDiffFromStrings($date_one_string, $date_two_string));

        $date_one_string = '20 02 1980';
        $date_two_string = '01 03 1980';
        $this->assertEquals(10, $this->doGetDaysDiffFromStrings($date_one_string, $date_two_string));
    }

    /**
     * @param string $date_one_string
     * @param string $date_two_string
     * @return array
     */
    private function doOrderDatesAscFromString($date_one_string, $date_two_string)
    {
        $date_one = new NotTheDateLibrary($date_one_string);
        $date_two = new NotTheDateLibrary($date_two_string);

        return DateComparer::orderDatesAsc($date_one, $date_two);
    }

    /**
     * Helper to quickly compare two date strings
     *
     * @param string $date_one_string
     * @param string $date_two_string
     * @return int
     */
    private function doGetDaysDiffFromStrings($date_one_string, $date_two_string)
    {
        $date_one = new NotTheDateLibrary($date_one_string);
        $date_two = new NotTheDateLibrary($date_two_string);

        return DateComparer::getDaysDiffBetweenDates($date_one, $date_two);
    }

}