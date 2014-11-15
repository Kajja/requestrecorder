<?php

namespace Kajja\Recorder;

/**
 * Records Http request information in a database for statistical
 * and debug purposes.
 *
 */
class RequestRecord
{
	private $dbh;			// Ref. to database handler implementing Kajja\Recorder\IDatabaseHandler
	private $formatter;		// Ref. to object formatting data output implementing Kajja\Recorder\IFormatter
	private $requestInfo;	// Array with Http-request info

	/**
	 *
	 * @param database handler
	 * @param object that formats database records for output
	 */
	public function __construct(IDatabaseHandler $dbHandler, IFormatter $formatter)
	{
		$this->dbh = $dbHandler;
		$this->formatter = $formatter;

		$this->requestInfo['uri'] = $_SERVER['REQUEST_URI'];
		$this->requestInfo['method'] = $_SERVER['REQUEST_METHOD'];
	}


	/**
	 * Get the session id or creates a session unique
	 * in the table where the request records are saved.
	 *
	 * @return session id as string
	 */
	private function getSessionId()
	{

		if (!isset($_SESSION['requestRecorderId'])) {
			$_SESSION['requestRecorderId'] = time(); // Figure out something better than time()
		}

		return $_SESSION['requestRecorderId'];
	}


	/**
	 *	Save the request to the database.
	 *
	 * @param array with uri:s to ignore i.e. not to store
	 *
	 * @return void
	 */
	public function save($ignore = [])
	{
		$now = date(\DateTime::RFC2822);

		if (!in_array($this->requestInfo['uri'], $ignore)) {

			$this->dbh->insertRecord(['uri', 'method', 'date', 'session'],
				[
					$this->requestInfo['uri'], 
					$this->requestInfo['method'], 
					$now, 
					$this->getSessionId()
			]);
		}
	}


	/**
	 * Get all records in database.
	 *
	 * @return formatted records
	 */
	public function getRecords() 
	{
		$records = $this->dbh->getAllRecords();

		return $this->formatter->getOutput($records);
	}


	/**
	 * Clear the database of all records.
	 *
	 * @return void
	 */
	public function clearRecords() 
	{
		$this->dbh->deleteAll();
	}
}