<?php

namespace Kajja\Recorder;

/**
 * Test of the RequestRecordAnax class
 *
 *
 */
class RequestRecordAnaxTest extends \PHPUnit_Framework_TestCase
{

    protected $di;

    protected function setUp()
    {
        // Creating mock di-object
        $this->di = (object) [
            'request' => (object) [
                'getCurrentUrl()' => function() { return 'http://test.se/test.php';},
                'getServer' => function($requestMethod) { return 'GET';}
                ],
            'session' => (object) [
                'set' => function($id, $value) { }
                ]
        ];
    }


    /**
     * Test
     *
     *
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

        $record = new RequestRecordAnax($dbh, $formatter, $this->di);

    }
}