<?php

namespace Kajja\Recorder;

/**
 * Interface for a RequestRecorder database handler.
 *
 */
interface IDatabaseHandler
{
	/**
	 * Insert a record in the database.
	 *
	 * @param array with the column names where the values is to be inserted
	 * @param array with the values
	 *
	 * @return void
	 */
	public function insertRecord($columns, $values);


	/**
	 * Get all the records from the records database table.
	 *
	 * @return array with all the records in the database
	 */
	public function getAllRecords();


	/**
	 * Delete all records in the records database table.
	 *
	 * @return void
	 */
	public function deleteAll();
}