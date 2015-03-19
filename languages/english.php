<?php

$language = (object) array(

	/* Global */
	'global' => (object) array(

		'submit_button'					=> 'Submit',
		'delete'						=> 'Delete',
		'edit'							=> 'Edit',
		'enable'						=> 'Enable',
		'disable'						=> 'Disable',
		'show_more'						=> 'Show More',
		'language'						=> 'Language',
		'close'							=> 'Close',

		'message_type' => (object) array(
			'error'						=> 'Error !',
			'info'						=> 'Info !',
			'success'					=> 'Success !',
		),

		'info_message' => (object) array(
			'confirm_delete'			=> 'Are you sure you want to delete this ?'
		),

		'success_message' => (object) array(
			'basic'						=> 'Your requested command was performed successfully !'
		),

		'error_message' => (object) array(
			'empty_fields'				=> 'You must fill all the fields !',
			'invalid_captcha'			=> 'The captcha code is not valid !',
			'page_not_found'			=> 'We\'re sorry but we couldn\'t find the page you searched for...',
			'invalid_token'				=> 'We\'re sorry but we couldn\'t perform the action because of the invalid token, please try again !',
			'command_denied'			=> 'You don\'t have access to this command !',
			'page_access_denied'		=> 'You can\'t access this page !'
		),

		'menu' => (object) array(
			'home'						=> 'Home',
			'logout'					=> 'Logout',
			'admin'						=> 'Admin'
		)

	),


	/* Change Password */
	'change_password' => (object) array(

		'title'							=> 'Change Password',
		'menu'							=> 'Change Password',
		'header'						=> 'Change Password',

		'input' => (object) array(
			'current_password'			=> 'Current Password',
			'new_password'				=> 'New Password',
			'repeat_password'			=> 'Repeat Password'
		),

		'error_message' => (object) array(
			'invalid_current_password'	=> 'Your current password is not valid !',
			'short_password'			=> 'Your password is too short, you must have at least 6 characters !',
			'passwords_not_matching'	=> 'Your entered passwords do not match'
		),

		'success_message' => (object) array(
			'password_updated'			=> 'Your password has been updated !'
		)

	),


	/* Reset Password */
	'reset_password' => (object) array(

		'title'							=> 'Reset Password',
		'header'						=> 'Reset Password',

		'input' => (object) array(
			'new_password'				=> 'New Password',
			'repeat_password'			=> 'Repeat Password'
		),

		'error_message' => (object) array(
			'short_password'			=> 'Your password is too short, you must have at least 6 characters !',
			'passwords_not_matching'	=> 'Your entered passwords do not match'
		),

		'success_message' => (object) array(
			'password_updated'			=> 'Your password has been updated !'
		)

	),


	/* Login */
	'login'	=> (object) array(

		'menu'							=> 'Login',
		'title'							=> 'Login',
		'header'						=> 'Login',

		'input' => (object) array(
			'username' 					=> 'Username',
			'password'					=> 'Password',
			'remember_me'				=> 'Remember me'
		),

		'button' => (object) array(
			'login'						=> 'Sign In',
			'lost_password'				=> 'Lost Password',
			'resend_activation'			=> 'Resend Activation'
		),

		'info_message' => (object) array(
			'logged_in'					=> 'Welcome back, you are now logged in !'
		),

		'error_message' => (object) array(
			'wrong_login_credentials'	=> 'Your username - password combination is not valid !',
			'user_not_active'			=> 'Your account is not confirmed or banned !'

		)

	),

	/* Lost Password */
	'lost_password'	=> (object) array(

		'title'							=> 'Lost Password',
		'header'						=> 'Lost Password',

		'input' => (object) array(
			'email' 					=> 'Email',
		),

		'notice_message' => (object) array(
			'success'					=> 'We sent an email to that accounts address if an account is registered with it !',
		),

		'email' => (object) array(
			'title'						=> 'Lost Password',
			'content' 					=> 'We generated a reset password link for your account, dont access the following url if it wasn\'t you! %sreset-password/%s/%s'
		)

	),

	/* Resend Activation */
	'resend_activation'	=> (object) array(

		'title'							=> 'Resend Activation',
		'header'						=> 'Resend Activation Email',

		'input' => (object) array(
			'email' 					=> 'Email',
		),

		'notice_message' => (object) array(
			'success'					=> 'We sent an email to that accounts address if an account is registered with it !'
		),

		'email'	=> (object) array(
			'title'						=> 'Activate your account',
			'content'					=> 'You need to activate your account by accessing the following link: %sactivate/%s/%s'
		)

	),


	/* Register */
	'register' => (object) array(

		'title'							=> 'Register',
		'menu'							=> 'Register',
		'header'						=> 'Register',

		'input' => (object) array(
			'username' 					=> 'Username',
			'name'						=> 'Name',
			'email'						=> 'Email',
			'password'					=> 'Password',
			'repeat_password'			=> 'Repeat Password'
		),

		'error_message' => (object) array(
			'username_length'			=> 'Username must be between 3 and 32 characters !',
			'name_length'				=> 'Name must be between 3 and 32 characters !',
			'user_exists'				=> 'We\'re sorry, but the <strong>%s</strong> username is already taken !',
			'email_exists'				=> 'We\'re sorry, but that email is already used !',
			'invalid_email'				=> 'You entered an invalid email !',
			'short_password'			=> 'Your password is too short, you must have at least 6 characters !',
			'passwords_not_matching'	=> 'Your entered passwords do not match'
		),

		'email'	=> (object) array(
			'title'						=> 'Activate your account',
			'content'					=> 'You need to activate your account by accessing the following link: %sactivate/%s/%s'
		),

		'success_message' => (object) array(
			'registration'				=> 'Your account has been created, check your email for the activation link !'
		)

	),


	/* Home */
	'home' => (object) array(
		'title'							=> 'Home',
		'header'						=> 'Weather for %s',

		'sidebar' => (object) array(
			'latest'					=> 'History',
			'top'						=> 'Top',
			'degree_type'				=> 'Current Degree Type: '
		),

		'tooltip' => (object) array(
			'minimum_temperature'		=> 'Minimum Temperature',
			'maximum_temperature'		=> 'Maximum Temperature',
			'rain_chance'				=> 'Chance of raining',
			'wind'						=> 'Wind',
			'humidity'					=> 'Humidity'
		)
	),


	/* Search */
	'search' => (object) array(
		'title'							=> 'Search',
		'menu'							=> 'Write a location and hit enter..',
		'searching_for'					=> 'Currently searching for <strong>%s</strong>',

		'info_message' => (object) array(
			'no_quotes'					=> 'Sorry, but we couldn\'t find any quotes that are related to your search terms !'
		),

		'error_message' => (object) array(
			'small_query'				=> 'One of your search terms is too small !'
		)
	),


	/* ADMIN Users Management */
	'admin_users_management' => (object) array(

		'title'							=> 'Users Management',
		'menu'							=> 'Users Management',

		'table'	=> (object) array(
			'username'					=> 'Username',
			'email'						=> 'Email',
			'ip'						=> 'IP',
			'registration_date'			=> 'Reg. Date',
			'actions'					=> 'Actions'
		),

		'tooltip' => (object) array(
			'admin'						=> 'Admin',
			'owner'						=> 'Owner'
		),

		'info_message' => (object) array(
			'confirm_delete'			=> 'By deleting this author, all the quotes added by that specific author be deleted !',
		),

		'error_message' => (object) array(
			'self_delete'				=> 'You can\'t delete yourself !',
			'self_status'				=> 'You can\'t change your own status !'
		)

	),


	/* ADMIN User Edit */
	'admin_user_edit' => (object) array(

		'title'							=> 'Edit User',
		'header'						=> 'Edit User',
		'header3'						=> 'Change Password',
		'header3_help'					=> 'Leave it empty if you don\'t want to change the password !',

		'input' => (object) array(
			'username'					=> 'Username',
			'email'						=> 'Email',
			'type'						=> 'Account Type',
			'type_help'					=> '0->Normal User; 1->Admin; 2->Owner',
			'new_password'				=> 'New Password',
			'repeat_password'			=> 'Repeat Password'
		),

		'error_message'	=> (object) array(
			'invalid_account'			=> 'That account wasn\'t found !',
			'email_exists'				=> 'We\'re sorry, but that email is already used !',
			'invalid_email'				=> 'You entered an invalid email !',
			'short_password'			=> 'Your password is too short, you must have at least 6 characters !',
			'passwords_not_matching'	=> 'Your entered passwords do not match'
		)

	),

	/* ADMIN Website Settings */
	'admin_website_settings' => (object) array(

		'title'							=> 'Website Settings',
		'menu'							=> 'Website Settings',
		'header'						=> 'Website Settings',

		'input' => (object) array(
			'title'						=> 'Website title',
			'meta_description'			=> 'Meta Description',
			'analytics_code'			=> 'Analytics Tracking Code',
			'analytics_code_help'		=> 'Example: UA-22222222-33 ( Leave empty if you dont have Googele Analytics )',
			'register'					=> 'Enable registration',
			'contact_email'				=> 'Contact Email',
			'contact_email_help'		=> 'The email that the users get the email from / the \'reply-to\' email ( registration / email activation / lost password )',
			'top_ads'					=> 'Top Ads Code',
			'bottom_ads'				=> 'Bottom Ads Code',
			'side_ads'					=> 'Side Ads Code',
			'social_help'				=> 'Enter only the id / name of the page',
			'facebook'					=> 'Facebook',
			'twitter'					=> 'Twitter',
			'googleplus'				=> 'Google Plus',
			'default_location'			=> 'Default Location',
			'degree_type'				=> 'Default Degree Type',
			'culture'					=> 'Culture ( Language for the Weather API Results )'
		),

		'tab' => (object) array(
			'main'						=> 'Main',
			'weather'					=> 'Weather',
			'ads'						=> 'Ads',
			'social'					=> 'Social'
		)

	)


);

?>
