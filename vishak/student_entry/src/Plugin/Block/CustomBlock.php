<?php
/**
 * @file
 * Contains \Drupal\student_entry\Plugin\Block\CustomBlock.
 */

namespace Drupal\student_entry\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Custom' block.
 *
 * @Block(
 *   id = "student_form_block",
 *   admin_label = @Translation("Student Form"),
 *   category = @Translation("Student Form")
 * )
 */

class CustomBlock extends BlockBase {
	/**
	 * {@inheritdoc}
	 */
	public function build() {
		$form = \Drupal::formBuilder()->getForm('Drupal\student_entry\Form\studentEntry');
		return $form;
	}
}