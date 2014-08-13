<?php
class UsersController extends AppController {

	public $name = 'Users';

	public $uses = array('User', 'Token', 'Activity');

	public $components = array('RequestHandler');

	public $paginate = array(

		'User' => array(

			'fields' => array(

				'User.email',

				'User.sex',

				'User.birth_date',

				'User.weight',

				'User.height'
			),

			'order' => array(

				'User.email' => 'asc'
			),

			'limit' => 2

		)

	);

	public function beforeFilter() {

		parent::beforeFilter();

		$this->Auth->allow('index', 'add', 'login', 'logout', 'user', 'resetPassword');

		$this->Cookie->httpOnly = true;

		$this->api = (isset($this->params['api']) && $this->params['api']) ? true : false;

	}

	/*
	  * Users page - a page that lists all the current users
	  * /users/
	  * Pagination: /users/#
	  */
	public function index() {

		//Pagination :page
		$page = 1;

		if (isset($this->params['page']) && intval($this->params['page']) > 1) {

			$page = intval($this->params['page']);

		}

		$this->paginate['User']['page'] = $page;

		//Pagination :sort
		$sort = 'email';

		if (isset($this->params['sort']) && in_array($sort, array('email', 'birth_date', 'sex', 'weight', 'height'))) {

			$sort = $this->params['sort'];

		}

		$direction = 'asc';

		if (isset($this->params['direction']) && in_array($direction, array('asc', 'desc'))) {

			$direction = $this->params['direction'];

		}

		//Special cases
		switch($sort) {

			//If input sort is 'birth_date', then tell the query to use 'birth_date' instead, and switch the given direction
			case 'birth_date':

				$sort = 'birth_date';

				$direction = ($direction == 'asc') ? 'desc' : 'asc';

				break;

		}

		$this->paginate['User']['order'] = array(

			'User.' . $sort => $direction
		);

		$users = $this->paginate('User');

		//Special cases
		switch($sort) {

			//Undo the special case for 'birth_date' above, so the view sees the 'birth_date' and the other direction (for pretty route URL)
			case 'birth_date':

				$sort = 'birth_date';

				$direction = ($direction == 'asc') ? 'desc' : 'asc';

				break;

		}

		//Convert sex character {'m','f'} to word {'Male', 'Female'}
		for ($i = 0; $i < sizeof($users); $i++) {

			$users[$i]['User']['sex'] = ($users[$i]['User']['sex'] == 'm') ? 'Male' : 'Female';

		}

		$this->set(array(

			'users' => $users,

			'pagination' => array(

				'sort' => $sort,

				'direction' => $direction

			)


		));

	}

	/*
	  * /admin/users
	  *
	  * An admin section to view and manage all users
	  */
	public function admin_index() {

		$users = $this->User->find('all');

		$this->set(array(

			'title_for_layout' => 'Admin - User',

			'users' => $users

		));

		$this->layout = 'admin';

	}

