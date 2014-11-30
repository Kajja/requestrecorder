<?php

namespace Kajja\Recorder;

require('MockCDIAnax.php');
require('MockCSession.php');
require('MockCRequestBasic.php');

/**
 * Test of the RequestRecordAnax class
 *
 *
 */
class RequestRecordAnaxTest extends \PHPUnit_Framework_TestCase
{

    protected $di;
    protected $dbh;
    protected $formatter;

    protected function setUp()
    {
        // Creating mock objects from interfaces
        $this->dbh = $this->getMockBuilder('Kajja\Recorder\IDatabaseHandler')->getMock();
        $this->formatter = $this->getMockBuilder('Kajja\Recorder\IFormatter')->getMock();
        
        // Creating mock Anax objects
        $session = $this->getMockBuilder('\MockCSession')->getMock();
        $session->expects($this->once())
            ->method('set');
        $session->expects($this->once())
            ->method('get');

        $request = $this->getMockBuilder('\MockCRequestBasic')->getMock();
        $request->expects($this->once())
            ->method('getCurrentUrl');
        $request->expects($this->once())
            ->method('getServer');

        $this->di = new \MockCDIAnax(['session' => $session, 'request' => $request]);
    }


    /**
     * Test
     * (indirectly tests the RequestRecordAnax constructor and getSessionId method)
     *
     */
    public function testsave()
    {        
        $now = date(\DateTime::RFC2822);

        $record = new RequestRecordAnax($this->dbh, $this->formatter, $this->di);

        $record->save();
    }
}