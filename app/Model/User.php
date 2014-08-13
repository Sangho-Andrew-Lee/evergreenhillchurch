<?php

App::uses('AppModel', 'Model');

class User extends AppModel {

	public $name = "User";

	public $hasMany = array(

		'Token' => array(

			'className'     => 'Token',

			'foreignKey'    => 'user_id',

			'dependent'     => true

		)

	);

	function beforeSave($options = array()) {

		if (isset($this->data[$this->name]['password'])) {

			$this->data[$this->name]['password'] = AuthComponent::password($this->data[$this->name]['password']);

		}

		foreach ($this->data[$this->name] as $key => $value) {

			if (in_array($key, array('weight', 'height'))) {

				$this->data[$this->name][$key] = round($value, 2);

			}

		}

		return parent::beforeSave();

	}

	function afterSave($created, $options = array()) {

		if ($created) {

			// Store device id in users_products
			if (isset($this->data['UsersProduct']['device_id'])) {

				$this->UsersProduct = ClassRegistry::init('UsersProduct');

				$existedRow = $this->UsersProduct->find('first', array(
						'conditions' => array(
							'UsersProduct.uid' => $this->data['User']['uid'],
							'UsersProduct.device_id' => $this->data['UsersProduct']['device_id'])
					)
				);

				// Check if this user has registered the product
				if (!$existedRow) {

					$this->UsersProduct->create();
					$this->UsersProduct->save(array(
							'UsersProduct' => array(
								'uid' => $this->data['User']['uid'],
								'device_id' => $this->data['UsersProduct']['device_id'])
						)
					);

				}

			}

		}

		parent::afterSave($created, $options);
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

		'sex' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Gender is required.'
			),

			'rule-1' => array(
				'rule' => '/^$|^(?:m|f)$/i',
				'message' => 'Please enter a valid gender.'
			)
		),

		'weight' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Weight is required.'
			),

			'rule-1' => array(
				'rule' => 'numeric',
				'message' => 'Please enter a valid weight.'
			),

			'rule-2' => array(
				'rule' => array('equalRange', '0', 1500),
				'message' => 'Weight should be from 0 to 1500 (lbs).'
			)
		),

		'height' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Height is required.'
			),

			'rule-1' => array(
				'rule' => 'numeric',
				'message' => 'Please enter a valid height.'
			),

			'rule-2' => array(
				'rule' => array('equalRange', 0, 10),
				'message' => 'Height should be from 0 to 10 (ft).'
			)
		),

		'zipcode' => array(
			'rule-1' => array(
				'rule' => '/^$|^[0-9]{5}$/i',
				'allowEmpty' => true,
				'message' => 'Please enter a valid 5 digits zipcode.'
			)
		),
		'verification_code' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Verification code is required.'
			),
			'rule-1' => array(
				'rule' => '/^[a-zA-z0-9]{6,6}$/i',
				'message' => 'Incorrect Validation Code'
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
	  * Get User By Token User ID
	  *
	  * @desc    Finds the User`s id, Uid, and password by the given User Id
	  * @param   String  - User`s Id
	  * @return  Array   - ex.  array(3) { ["id"] => string(2) "34", ["uid"]=>  string(10) "c11fa3bad2" ["password"]=>  string(40) "e613b38b8478c0c17eef01bb470f146336f6d688" }
	  *
	  * */
	public function getUserUidByUserId($userId){
		$fields = array('User.id', 'User.uid', 'User.password');
		$conditions = array('id' => $userId);

		return $this->find('first',compact('fields', 'conditions'));
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

	/*
	  * Get User By the Uid and Refresh Token
	  *
	  * @desc    Finds the User by the given Refresh_token and the Uid
	  * @param   String  - User`s Refresh_token and User`s Uid
	  * @return  Array   - ex. { [User] => ( [id] => 28 ... [created] => 2014-03-14 01:03:23 ), [Token] => ( [0] => Array ( [id] => 34 ... [time] => 2014-03-14 01:03:23 ), [1] => ( ... ) ... )
	  *
	  * */
	public function getUserByUidAndRefreshToken($userUid, $userRefreshToken){
		$conditions = array('User.uid' => $userUid, 'User.refresh_token' => $userRefreshToken);
		$limit = 1;

		return $this->find('first', compact('conditions', 'limit'));
	}

	/*
	  * Get User By the Validation Code
	  *
	  * @desc    Finds the User by the given Validation Code
	  * @param   String  - Users`s validation_code
	  * @return  Array   - User object
	  *
	  * */
	public function getUserValidate($validation){
		$conditions = array('User.uid' => $validation['uid'],'User.verification_code' => $validation['verification_code']);
		$limit = 1;

		return $this->find('first', compact('conditions', 'limit'));

	}
}