<?php

/** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
/** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace Camroncade\Tests\Timezone;

use Camroncade\Timezone\Timezone;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class TimezoneTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testConvertIntFromUTC()
    {
        $timezone = new \Camroncade\Timezone\Timezone();
        $pacificTime = strtotime("2019-10-15 18:30:00.00");
        $utcTime = strtotime("2019-10-16 01:30:00.00");
        $shortFormat = 'H:i:s';
        $longFormat = 'Y-m-d H:i:s';
        $this->assertEquals(
            date($longFormat, $pacificTime),
            $timezone->convertFromUTC($utcTime, 'America/Los_Angeles')
        );
        $this->assertEquals(
            date($shortFormat, $pacificTime),
            $timezone->convertFromUTC($utcTime, 'America/Los_Angeles', $shortFormat)
        );
    }

    /**
     * @throws \Exception
     */
    public function testConvertIntToUTC()
    {
        $timezone = new Timezone();
        $pacificTime = strtotime("2019-10-15 18:30:00.00");
        $utcTime = strtotime("2019-10-16 01:30:00.00");
        $shortFormat = 'H:i:s';
        $longFormat = 'Y-m-d H:i:s';

        $this->assertEquals(
            date($longFormat, $utcTime),
            $timezone->convertToUTC($pacificTime, 'America/Los_Angeles')
        );
        $this->assertEquals(
            date($shortFormat, $utcTime),
            $timezone->convertToUTC($pacificTime, 'America/Los_Angeles', $shortFormat)
        );
    }

    /**
     * @throws \Exception
     */
    public function testConvertStringFromUTC()
    {
        $timezone = new Timezone();
        $pacificTime = "2019-10-15 18:30:00.00";
        $utcTime = "2019-10-16 01:30:00.00";
        $shortFormat = 'H:i:s';
        $longFormat = 'Y-m-d H:i:s';
        $this->assertEquals(
            date($longFormat, strtotime($pacificTime)),
            $timezone->convertFromUTC($utcTime, 'America/Los_Angeles')
        );
        $this->assertEquals(
            date($shortFormat, strtotime($pacificTime)),
            $timezone->convertFromUTC($utcTime, 'America/Los_Angeles', $shortFormat)
        );
    }

    /**
     * @throws \Exception
     */
    public function testConvertStringToUTC()
    {
        $timezone = new Timezone();
        $pacificTime = "2019-10-15 18:30:00.00";
        $utcTime = "2019-10-16 01:30:00.00";
        $shortFormat = 'H:i:s';
        $longFormat = 'Y-m-d H:i:s';
        $this->assertEquals(
            date($longFormat, strtotime($utcTime)),
            $timezone->convertToUTC($pacificTime, 'America/Los_Angeles')
        );
        $this->assertEquals(
            date($shortFormat, strtotime($utcTime)),
            $timezone->convertToUTC($pacificTime, 'America/Los_Angeles', $shortFormat)
        );
    }

    /**
     * @throws \Exception
     */
    public function testConvertDateTimeToUTC()
    {
        $timezone = new Timezone();
        $pacificTime = "2019-10-15 18:30:00.00";
        $utcTime = "2019-10-16 01:30:00.00";
        $shortFormat = 'H:i:s';
        $longFormat = 'Y-m-d H:i:s';

        $this->assertEquals(
            date($longFormat, strtotime($utcTime)),
            $timezone->convertToUTC(
                new \DateTime($pacificTime, new \DateTimeZone('America/Los_Angeles')),
                'America/Los_Angeles'
            )
        );

        $this->assertEquals(
            date($shortFormat, strtotime($utcTime)),
            $timezone->convertToUTC(
                new \DateTime($pacificTime, new \DateTimeZone('America/Los_Angeles')),
                'America/Los_Angeles',
                $shortFormat
            )
        );
    }

    /**
     * @throws \Exception
     */
    public function testConvertCarbonToUTC()
    {
        $timezone = new Timezone();
        $pacificTime = "2019-10-15 18:30:00.00";
        $utcTime = "2019-10-16 01:30:00.00";
        $shortFormat = 'H:i:s';
        $longFormat = 'Y-m-d H:i:s';

        $this->assertEquals(
            date($longFormat, strtotime($utcTime)),
            $timezone->convertToUTC(
                new Carbon($pacificTime, 'America/Los_Angeles'),
                'America/Los_Angeles'
            )
        );

        $this->assertEquals(
            date($shortFormat, strtotime($utcTime)),
            $timezone->convertToUTC(
                new Carbon($pacificTime, 'America/Los_Angeles'),
                'America/Los_Angeles',
                $shortFormat
            )
        );
    }

    /**
     * @throws \Exception
     */
    public function testBooleanTimestampThrowsException()
    {
        $timezone = new Timezone();
        $this->expectException(\InvalidArgumentException::class);
        $timezone->convertToUTC(true, 'UTC');
    }

    /**
     * @throws \Exception
     */
    public function testArrayTimestampThrowsException()
    {
        $timezone = new Timezone();
        $this->expectException(\InvalidArgumentException::class);
        $timezone->convertToUTC([], 'UTC');
    }

    /**
     * @throws \Exception
     */
    public function testObjectTimestampThrowsException()
    {
        $timezone = new Timezone();
        $this->expectException(\InvalidArgumentException::class);
        $timezone->convertToUTC(new \stdClass(), 'UTC');
    }

    /**
     * @throws \Exception
     */
    public function testNullTimestampThrowsException()
    {
        $timezone = new Timezone();
        $this->expectException(\InvalidArgumentException::class);
        $timezone->convertToUTC(null, 'UTC');
    }

    /**
     * @throws \Exception
     */
    public function testResourceTimestampThrowsException()
    {
        /** @var resource $resource */
        $resource = fopen('php://temp', 'r');
        $timezone = new Timezone();
        $this->expectException(\InvalidArgumentException::class);
        $timezone->convertToUTC($resource, 'UTC');
        fclose($resource);
    }
}
