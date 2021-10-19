<?php

namespace Drupal\student_entry\Controller;
use Drupal\Core\Controller\ControllerBase;

/**
 * Class DisplayTableController.
 *
 * @package Drupal\student_entry\Controller
 */
class StudentEntryValues extends ControllerBase {

	/**
	 * Display.
	 *
	 * @return string
	 *   Return Hello string.
	 */
	public function display() {
		// Fetch data from the employee table.
		$db = \Drupal::database();
		$query = $db->select('studententries', 'n');
		$query->fields('n');
		$response = $query->execute()->fetchAll();
		$rows = [];
		foreach ($response as $row => $content) {
			$rows[] = [
				'data' => [$content->pid, $content->name, $content->age, $content->email_address,
					$content->gender, $content->work_type, $content->terms,
				],
			];
		}

		// Create the header.
		$header = ['pid', 'name', 'age', 'email_address', 'gender',
			'work_type', 'terms',
		];
		$output = [
			// Here you can write #type also instead of #theme.
			'#theme' => 'table',
			'#header' => $header,
			'#rows' => $rows,
			'#cache' => [
				'max-age' => 0,
			],
		];
		return $output;
	}
}