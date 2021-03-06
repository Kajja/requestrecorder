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

        $this->requestInfo['uri'] = $di->request->getCurrentUrl();
        $this->requestInfo['method'] = $di->request->getServer('REQUEST_METHOD');
    }


    /**
     * Gets the session id or creates a session id unique
     * in the table where the requests are saved.
     *
     * @return session id as string
     */
    protected function getSessionId()
    {
        $id = $this->di->session->get('requestRecorderId');

        if ($id == null) {
            $id = time();
            $this->di->session->set('requestRecorderId', $id); // Figure out something better than time()
        }

        return $id;
    }
}