	/*
	  * Sign Up module
	  *
	  * API: /api/v#/users/add.json
	  * @param password
	  * @param email
	  * @param birth_date DATE
	  * @param sex {'m', 'f'}
	  * @param weight FLOAT
	  * @param height FLOAT
	  * @param street_address
	  * @param city
	  * @param state
	  * @param zipcode
	  * @param device_id
	  *
	  * Web: /sign-up
	  * @param password
	  * @param email
	  * @param birth_date DATE
	  * @param sex {'m', 'f'}
	  * @param weight FLOAT
	  * @param height FLOAT
	  * @param street_address
	  * @param city
	  * @param state
	  * @param zipcode
	  */
	public function add() {

		//API handler
		if ($this->api) {

			if ($this->request->is('post')) {

				list($errors, $allKeysExist) = $this->Custom->checkPostKeys('required.users.add', $this->request->data);

				$this->request->data['User'] = $this->request->data;

				//Initiate a new DB insert to User model
				$this->User->create();

				//Generate a pseudo unique uid
				$this->request->data['User']['uid'] = substr(sha1(uniqid(mt_rand(), true)), 0, 10);

				$address = array('street_address', 'city', 'state', 'zipcode');

				foreach($address  as $k) {

					if (empty($this->request->data['User'][$k]))
					{

						unset($this->request->data['User'][$k]);

					}

				}

				//Generate a refresh token for the userc
				$this->request->data['User']['refresh_token'] = substr(sha1(uniqid(mt_rand(), true)), 0, 20);

				$this->User->set($this->request->data); //Input POSTed data to User model

				//If User model successfully validated the input data
				if ($allKeysExist && $this->User->validates())
				{

					if (isset($this->User->data['User']['device_id'])) {

						if ($this->User->data['User']['device_id']) {

							$this->User->data['UsersProduct']['device_id'] = $this->User->data['User']['device_id'];

						}

						unset($this->User->data['User']['device_id']);

					}

					//Save data to DB
					if ($this->User->save()) {

						$accessToken = $this->__createAccessToken($this->User->id);

						$response['data'] = array(

							'uid' => $this->request->data['User']['uid'],

							'refresh_token' => $this->request->data['User']['refresh_token'],

							'access_token' => $accessToken['Token']['access_token'],

							'token_time' => $accessToken['Token']['time']

						);

					}

					//Cannot save data
					else

					{

						$this->response->statusCode(500);

						$errors[] = "Cannot save data";

					}

				}

				//Else if validation failed
				else
				{

					$this->response->statusCode(422);

					//Flatten the validation error messages
					$validationErrors = $this->Custom->validationErrorMessages($this->User->validationErrors);

					//Push validation errors to the errors array
					$errors = array_merge($errors, $validationErrors);

				}

			}

			//Set errors block to response
			if (!empty($errors)) {

				$response['errors'] = $errors;

			}

			$this->set(array(

				'response' => $response

			));

		}

		//Web handler
		else
		{

			if ($this->request->is('post')) {

				$this->User->create(); //Initiate a new DB insert

				$this->User->set($this->request->data); //Input POSTed data to User model

				if ($this->User->validates()) { //If User model successfully validated the input data, then INSERT

					//Generate a pseudo unique uid
					$__uid = substr(sha1(uniqid(mt_rand(), true)), 0, 10);

					$this->request->data['User']['uid'] = $__uid;

					//Generate a refresh token for the user
					$this->request->data['User']['refresh_token'] = substr(sha1(uniqid(mt_rand(), true)), 0, 20);

					if ($this->User->save($this->request->data)) {

						//Create an pair of new refresh token and access token
						$this-> __createAccessToken($this->User->id);

						//Email verification
						$user = $this->User->getUserByEmail($this->request->data['User']['email']);

						//Send out activation email
						$result = $this->__sendActivationEmail($user);

						if ($result !== false) {

							$this->Session->setFlash('<a class="close" data-dismiss="alert" href="#">&times;</a>Thank you for signing up with mophie SmartBand. An e-mail has been sent to you with instructions on how to verify your email to activate your account.', 'default', array('class' => 'alert alert-success'));

							$this->redirect(array('controller' => 'users', 'action' => 'login'));

						} else {

							$this->Session->setFlash('<a class="close" data-dismiss="alert" href="#">&times;</a>The account activation code could not be sent. Please contact the administrator.', 'default', array('class' => 'alert alert-error'));

							$this->redirect('/');

						}

					} else {

						$this->Session->setFlash('<a class="close" data-dismiss="alert" href="#">&times;</a>The user could not be saved. Please try again.', 'default', array('class' => 'alert alert-error'));

					}

				}

			}

			$this->set(array(

				'title_for_layout' => 'Smart Band - Sign up'

			));

		}

	}

