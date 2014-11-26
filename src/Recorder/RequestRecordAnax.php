<?php

namespace Kajja\Recorder;

/**
 *
 *  Subclass to make use of the services in the Anax-MVC framework.
 *
 */
class RequestRecordAnax extends RequestRecord
{
    private $di; // Reference to Anax-MVC dependency injector object


    /**
     *
     * @param database handler
     * @param object that formats database records for output
     * @param Anax-MVC dependency injector object
     */
    public function __construct(IDatabaseHandler $dbHandler, IFormatter $formatter, $di)
    {
        $this->dbh = $dbHandler;
        $this->formatter = $formatter;
        $this->di = $di;

        $this->requestInfo['uri'] = $di->request->getRoute;
        $this->requestInfo['method'] = $di->request->getServer('REQUEST_METHOD');
    }


    /**
     * Gets the session id or creates a session unique
     * in the table where the request records are saved.
     *
     * @return session id as string
     */
    private function getSessionId()
    {
        $id = $this->di->session->get('requestRecorderId');

        if ($id == null) {
            $this->di->session->set('requestRecorderId', time()); // Figure out something better than time()
        }

        return $id;
    }
}