<?php

namespace Kajja\Recorder;

class RequestRecordTest extends \PHPUnit_Framework_TestCase
{

    protected function setUp()
    {
        // Setting up server environment variables (exists as a global variable)
        $_SERVER = [
            'REQUEST_URI' => 'TestUri',
            'REQUEST_METHOD' => 'GET'
        ];
    }


    /**
     * Test
     *
     * @return void
     */
    public function testsave()
    {
        // Creating mock objects from interfaces
        $dbh = $this->getMockBuilder('Kajja\Recorder\IDatabaseHandler')->getMock();
        $formatter = $this->getMockBuilder('Kajja\Recorder\IFormatter')->getMock();

        $now = date(\DateTime::RFC2822);

        //Setting up expectations (indirectly tests the private method getSessionId())
        $dbh->expects($this->once())
            ->method('insertRecord')
            ->with($this->equalTo(['uri', 'method', 'date', 'session']),
                $this->equalTo(['TestUri', 'GET', $now, time()]));

        $record = new RequestRecord($dbh, $formatter);

        $record->save();
    }


    /**
     * Test
     *
     * @return void
     */
    public function testgetRecords()
    {
        // Creating mock objects from interfaces
        $dbh = $this->getMockBuilder('Kajja\Recorder\IDatabaseHandler')->getMock();
        $formatter = $this->getMockBuilder('Kajja\Recorder\IFormatter')->getMock();

        //Setting up expectations
        $dbh->expects($this->once())
            ->method('getAllRecords')
            ->willReturn('TestRecords');

        $formatter->expects($this->once())
            ->method('getOutput')
            ->with($this->equalTo('TestRecords'))
            ->willReturn('Formatted TestRecords');

        $record = new RequestRecord($dbh, $formatter);

        $this->assertEquals($record->getRecords(), 'Formatted TestRecords');
    }


    /**
     * Test
     *
     * @return void
     */
    public function testclearRecords()
    {
        // Creating mock objects from interfaces
        $dbh = $this->getMockBuilder('Kajja\Recorder\IDatabaseHandler')->getMock();
        $formatter = $this->getMockBuilder('Kajja\Recorder\IFormatter')->getMock();

        $dbh->expects($this->once())
            ->method('deleteAll');

        $records = new RequestRecord($dbh, $formatter);

        $records->clearRecords();
    }
}