	/*
	  * Edit Personal Info module
	  *
	  * API: /api/v#/users/edit.json
	  * @param birth_date DATE
	  * @param sex {'m', 'f'}
	  * @param weight FLOAT
	  * @param height FLOAT
	  * @param street_address
	  * @param city
	  * @param state
	  * @param zipcode
	  * @param password
	  * @param current_password
	  */
	public function edit() {

		//API handler
		if ($this->api) {

			if ($this->request->is('post')) {

				list($errors, $allKeysExist) = $this->Custom->checkPostKeys('required.users.edit', $this->request->data);

				//Initialization

				$response = null; //response

				$httpCode = 460; //HTTP code

				//Validate access token
				if (isset($this->request->data['access_token']))
				{

					$httpCode = $this->CustomOauth->authenticateAccessToken($this->request->data['access_token']);

				}
				else
				{

					$httpCode = 422;

					$this->response->statusCode(422);

					$errors[] = "Access token is required for accessing data";

				}

				if ($httpCode == 200)
				{
					$userId  = $this->Token->getUserIdByAccessToken($this->request->data['access_token']);

					$userUid = $this->User->getUserUidByUserId($userId['Token']['user_id']);


					//check if the access_token($this->request->data['access_token']) belongs to this user($this->request->data['uid'])
					if ($userUid &&
						isset($userUid['User']['uid']) &&
						isset($this->request->data['uid']) &&
						$this->request->data['uid'] == $userUid['User']['uid']
						//  &&  $this->request->data['uid'] == $this->Auth->user('uid')
					) {

						$fields = array('birth_date', 'sex', 'weight', 'height', 'street_address', 'city', 'state', 'zipcode');

						foreach($fields as $v) {

							//since some user may only change some of these values ( birth_date, sex, weight, height, street_address, city, state, zipcode ), set the param to $this->request->data['User'] if it is not empty.
							if (!empty($this->request->data[$v]))
							{

								$this->request->data['User'][$v] = $this->request->data[$v];

							}

						}

						if (!empty($this->request->data['password']) || !empty($this->request->data['current_password'])) {

							$this->request->data['User']['new_password'] = empty($this->request->data['password']) ? '' : $this->request->data['password'];

							$this->request->data['User']['old_password'] = empty($this->request->data['current_password']) ? '' : $this->request->data['current_password'];

						}

						$this->request->data['User']['id'] = $userUid['User']['id'];

						$this->User->set($this->request->data['User']); //Input POSTed data to User model



						//If User model successfully validated the input data
						if ($allKeysExist && $this->User->validates())
						{

							if (!empty($this->request->data['User']['new_password']) && !empty($this->request->data['User']['old_password'])) {

								//check if the current_password matches the password in table users for this uid
								if (AuthComponent::password($this->request->data['User']['old_password']) === $userUid['User']['password']) {

									$this->request->data['User']['password'] = $this->request->data['User']['new_password'];

									$this->User->set($this->request->data['User']);

								}
								else {

									$this->response->statusCode(422);

									$errors[] = "Current password does not match.";

								}

							}

							if (empty($errors)) {

								//Save data to DB
								if ($this->User->save()) {

									$this->response->statusCode(200);

								}
								//Cannot save data
								else
								{

									$this->response->statusCode(500);

									$errors[] = "Cannot save data";

								}

							}

						}

						//Else if validation failed
						else
						{

							$this->response->statusCode(422);

							//Flatten the validation error messages
							$validationErrors = $this->Custom->validationErrorMessages($this->User->validationErrors);

							//Push validation errors to the errors array
							$errors = array_merge($errors, $validationErrors);

						}

					}

					//If given uid is not this user's uid (found via given access token)
					else
					{

						$this->response->statusCode(401);

						$response = null;

					}

				}

				//Access code authentication failed
				else if ($httpCode == 460)
				{

					$this->response->statusCode(460);

					$errors[] = "Authenticate access token failed";

				}


				//Set errors block to response, if any
				if (!empty($errors)) {

					$response['errors'] = $errors;

				}

				$this->set(array(

					'response' => $response

				));

			}

		}

	}

