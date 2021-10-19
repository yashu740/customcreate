<?php
namespace Drupal\student_entry\Form;
use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class MydataForm.
 *
 * @package Drupal\student_entry\Form
 */
class studentEntry extends FormBase {
/**
 * {@inheritdoc}
 */
	public function getFormId() {
		return 'student_entry';
	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(array $form, FormStateInterface $form_state) {
		//Fetching from the db for default value

		$form['name'] = [
			'#type' => 'textfield',
			'#title' => t('Name:'),
			'#required' => TRUE,
			//'#default_values' => array(array('id')),
			'#default_value' => 'Name',
		];
		$form['age'] = [
			'#type' => 'textfield',
			'#title' => t('Age'),
			'#size' => 2,
			'#required' => TRUE,
		];
		$form['email_address'] = [
			'#type' => 'email',
			'#title' => $this->t('Email:'),
			'#pattern' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$',
			'#required' => TRUE,
		];
		$form['settings']['gender'] = [
			'#type' => 'radios',
			'#title' => $this->t('Gender'),
			'#options' => [0 => $this->t('Male'), 1 => $this->t('Female')],
		];
		$form['work_type'] = [
			'#type' => 'select',
			'#title' => ('Work Type'),
			'#required' => TRUE,
			'#options' => [
				'it' => t('IT'),
				'bpo' => t('BPO'),
				'government' => t('Government'),
			],
		];
		$form['terms'] = [
			'#type' => 'checkbox',
			'#title' => $this
				->t('Are you sure?'),
		];

		$form['submit'] = [
			'#type' => 'submit',
			'#value' => 'save',
			//'#value' => t('Submit'),
		];
		return $form;
	}
	/**
	 * {@inheritdoc}
	 */
	public function validateForm(array &$form, FormStateInterface $form_state) {
		// Email validation.
		if (!filter_var($form_state->getValue('email_address', FILTER_VALIDATE_EMAIL))) {
			$form_state->setErrorByName('email_address', $this->t('The Email Address you have provided is invalid.'));
		}
		// name validation.
		if (strlen($form_state->getValue('name')) < 10) {
			// Set an error for the form element with a key of "title".
			$form_state->setErrorByName('title', $this->t('The title must be at least 10 characters long.'));
		}
		// Copy terms.
		if (empty($form_state->getValue('terms'))) {
			// Set an error for the form element with a key of "accept".
			$form_state->setErrorByName('terms', $this->t('You must accept the terms field'));
		}
		parent::validateForm($form, $form_state);
	}

	/**
	 * {@inheritdoc}
	 */
	public function submitForm(array &$form, FormStateInterface $form_state) {

		//DB INSERT
		$conn = Database::getConnection();
		$conn->insert('studententries')->fields(
			[
				'name' => $form_state->getValue('name'),
				'age' => $form_state->getValue('age'),
				'email_address' => $form_state->getValue('email_address'),
				'gender' => $form_state->getValue('gender'),
				'work_type' => $form_state->getValue('work_type'),
				'terms' => $form_state->getValue('terms'),
			]
		)->execute();
		// $url = Url::fromRoute('hello.getdetails');
		// $form_state->setRedirectUrl($url);

	}
}