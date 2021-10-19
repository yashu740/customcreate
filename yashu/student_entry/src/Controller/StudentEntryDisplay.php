<?php

namespace Drupal\student_entry\Controller;
use Drupal\Core\Controller\ControllerBase;

/**
 * Class DisplayTableController.
 *
 * @package Drupal\student_entry\Controller
 */
class StudentEntryDisplay extends ControllerBase {

  /**
   * Display.
   *
   * @return string
   *   Return Hello string.
   */
  public function show() {
    // Fetch data from the employee table.
    $db = \Drupal::database();
    $query = $db->select('studentvalues', 'n');
    $query->fields('n');
    $response = $query->execute()->fetchAll();
    $rows = [];
    foreach ($response as $row => $content) {
      $rows[] = [
        'data' => [$content->pid, $content->student_name, $content->student_age, $content->student_mail, $content->student_gender, $content->student_work_type, $content->student_terms
        ],
      ];
    }

    // Create the header.
    $header = ['pid', 'student_name', 'student_age','student_mail','student_gender','student_work_type','student_terms',
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