	/*
	  * Login module
	  *
	  * API: /api/v#/users/login.json
	  * @param email
	  * @param password
	  *
	  * Web: /login
	  * @param email
	  * @param password
	  */
	public function login() {


		if ($this->request->is('post')) {
			if ($this->Auth->login()) {

				return $this->redirect($this->Auth->redirectUrl());

			} else {

				$this->Session->setFlash('<a class="close" data-dismiss="alert" href="#">&times;</a>Email or password is incorrect. Please try again.', 'default', array('class' => 'alert alert-error'));

			}

		}

		$this->set(array(

			'title_for_layout' => 'Smart Band - Sign in'

		));

	}


	/*
	  * Admin - Handle Login for admins
	  */
	public function admin_login(){

		$this->layout = 'admin';

		if($this->request->is('post')) {

			if($this->Auth->login()) {

				$this->redirect($this->Auth->redirect());

			} else {

				$this->Session->setFlash(__('Invalid email and password, try again'));

			}

		}

	}

	public function logout() {

		$this->redirect($this->Auth->logout());

	}

	/*
	  * Admin - Handler Logout for admins
	  */
	public function admin_logout() {

		$this->redirect($this->Auth->logout());

	}

	/*
	  * User module
	  *
	  * API: /api/v#/users/user.json
	  * @param access_token
	  * @param uid or email
	  *
	  * Web: /user/[email]
	  * @param uid
	  * or, @param email
	  * or, @param email
	  */
	public function user($email = null) {

		//API handler
		if ($this->api) {

			$httpCode = 460;

			if (isset($this->request->data['access_token'])) {

				$httpCode = $this->CustomOauth->authenticateAccessToken($this->request->data['access_token']);

			}

			else
			{

				$httpCode = 422;

				$this->response->statusCode(422);

				$errors[] = "Access token is required for accessing data";

				//Set errors block to response
				if (!empty($errors)) {

					$response['errors'] = $errors;

				}

				$this->set(array(

					'user' => null,

					'response' => $response

				));

			}

			if ($httpCode == 200) {

				//Initiate the errors block
				list($errors, $allKeysExist) = $this->Custom->checkPostKeys('required.users.user', $this->request->data);

				$this->request->data['User'] = $this->request->data;

				$this->User->set($this->request->data); //Input POSTed data to User model

				if (isset($this->request->data['User']['uid'])) {

					$condition = array('User.uid' => $this->request->data['User']['uid']);

				} else if (isset($this->request->data['User']['email'])) {

					unset($this->User->validate['email']['unique']);

					$condition = array('User.email' => $this->request->data['User']['email']);

				}

				//If User model successfully validated the input data
				if ($allKeysExist && $this->User->validates())
				{

					//Query this user
					$user = $this->User->getUserByEmail($condition);

					//If found the user. send it to the view
					if ($user)
					{

						$this->response->statusCode(200);

						//Get the sum of total scores and calories for each user
						$progress = $this->Activity->totalScoresAndCaloriesPerUser($user['User']['uid']);

						$this->set(array(

							'user' => $user,

							'progress' => $progress

						));

					}

					//Else, set 422 logic error for not found the user
					else
					{

						$this->response->statusCode(422);

						$errors[] = "Cannot find this user";

						//Set errors block to response
						if (!empty($errors)) {

							$response['errors'] = $errors;

						}

						$this->set(array(

							'user' => null,

							'response' => $response

						));

					}

				}

				//Else, set 422 logic error and send the validation errors to client
				else
				{

					$this->response->statusCode(422);

					//Flatten the validation error messages
					$validationErrors = $this->Custom->validationErrorMessages($this->User->validationErrors);

					//Push validation errors to the errors array
					$errors = array_merge($errors, $validationErrors);

					//Set errors block to response
					if (!empty($errors)) {

						$response['errors'] = $errors;

					}

					$this->set(array(

						'user' => null,

						'response' => $response

					));

				}


			}

			// Access code authentication failed
			else if ($httpCode == 460)
			{

				$this->response->statusCode(460);

				$errors[] = "Authenticate access token failed";

				//Set errors block to response
				if (!empty($errors)) {

					$response['errors'] = $errors;

				}

				$this->set(array(

					'user' => null,

					'response' => $response

				));
			}

		}

		//Web handler
		else
		{

			//Query this user
			$user = $this->User->getUserByUserEmail($email);

			if ($user) {

				$user['User']['sex'] = ($user['User']['sex'] == 'm') ? 'Male' : 'Female';

				$this->set(array(

					'title_for_layout' => 'User - ' . $user['User']['email'],

					'user' => $user

				));

			} else {

				$this->set(array(

					'title_for_layout' => 'User not found',

					'user' => null

				));

			}

		}

	}

