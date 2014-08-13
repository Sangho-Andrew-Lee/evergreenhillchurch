<?php

//Load signin.css to head
$this->Html->css('signin', null, array('block' => 'css'));

//Load jquery validate plugin to the bottom_scripts
$this->Html->script(array('jquery.validate.min.js', 'users-login'), array('block' => 'bottom_scripts'));

?>

<div id="page-users-login">

	<div class="container">

		<div class="span12 box_wrapper">

			<div class="span12 box">

				<div>

					<div class="head">

						<h4>Log in to your account</h4>

					</div>

					<div class="social">

						<a class="face_login" href="#">

                                <span class="face_icon">

                                    <?php echo $this->Html->image('i-face.png', array('alt' => 'fb')); ?>

                                </span>

							<span class="text">Sign in with Facebook</span>

						</a>

						<div class="division">

							<hr class="left">

							<span>or</span>

							<hr class="right">

						</div>

					</div>

					<div class="form">

						<?php

						echo $this->Form->create('User', array(

							'id' => 'form-users-login',

							'url' => array('controller' => 'users', 'action' => 'login'),

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

						echo $this->Form->input('email', array(

							'autocomplete' => 'off',

							'class' => 'required',

							'label' => array('class' => 'control-label required'),

							'id' => 'form-users-login-email',

							'placeholder' => 'Email'

						));

						echo $this->Form->input('password', array(

							'class' => 'required',

							'label' => array('class' => 'control-label required'),

							'id' => 'form-users-login-password',

							'minLength' => '6',

							'placeholder' => 'Password'

						));

						?>

						<div class="remember">

							<div class="left">

								<input id="remember_me" type="checkbox">

								<label for="remember_me">Remember me</label>

							</div>

							<div class="right">

								<a href="reset.html">Forgot password?</a>

							</div>

						</div>

						<div class="control-group">

							<?php

							echo $this->Form->button(

								'Sign in',

								array(

									'type' => 'submit',

									'div' => false,

									'class' => 'btn'

								)

							);

							?>

						</div>

						<?php echo $this->Form->end(); ?>

					</div>

				</div>

			</div>

			<p class="already">Don't have an account?

				<?php echo $this->Html->link('Sign up', array('controller' => 'users', 'action' => 'add'), array('title' => 'Sign up')); ?>

			</p>

		</div>

	</div>

</div>