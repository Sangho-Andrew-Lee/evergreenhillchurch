<?php

//Load signup.css to head
echo $this->Html->css('signup');

//Load jquery validate plugin to the bottom_scripts
echo $this->Html->script(
			array(
				'jquery.validate.min.js',
				'users-add.js'
			)
		);
?>

<div id="page-users-add">

	<div class="container">

		<div class="span12 box_wrapper">

			<div class="span12 box"><div>

			<div class="head">

				<h4>Create your account</h4>

			</div>

			<div class="form">

			<?php

			echo $this->Form->create('User', array(

				'id' => 'form-users-add',

				'url' => array('controller' => 'users', 'action' => 'add'),

				'class' => 'form-horizontal',

				'inputDefaults' => array(

					'format' => array('before', 'label', 'between', 'input', 'error', 'after'),

					'div' => array('class' => 'control-group'),

					'label' => array('class' => 'control-label'),

					'between' => '<div class="controls">',

					'after' => '</div>',

					'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))

				)

			));

//			echo $this->Form->input('first_name', array(
//
//				'class' => 'required fistname',
//
//				'label' => array('class' => 'control-label required'),
//
//				'id' => 'form-users-add-first-name',
//
//				'placeholder' => 'First Name'
//
//			));
//
//			echo $this->Form->input('last_name', array(
//
//				'class' => 'required lastname',
//
//				'label' => array('class' => 'control-label required'),
//
//				'id' => 'form-users-add-last-name',
//
//				'placeholder' => 'Last Name'
//
//			));

			echo $this->Form->input('email', array(

				'class' => 'required email',

				'label' => array('class' => 'control-label required'),

				'id' => 'form-users-add-email',

				'placeholder' => 'Email'

			));

			echo $this->Form->input('password', array(

				'class' => 'required',

				'label' => array('class' => 'control-label required'),

				'id' => 'form-users-add-password',

				'minLength' => '6',

				'placeholder' => 'Password'

			));

			echo $this->Form->input('birth_date', array(

				'div' => array('class' => 'control-group age'),

				'label' => array('class' => 'control-label required'),

				'id' => 'form-users-add-age',

				'type' => 'date',

				'dateFormat' => 'YMD',

				'minYear' => date('Y') - 120,

				'maxYear' => date('Y'),

				'monthNames' => false,

				'class' => 'users-birth-date-select'

			));



			echo $this->Form->input('street_address', array(

				'label' => array('class' => 'control-label street-address'),

				'id' => 'form-users-add-street-address',

				'placeholder' => 'Street Address'

			));

			echo $this->Form->input('city', array(

				'label' => array('class' => 'control-label'),

				'id' => 'form-users-add-city',

				'placeholder' => 'City'

			));

			echo $this->Form->input('state', array(

				'div' => array('class' => 'control-group state'),

				'label' => array(

					'class' => 'control-label'

				),

				'id' => 'form-users-add-state',

				'options' => array(
					'' => 'Select',
					'AL' => 'Alabama',
					'AK' => 'Alaska',
					'AZ' => 'Arizona',
					'AR' => 'Arkansas',
					'CA' => 'California',
					'CO' => 'Colorado',
					'CT' => 'Connecticut',
					'DE' => 'Delaware',
					'FL' => 'Florida',
					'GA' => 'Georgia',
					'HI' => 'Hawaii',
					'ID' => 'Idaho',
					'IL' => 'Illinois',
					'IN' => 'Indiana',
					'IA' => 'Iowa',
					'KS' => 'Kansas',
					'KY' => 'Kentucky',
					'LA' => 'Louisiana',
					'ME' => 'Maine',
					'MD' => 'Maryland',
					'MA' => 'Massachusetts',
					'MI' => 'Michigan',
					'MN' => 'Minnesota',
					'MS' => 'Mississippi',
					'MO' => 'Missouri',
					'MT' => 'Montana',
					'NE' => 'Nebraska',
					'NV' => 'Nevada',
					'NH' => 'New Hampshire',
					'NJ' => 'New Jersey',
					'NM' => 'New Mexico',
					'NY' => 'New York',
					'NC' => 'North Carolina',
					'ND' => 'North Dakota',
					'OH' => 'Ohio',
					'OK' => 'Oklahoma',
					'OR' => 'Oregon',
					'PA' => 'Pennsylvania',
					'RI' => 'Rhode Island',
					'SC' => 'South Carolina',
					'SD' => 'South Dakota',
					'TN' => 'Tennessee',
					'TX' => 'Texas',
					'UT' => 'Utah',
					'VT' => 'Vermont',
					'VA' => 'Virginia',
					'WA' => 'Washington',
					'WV' => 'West Virginia',
					'WI' => 'Wisconsin',
					'WY' => 'Wyoming'
				)

			));

			echo $this->Form->input('zipcode', array(

				'label' => array('class' => 'control-label'),

				'id' => 'form-users-add-zipcode',

				'placeholder' => 'Zipcode'

			));

			?>

			<div class="control-group">

				<div class="controls action">

					<?php

					echo $this->Form->button(

						'Sign up',

						array(

							'type' => 'submit',

							'div' => false,

							'class' => 'btn'

						)

					);

					?>

				</div>

			</div>

			<?php echo $this->Form->end(); ?>

			</div>

			</div>

			</div>

			<p class="already">

				Already have an account?

				<?php echo $this->Html->link('Sign in', array('controller' => 'users', 'action' => 'login'), array('title' => 'Sign in')); ?>

			</p>

		</div>

	</div>

</div>