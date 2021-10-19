<?php

    namespace Drupal\student_entry\Plugin\Block;

    use Drupal\Core\Block\BlockBase;

    /**
     * Provides a 'StudentBlock' block.
     *
     * @Block(
     *   id = "student_entry_block",
     *   admin_label = @Translation("Student Entry block"),
     *   category = @Translation("Student Entry block")
     * )
    */
    class StudentBlock extends BlockBase {

     /**
      * {@inheritdoc}
     */
     public function build() {

       $form = \Drupal::formBuilder()->getForm('Drupal\student_entry\Form\StudentForm');

       return $form;
     }
   }