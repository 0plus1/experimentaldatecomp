<?php namespace Tests\Unit;

use App\Libraries\NotTheDateLibrary;
use PHPUnit\Framework\TestCase;

/**
 * @covers NotTheDateLibrary
 */
class NotTheDateLibraryTest extends TestCase
{
    public function testCanBeCreatedFromValidDate()
    {
        $date = new NotTheDateLibrary('01 01 2010');
        $this->assertTrue($date->isDateValid());
        $date = new NotTheDateLibrary('29 02 1980');
        $this->assertTrue($date->isDateValid());
    }

    public function testCannotBeCreatedFromInvalidDate()
    {
        $date = new NotTheDateLibrary('01 13 2010');
        $this->assertFalse($date->isDateValid());
        $date = new NotTheDateLibrary('29 02 1981');
        $this->assertFalse($date->isDateValid());
    }

    public function testCannotBeCreatedFromInvalidString()
    {
        $this->expectException(\InvalidArgumentException::class);
        new NotTheDateLibrary('01-13-2010');
    }

    public function testCanBeConvertedToJulian()
    {
        $date = new NotTheDateLibrary('01 01 1582');
        $this->assertEquals(2298874, $date->getJulianDays() );
        $date = new NotTheDateLibrary('5 10 1582');
        $this->assertEquals(2299151, $date->getJulianDays() );
        $date = new NotTheDateLibrary('01 01 1970');
        $this->assertEquals(2440588, $date->getJulianDays() );
        $date = new NotTheDateLibrary('01 01 2999');
        $this->assertEquals(2816423, $date->getJulianDays() );
    }
}