	/*
	  * Reset Password module
	  *
	  * API: /api/v#/users/resetPassword.json
	  * @param email
	  * @param access_token
	  *
	  * Web: /user/reset-password
	  * @param email
	  *
	  * */
	public function resetPassword() {

		if ($this->api) {

			if ($this->request->is('post')) {

				$httpCode = 460;
				$response = null;

				list($errors, $allKeysExist) = $this->Custom->checkPostKeys('required.users.resetPassword', $this->request->data);

				if (isset($this->request->data['access_token']) && $allKeysExist) {

					$httpCode = $this->CustomOauth->authenticateAccessToken($this->request->data['access_token']);

				}
				else {

					$httpCode = 422;

					$this->response->statusCode(422);

					$errors[] = "Access token is required for accessing data";

				}

				if ($httpCode == 200) {

					$this->request->data['User'] = $this->request->data;

					$this->User->set($this->request->data);

					unset($this->User->validate['email']['unique']);

					if ($this->User->validates()) {

						$this->User->clear();

						$user = $this->User->getUserByEmail($this->request->data['email']);

						if ($user) {

							//Update new_email, and generate the new verification code
							$this->User->id = $user['User']['id'];

							$__verificationCode = substr(sha1(uniqid(mt_rand(), true)), 0, 6);

							$data = array(
								'verification_code' => "'" . $__verificationCode . "'",
							);

							if ($this->User->updateAll($data)) {

								$email = trim($user['User']['email']);


								$result = $this->__sendVerificationEmail($email, $__verificationCode);


								if ($result !== false) {

									$this->response->statusCode(200);

								} else {

									$this->response->statusCode(500);

									$errors[] = 'You have to verify your email first.';

								}

							}

						}
						else {

							$this->response->statusCode(422);

							$errors[] = "Cannot find this user";

						}

					}
					else {

						$this->response->statusCode(422);

						//Flatten the validation error messages
						$validationErrors = $this->Custom->validationErrorMessages($this->User->validationErrors);

						//Push validation errors to the errors array
						$errors = array_merge($errors, $validationErrors);

					}

				}

				else if ($httpCode == 460) {

					$this->response->statusCode(460);

					$errors[] = "Authenticate access token failed";

				}
				//Set errors block to response
				if (!empty($errors)) {

					$response['errors'] = $errors;

				}

				$this->set(array(

					'response' => $response

				));
			}


		}

	}

	/*
	  *
	  * Verify
	  *
	  * API: /api/v#/users/verify.json
	  *
	  * @params uid
	  * @params verification_code
	  *
	  *
	  * */
	public function verify() {

		if ($this->api) {

			if ($this->request->is('post')) {

				$response = null;

				list($errors, $allKeyExists) = $this->Custom->checkPostKeys('required.users.verify', $this->request->data);

				if ($allKeyExists && isset($this->request->data['uid']) && isset($this->request->data['verification_code'])) {

					$this->request->data['User'] = $this->request->data;

					$this->User->set($this->request->data['User']);

					if ($this->User->validates()) {

						$this->User->clear();

						$validated = $this->User->getUserValidate($this->request->data['User']);

						if ($validated) {

							$this->response->statusCode(200);

						}
						else {

							$this->response->statusCode(422);

							$errors[] = "Incorrect Validation Code";

						}
					}
					else {

						$this->response->statusCode(422);

						//Flatten the validation error messages
						$validationErrors = $this->Custom->validationErrorMessages($this->User->validationErrors);

						//Push validation errors to the errors array
						$errors = array_merge($errors, $validationErrors);

					}

				}
				else {

					// No keys were present or no data were set in the POST request
					$this->response->statusCode(500);

				}

				//Set errors block to response
				if (!empty($errors)) {

					$response['errors'] = $errors;

				}

				$this->set(array(

					'response' => $response

				));
			}

		}

	}

