<?php

namespace Drupal\student_entry\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;

/**
* Class SingleForm
*/

class StudentForm extends FormBase{
	public function getFormId(){
		return 'studentform';
	}

	public function buildForm(array $form, FormStateInterface $form_state){
		$form['student_name']=[
			'#type' => 'textfield',
			'#title' => t('Student Name:'),
			'#required' => TRUE,
		];
		$form['student_age']=[
			'#type' => 'textfield',
			'#title' => t('DOB'),
			'#required' => TRUE,
		];
		$form['student_mail'] = [
      		'#type' => 'email',
      		'#title' => t('Email ID:'),
      		'#required' => TRUE,
    	];
    	$form['student_gender'] = [
      		'#type' => 'radios',
      		'#title' => ('Gender'),
      		'#options' => array(
        			'Male' =>t('Male'),
        			'Female' =>t('Female'),
        			'Others' =>t('Others')
      	),
    	];
    	$form['student_work_type'] = [
      		'#type' => 'select',
      		'#title' => ('Work Type'),
      		'#options' => array(
        			'IT' => t('IT'),
        			'BPO' => t('BPO'),
      ),
      ];
       $form['student_terms'] = [
      		'#type' => 'checkbox',
      		'#title' => t('Are you sure?'),
    	];
      $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = [
         '#type' => 'submit',
         '#value' => $this->t('Save'),
       ];
        return $form;
      }
	

public function validateForm(array &$form, FormStateInterface $form_state) {
        // Name validation.
		if (strlen($form_state->getValue('student_name')) < 10) {
			// Set an error for the form element with a key of "title".
			$form_state->setErrorByName('name', $this->t('The name must be at least 10 characters long.'));
		}
		// Email validation.
		if (!filter_var($form_state->getValue('student_mail', FILTER_VALIDATE_EMAIL))) {
			$form_state->setErrorByName('email', $this->t('The Email Address you have provided is invalid.'));
		}
		parent::validateForm($form, $form_state);
      }

public function submitForm(array &$form, FormStateInterface $form_state) {
       $conn = Database::getConnection();
       $conn-> insert('studentvalues')->fields(
       	[
       		'student_name' => $form_state->getValue('student_name'),
       		'student_age' =>  $form_state->getValue('student_age'),
       		'student_mail' => $form_state->getValue('student_mail'),
       		'student_gender' => $form_state->getValue('student_gender'),
       		'student_work_type' => $form_state->getValue('student_work_type'),
       		'student_terms' => $form_state->getValue('student_terms'),
       	]
       )->execute();
    }
    }


