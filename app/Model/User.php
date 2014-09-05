<?php

App::uses('AppModel', 'Model');

class User extends AppModel {

	public $name = "User";

	function beforeSave($options = array()) {

		if (isset($this->data[$this->name]['password'])) {

			$this->data[$this->name]['password'] = AuthComponent::password($this->data[$this->name]['password']);

		}

		return parent::beforeSave();

	}

	function beforeFind($queryData) {

		if (isset($queryData[$this->name]['password'])) {

			$queryData[$this->name]['password'] = AuthComponent::password($this->data[$this->name]['password']);

		}

		return $queryData;
	}

	public $validate = array(

		'email' => array(
			'rule-1' => array(
				'rule' => 'email',
				'message' => 'Please enter a valid email address.'
			),

			'unique' => array(
				'rule'    => 'isUnique',
				'message' => 'This email has already been taken, please try another one.'
			)
		),

		'password' => array(
			'required' => array(
				'rule' => array('minLength', 6),
				'message'=>'Password is required and must be at least 6 characters.'
			),

			'rule-1' => array(
				'rule' => 'alphaNumericBoth',
				'message' => 'Please use both letters and digits for password.'
			)

		),

		'old_password' => array(
			'required' => array(
				'rule' => array('minLength', 6),
				'message'=>'For password update, your current password is required and must be at least 6 characters.'
			),

			'rule-1' => array(
				'rule' => 'alphaNumericBoth',
				'message' => 'Please use both letters and digits for your current password.'
			)

		),

		'new_password' => array(
			'required' => array(
				'rule' => array('minLength', 6),
				'message'=>'For password update, your new password is required and must be at least 6 characters.'
			),

			'rule-1' => array(
				'rule' => 'alphaNumericBoth',
				'message' => 'Please use both letters and digits for your new password.'
			)

		),

		'birth_date' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Birth date is required.'
			),

			'rule-1' => array(
				'rule' => 'date',
				'message' => 'Please enter a valid birth date, e.g. 1994-11-05.'
			),

			'rule-2' => array(
				'rule' => 'birthDateValue',
				'message' => 'Your age should be between 0 to 120.'
			)
		),

		'zipcode' => array(
			'rule-1' => array(
				'rule' => '/^$|^[0-9]{5}$/i',
				'allowEmpty' => true,
				'message' => 'Please enter a valid 5 digits zipcode.'
			)
		)

	);

	public function alphaNumericBoth($check) {

		$value = array_values($check);

		$value = $value[0];

		return (preg_match('/[A-Za-z]/', $value) && preg_match('/[0-9]/', $value));

	}

	public function birthDateValue($check) {

		$valueCount = 0;

		$value = '';

		$match = preg_split('/\D/', $check['birth_date']);

		foreach ($match as $dataValue) {

			if ($dataValue && is_numeric($dataValue)) {

				$value .= $dataValue;

				$valueCount ++;

				if ($valueCount == 3) break;

			}

		}

		$value = intval($value);

		return $value >= gmdate('Ymd') - 1200000 && $value <= gmdate('Ymd');

	}

	public function equalRange($check, $lower, $upper) {

		$value = array_values($check);

		$value = $value[0];

		return $value >= $lower && $value <= $upper;

	}

	/*
	  * Get User By Email
	  *
	  * @desc    Finds the User`s uid, email, sex, birth date, weight, and height by the given Email
	  * @param   String  - User`s Email
	  * @return  Array   - ex. { [User] => ( [id] => 28 ... [created] => 2014-03-14 01:03:23 ), [Token] => ( [0] => Array ( [id] => 34 ... [time] => 2014-03-14 01:03:23 ), [1] => ( ... ) ... )
	  *
	  * */
	public function getUserByEmail($userEmail){
		$conditions =  array('email' => $userEmail);
		return $this->find('first', compact('conditions'));
	}

}