	/*
	  * Refresh Access Token
	  * Client will eventually hit this function to request a new access token since the current one it has has expired
	  * Usually, the client only need to call this if they received an HTTP code 460 from the previous call
	  *
	  * API: /api/v#/users/refresh-token.json
	  * @param uid
	  * @param refresh_token
	  */
	public function refreshToken() {

		//API handler
		if ($this->api) {

			list($errors, $allKeysExist) = $this->Custom->checkPostKeys('required.users.refreshToken', $this->request->data);

			//Expect uid and refresh_token from client
			if ($allKeysExist && isset($this->request->data['uid']) && isset($this->request->data['refresh_token'])) {

				//Query this user
				$user = $this->User->getUserByUidAndRefreshToken($this->request->data['uid'], $this->request->data['refresh_token']);

				// The refresh token is valid
				if ($user) {

					$this->response->statusCode(200);

					$accessToken = $this->__createAccessToken($user['User']['id']);

					$response['data'] = array(

						'access_token' => $accessToken['Token']['access_token'],

						'token_time' => $accessToken['Token']['time']

					);

				}

				else

				{

					$this->response->statusCode(461);

					$errors[] = "Authenticate refresh token failed";

					//Set errors block to response
					if (!empty($errors)) {

						$response['errors'] = $errors;

					}

				}
			}

			//If there are no uid or refresh_token, throw 422 error code
			else

			{

				$this->response->statusCode(422);

				$errors[] = "Please provide uid and refresh token";

				//Set errors block to response
				if (!empty($errors)) {

					$response['errors'] = $errors;

				}

			}


			$this->set(array(

				'response' => $response

			));

		}
	}

	/*
	  * Social Sync
	  *
	  * API: /api/v#/users/sync.json
	  *
	  * For a single trophy:
	  * @param facebook
	  * @param twitter
	  * @param google
	  * @param linkedin
	  */
	public function sync() {

		//API handler
		if ($this->api) {

			if ($this->request->is('post')) {

				//Initialization
				$errors = array(); //error block

				$response = null; //response

				$httpCode = 460; //HTTP code

				$multiRecords = false; //used for flatten errors

				$facebookId = $twitterId = $googleId = $linkedinId = "";

				//Validate access token
				if (isset($this->request->data['access_token']))
				{

					$httpCode = $this->CustomOauth->authenticateAccessToken($this->request->data['access_token']);

				}

				else
				{

					$httpCode = 422;

					$this->response->statusCode(422);

					$errors[] = "Access token is required for accessing data";

				}

				if ($httpCode == 200) {

					$userId = $this->Token->getUserIdByAccessToken($this->request->data['access_token']);

					$userUid = $this->User->getUserUidByUserId($userId['Token']['user_id']);

					if ($userUid && isset($userUid['User']['uid']) && isset($this->request->data['uid']) && $this->request->data['uid'] == $userUid['User']['uid'] && $this->request->data['uid'] == $this->Auth->user('uid')) {

						if (isset($this->request->data['social'])) {

							//Convert "facebook ids" JSON node to array
							$social = json_decode($this->request->data['social'], true);

							//“Social IDs” is empty or not in json format
							if($social === null) {

								$this->response->statusCode(422);

								$errors[] = "The social IDs are not in JSON format";

							} else {

								$data = array(

									'User' => array()

								);

								$socialTypes = array('facebook', 'twitter', 'google', 'linkedin');

								foreach($socialTypes as $v) {

									if (isset($social[$v]) && isset($social[$v]['id']) && strlen($social[$v]['id']) > 0) {

										$data['User'][$v.'_id'] = $social[$v]['id'];

									}

								}

								if(count($data['User']) > 0) {

									$data['User']['id'] = $userId['Token']['user_id'];

									//Try to validate and save one or multiple records at once
									if ($this->User->save($data)) {

										$this->response->statusCode(200);

									}

									//Cannot save data (Db issues or Validation errors)
									else
									{

										//Flatten the validation error messages
										$validationErrors = $this->Custom->validationErrorMessages($this->User->validationErrors, $multiRecords);

										//If DB issues (empty validation errors), throw a 500 HTTP code, and the error message
										if (empty($validationErrors))
										{

											$this->response->statusCode(500);

											$errors[] = "Cannot save data";

										}

										//Else, validation errors, throw a 422 HTTP code, and set validation error messages to the errors block
										else
										{

											$this->response->statusCode(422);

											//Push validation errors to the errors array
											$errors = array_merge($errors, $validationErrors);

										}

									}

								} else {

									$this->response->statusCode(422);

									$errors[] = "Keys of the social IDs are invalid, only 'facebook', 'twitter', 'google' and 'linkedin' are supported ";

								}

							}

						}

					}

					//If given uid is not this user's uid (found via given access token), or it is not the current logged in user's uid
					else
					{

						$this->response->statusCode(401);

						$response = null;

					}

				}

				//Access code authentication failed
				else if ($httpCode == 460)
				{

					$this->response->statusCode(460);

					$errors[] = "Authenticate access token failed";

				}


				//Set errors block to response, if any
				if (!empty($errors)) {

					$response['errors'] = $errors;

				}

				$this->set(array(

					'response' => $response

				));

			}

		}

	}

