<?php

namespace Kajja\Recorder;

/**
 * Class that implements the IFormatter interface
 * and outputs HTML from records of requests.
 *
 */
class HTMLFormatter implements IFormatter
{
	/**
	 * Formats the result from the database as an HTML-table.
	 *
	 * @param array with records of requests
	 *
	 * @return string with output data
	 */
	public function getOutput($records = [])
	{
		$html = '';
		$session = '';

		if (!empty($records)) {

			$html = '<table><thead><tr>';

			$keys = array_keys($records[0]);

			foreach ($keys as $value) {
				$html .= '<th><kbd>' . $value . '</kbd></th>';
			}
			$html .= '</tr></thead><tbody>';

			foreach ($records as $row) {
				$html .= '<tr>';
				foreach ($row as $key => $value) {

					if ($key === 'session') {
						if ($value === $session) {
							$value = '';
						} else {
							$session = $value;
						}
					}
					$html .= '<td><kbd>' . $value . '</kbd></td>';
				}
				$html .= '</tr>';
			}
			$html .= '</tbody></table>';
		}
		return $html;
	}
}