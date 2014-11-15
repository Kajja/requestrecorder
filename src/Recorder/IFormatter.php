<?php

namespace Kajja\Recorder;

/**
 * Interface for classes formatting the records for output.
 *
 */
interface IFormatter
{

	/**
	 * Formats the result from the database.
	 *
	 * @param array with records of requests
	 *
	 * @return output data
	 */
	public function getOutput($records);
}