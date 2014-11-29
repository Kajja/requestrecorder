<?php

namespace Kajja\Recorder;

class RequestRecordTest extends \PHPUnit_Framework_TestCase
{

    protected $dbh;
    protected $formatter;

    protected function setUp()
    {
        // Setting up server environment variables (exists as a global variable)
        $_SERVER = [
            'REQUEST_URI' => 'TestUri',
            'REQUEST_METHOD' => 'GET'
        ];

        // Creating mock objects from interfaces
        $this->dbh = $this->getMockBuilder('Kajja\Recorder\IDatabaseHandler')->getMock();
        $this->formatter = $this->getMockBuilder('Kajja\Recorder\IFormatter')->getMock();
    }


    /**
     * Test
     *
     * @return void
     */
    public function testsave()
    {

        $now = date(\DateTime::RFC2822);

        //Setting up expectations (indirectly tests the private method getSessionId())
        $this->dbh->expects($this->once())
            ->method('insertRecord')
            ->with($this->equalTo(['uri', 'method', 'date', 'session']),
                $this->equalTo(['TestUri', 'GET', $now, time()]));

        $record = new RequestRecord($this->dbh, $this->formatter);

        $record->save();
    }


    /**
     * Test
     *
     * @return void
     */
    public function testgetRecords()
    {
        //Setting up expectations
        $this->dbh->expects($this->once())
            ->method('getAllRecords')
            ->willReturn('TestRecords');

        $this->formatter->expects($this->once())
            ->method('getOutput')
            ->with($this->equalTo('TestRecords'))
            ->willReturn('Formatted TestRecords');

        $record = new RequestRecord($this->dbh, $this->formatter);

        $this->assertEquals($record->getRecords(), 'Formatted TestRecords');
    }


    /**
     * Test
     *
     * @return void
     */
    public function testclearRecords()
    {
        $this->dbh->expects($this->once())
            ->method('deleteAll');

        $records = new RequestRecord($this->dbh, $this->formatter);

        $records->clearRecords();
    }
}