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
        /*
        $session = $this->getMockBuilder('Anax\Session\CSession')->getMock();
      /*  $session->expects($this->once())
            ->method('get')
            ->wi
    
        $request = $this->getMockBuilder('Anax\Request\CRequestBasic')->getMock();
*/
//        $this->di = new MockCDIAnax(['session' => $session, 'request' => $request]);
 //       $this->di = new \Anax\Session\CSession();
        //$this->di->session = "hej";

        //var_dump($this->di);
    }


    /**
     * Test
     * (indirectly tests the RequestRecordAnax constructor and getSessionId method)
     *
     */
    public function testsave()
    {
  //      $this->di->session = "hej";
        //var_dump($this->di);

/*        
        // Creating mock objects from interfaces
        $dbh = $this->getMockBuilder('Kajja\Recorder\IDatabaseHandler')->getMock();
        $formatter = $this->getMockBuilder('Kajja\Recorder\IFormatter')->getMock();

        $now = date(\DateTime::RFC2822);

        //Setting up expectations (indirectly tests the private method getSessionId())
        $dbh->expects($this->once())
            ->method('insertRecord')
            ->with($this->equalTo(['uri', 'method', 'date', 'session']),
                $this->equalTo(['TestUri', 'GET', $now, time()]));
*/
        //$record = new RequestRecordAnax($dbh, $formatter, $this->di);

    }
}