	/*
	  * Create a new valid access token and save into DB
	  */
	private function __createAccessToken($uid) {

		$__accessToken = substr(sha1(uniqid(mt_rand(), true)), 0, 20);

		$__time = gmdate("Y-m-d H:i:s", time());

		//create a new access token for the user
		$this->Token->create();

		$this->Token->set(array(

			'Token' => array(

				'user_id' => $uid,

				'access_token' => $__accessToken,

				'time' => $__time

			)

		));

		$this->Token->save();

		$token = $this->Token->getTokenByAccessToken($__accessToken);

		return $token;

	}

	/*
	  * Send Account Activation email
	  */
	private function __sendActivationEmail($user) {

		return true;

		/*
		  App::uses('CakeEmail', 'Network/Email');

		  $validationCode = $this->Auth->password($user['User']['id'] . gmdate("Ymd", time()));

		  $email = new CakeEmail('gmail');

		  $email->template('users-verify', 'outride')

				->emailFormat('both')

				->from(array('outridedev@gmail.com' => 'OutRide.com'))

				->replyTo(array('outridedev@gmail.com' => 'OutRide.com'))

				->to(array($user['User']['email'] => $user['User']['email']))

				->viewVars(array(

				'email' => $user['User']['email'],

				'activationLink' => Router::url(array(

						  'action' => 'verify',

						  'userId' => $user['User']['id'],

						  'validationCodeInput' => $validationCode),

					 true
				)

		  ))

				->subject('OutRide.com - Account Activation');

		  $result = $email->send();

		  return $result;
		  */

	}

	/*
	  * Send Verification Email
	  *
	  * @desc: It sends the verification email to the given users`s email
	  *
	  * @param: email adresss
	  * @param: verification code
	  *
	  *
	  * */
	private function __sendVerificationEmail($emailAddress, $verificationCode) {

		try{

			App::uses('CakeEmail', 'Network/Email');

			$email = new CakeEmail('gmail');

			$email->template('en/reset_password', 'default')
				->emailFormat('both')
				->from(array('noreply@mophie.com' => 'mophie.com'))
				->to($emailAddress)
				->viewVars(array(
					'verificationCode' => $verificationCode,
					'url' => Router::url(
							array(
								'controller' => 'redirector',
								'action' => 'verify',
								$verificationCode
							),
							true)
				))
				->subject(__('mophie.com - space pack - Email Verification'));

			$result = $email->send();

			return $result;

		} catch(SocketException $e) {
			return false;

		}

	}


}