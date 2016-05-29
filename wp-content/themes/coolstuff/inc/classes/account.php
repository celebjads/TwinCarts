<?php 
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOPAL Team <help@wpopal.com, info@wpopal.com?>
 * @copyright  Copyright (C) 2015 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/questions/
 */
class Coolstuff_PBR_User_Account{

	/**
	 * @var boolean $ispopup 
	 */
	private $ispopup = true; 

	/**
	 * Constructor 
	 */
	public function __construct(){
		
		add_action('init', array($this,'setup'), 1000);
		add_action( 'wp_ajax_nopriv_pbrajaxlogin',  array($this,'ajaxDoLogin') );
		add_action( 'wp_ajax_nopriv_pbrajaxlostpass',  array($this,'doForgotPassword') );

	}


	/**
	 * process login function with ajax request
	 *
 	 * ouput Json Data with messsage and login status
	 */
	public function ajaxDoLogin(){
		// First check the nonce, if it fails the function will break
   		check_ajax_referer( 'ajax-pbr-login-nonce', 'security_login' );
   		$result = $this->doLogin($_POST['pbr_username'], $_POST['pbr_password'],  isset($_POST['remember']) ); 
   		
   		echo trim($result);
   		die();
	}


	/**
	 * process user login with username/password
	 *
	 * return Json Data with messsage and login status
	 */
	public function doLogin( $username, $password, $remember=false ){
		$info = array();
   		
   		$info['user_login'] = $username;
	    $info['user_password'] = $password;
	    $info['remember'] = $remember;
		
		$user_signon = wp_signon( $info, false );
	    if ( is_wp_error($user_signon) ){
			return json_encode(array('loggedin'=>false, 'message'=>esc_html__('Wrong username or password. Please try again!!!', 'coolstuff')));
	    } else {
			wp_set_current_user($user_signon->ID); 
	        return json_encode(array('loggedin'=>true, 'message'=>esc_html__('Signin successful, redirecting...', 'coolstuff')));
	    }
	}


	/**
	 * process user doForgotPassword with username/password
	 *
	 * return Json Data with messsage and login status
	 */	
	public function doForgotPassword(){
	 
		// First check the nonce, if it fails the function will break
	    check_ajax_referer( 'ajax-pbr-lostpassword-nonce', 'security' );
		
		global $wpdb;
		
		$account = $_POST['user_login'];
		
		if( empty( $account ) ) {
			$error = esc_html__( 'Enter an username or e-mail address.', 'coolstuff' );
		} else {
			if(is_email( $account )) {
				if( email_exists($account) ) 
					$get_by = 'email';
				else	
					$error = esc_html__( 'There is no user registered with that email address.', 'coolstuff' );			
			}
			else if (validate_username( $account )) {
				if( username_exists($account) ) 
					$get_by = 'login';
				else	
					$error = esc_html__( 'There is no user registered with that username.', 'coolstuff' );				
			}
			else
				$error = esc_html__(  'Invalid username or e-mail address.', 'coolstuff' );		
		}	
		
		if(empty ($error)) {
			$random_password = wp_generate_password();

			$user = get_user_by( $get_by, $account );
				
			$update_user = wp_update_user( array ( 'ID' => $user->ID, 'user_pass' => $random_password ) );
				
			if( $update_user ) {
				
				$from = get_option('admin_email'); // Set whatever you want like mail@yourdomain.com
				
				if(!(isset($from) && is_email($from))) {		
					$sitename = strtolower( $_SERVER['SERVER_NAME'] );
					if ( substr( $sitename, 0, 4 ) == 'www.' ) {
						$sitename = substr( $sitename, 4 );					
					}
					$from = 'do-not-reply@'.$sitename; 
				}
				
				$to = $user->user_email;
				$subject = esc_html__( 'Your new password', 'coolstuff' );
				$sender = 'From: '.get_option('name').' <'.$from.'>' . "\r\n";
				
				$message = esc_html__( 'Your new password is: ', 'coolstuff' ) .$random_password;
					
				$headers[] = 'MIME-Version: 1.0' . "\r\n";
				$headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers[] = "X-Mailer: PHP \r\n";
				$headers[] = $sender;
					
				$mail = wp_mail( $to, $subject, $message, $headers );
				if( $mail ) 
					$success = esc_html__( 'Check your email address for you new password.', 'coolstuff' );
				else
					$error = esc_html__( 'System is unable to send you mail containg your new password.', 'coolstuff' );						
			} else {
				$error =  esc_html__( 'Oops! Something went wrong while updating your account.', 'coolstuff' );
			}
		}
	
		if( ! empty( $error ) )
			echo json_encode(array('loggedin'=>false, 'message'=> ($error)));
				
		if( ! empty( $success ) )
			echo json_encode(array('loggedin'=>false, 'message'=> $success ));	
		die();
	}


	/**
	 * add all actions will be called when user login.
	 */
	public function setup(){
		if ( !is_user_logged_in() ) {
			add_action('wp_footer', array( $this,'signin') );
		}
		add_action( 'pbr-account-buttons', array( $this, 'button' ) );

	}

	/**
	 * render link login or show greeting when user logined in
	 *
	 * @return String.
	 */
	public function button(){
		if ( !is_user_logged_in() ) {
			echo '<li><a href="#"  data-toggle="modal" data-target="#modalLoginForm" class="pbr-user-login">'.esc_html__( 'Login', 'coolstuff' ).'</a></li>';
			echo '<li><a href="#"  data-toggle="modal" data-target="#modalRegisterForm" class="pbr-user-register">'.esc_html__( 'Register', 'coolstuff' ).'</a></li>';
		}else {
			return $this->greetingContext();
		}
	}

	/**
	 * check if user not login that showing the form
	 */
	public function signin(){
		if ( !is_user_logged_in() ) {
 			return $this->form();
		}	
	}

	/**
	 * Display greeting words
	 */
	public function greeting(){
		$current_user = wp_get_current_user();
		$link = esc_url(wp_logout_url( home_url() ));
		printf('Greeting %s (%s)', $current_user->user_nicename, '<a href="'.($link).'" title="'.esc_html__( 'Logout', 'coolstuff' ).'">'.esc_html__( 'Logout', 'coolstuff' ).'</a>' );
	}

	/**
	 *
	 */
	public function greetingContext(){
		$current_user = wp_get_current_user();
		$link = esc_url(wp_logout_url( home_url() ));

		echo ' <div class="account-links dropdown">
				  <a href="#" class="dropdown-toggle"  id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				    '.esc_html__( 'Howdy', 'coolstuff').', '.$current_user->user_nicename.'
				    <span class="caret"></span>
				  </a>
				 <a class="signout" href="'.($link).'" title="'.esc_html__( 'Logout', 'coolstuff' ).'">'.esc_html__( 'Logout', 'coolstuff' ).'</a>
				<div class="dropdown-menu">';
				    $args = array(
                        'theme_location'  => 'accountmenu',
                        'container_class' => '',
                        'menu_class'      => 'myaccount-menu'
                    );
                    wp_nav_menu($args);
	 	     
		echo		  '</div>
				</div>';

	}

	/**
	 * render login form
	 */
	public function form(){
		    echo '
			    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="modalLoginForm">
				      <div class="modal-dialog" role="document">
						<div class="modal-content">
						
						<div class="modal-body">';
			
			echo 		'	<div class="inner">
								<button type="button" class="close btn btn-sm btn-primary pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> x </span></button>
					    		<a href="'.esc_url(get_site_url()).'">
										<img class="img-responsive center-image" src="'.get_template_directory_uri().'/images/logo.png" alt="" >
								</a>
						   <div id="pbrloginform" class="form-wrapper"> <form class="login-form" action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">
						     
						    	<p class="lead">'.esc_html__("Hello, Welcome Back!", 'coolstuff').'</p>
							    <div class="form-group">
								    <input autocomplete="off" type="text" name="pbr_username" class="required form-control"  placeholder="'.esc_html__("Username", 'coolstuff' ).'" />
							    </div>
							    <div class="form-group">
								    <input autocomplete="off" type="password" class="password required form-control" placeholder="'.esc_html__("Password", 'coolstuff' ).'" name="pbr_password" >
							    </div>
							     <div class="form-group">
							   	 	<label for="pbr-user-remember" ><input type="checkbox" name="remember" id="pbr-user-remember" value="true"> '.esc_html__("Remember Me", 'coolstuff' ).'</label>
							    </div>
							    <div class="form-group">
							    	<input type="submit" class="btn btn-primary" name="submit" value="'.esc_html__("Log In", 'coolstuff' ).'"/>
							    	<input type="button" class="btn btn-default btn-cancel" name="cancel" value="'.esc_html__("Cancel", 'coolstuff' ).'"/>
							    </div>
					';
					    echo '<p><a href="#pbrlostpasswordform" class="toggle-links" title="'.esc_html__("Forgot Password", 'coolstuff' ).'">'.esc_html__("Lost Your Password?", 'coolstuff' ).'</a></p>';	
					    if(get_option('register_page_id')){ 
					    	echo "<p>".esc_html__('Dont not have an account?', 'coolstuff' )." <a href='".esc_url(get_permalink( get_option('register_page_id') ))."' title='".esc_html__('Sign Up', 'coolstuff' )."'>".esc_html__('Sign Up', 'coolstuff')."</a></p>";	
					    }
						    do_action('login_form');
						    wp_nonce_field('ajax-pbr-login-nonce', 'security_login');
		    echo '</form></div>';
		  	/// reset form ///
		    echo '<div id="pbrlostpasswordform" class="form-wrapper">';
		    print $this->resetForm();
		   	echo '</div>';
		   

		   	///
		    echo '		</div></div></div>
					</div>
				</div>';

			 if (!is_user_logged_in()) :
			    echo '
			    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="modalLoginForm">
				      <div class="modal-dialog" role="document">
						<div class="modal-content"><div class="modal-body">';
							/// register form
					   	echo '<div id="pbrregisterform" class="form-wrapper">';
					   	print $this->registerForm();
			 			echo '</div>';

		  		echo '	</div></div>
					</div>
				</div>';
			endif;	
					
	}
 	
 	public function resetForm() {
		$output = sprintf('
				<form name="lostpasswordform" id="lostpasswordform" class="lostpassword-form" action="%s" method="post">

					<p class="lead">%s</p>
					<div class="lostpassword-fields">
					<p class="form-group">
						<label>%s<br />
						<input type="text" name="user_login" class="user_login form-control" value="" size="20" tabindex="10" /></label>
					</p>',
							site_url('wp-login.php?action=lostpassword', 'login_post'),
							esc_html__('Reset Password', 'coolstuff'),
							esc_html__('Username or E-mail:', 'coolstuff')
						);

						ob_start();
						do_action('lostpassword_form');

						wp_nonce_field('ajax-pbr-lostpassword-nonce', 'security');
						$output .= ob_get_clean();

						$output .= sprintf('
					<p class="submit">
						<input type="submit" class="btn btn-primary" name="wp-submit" value="%s" tabindex="100" />
						<input type="button" class="btn btn-default btn-cancel" value="%s" tabindex="101" />
					</p>
					<p class="nav">
						',
							esc_html__('Get New Password', 'coolstuff'),
							esc_html__('Cancel', 'coolstuff')
							 
							
						);
						$output .= '
					</p>
					</div>
 					<div class="lostpassword-link"><a href="#pbrloginform" class="toggle-links">'.esc_html__('Back To Login', 'coolstuff').'</a></div>
				</form>';

		return $output;
	}

	public function registerForm(){
	?>
	
<div class="container-form">
  
            <?php
            $wpcrl_settings = get_option('wpcrl_settings');
            $form_heading = empty($wpcrl_settings['wpcrl_signup_heading']) ? esc_html__('Register', 'coolstuff') : $wpcrl_settings['wpcrl_signup_heading'];

            // check if the user already login
           

                ?>
                
                <form name="wpcrlRegisterForm" id="wpcrlRegisterForm" method="post">
                	<button type="button" class="close btn btn-sm btn-primary pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                    <h3><?php echo trim($form_heading); ?></h3>

                    <div id="wpcrl-reg-loader-info" class="wpcrl-loader" style="display:none;">
                        <img src="<?php echo (get_template_directory_uri() . '/images/ajax-loader.gif'); ?>" alt=""/>
                        <span><?php esc_html_e('Please wait ...', 'coolstuff'); ?></span>
                    </div>
                    <div id="wpcrl-register-alert" class="alert alert-danger" role="alert" style="display:none;"></div>
                    <div id="wpcrl-mail-alert" class="alert alert-danger" role="alert" style="display:none;"></div>
                    <?php   if( isset($token_verification) && $token_verification ): ?>
                    <div class="alert alert-info" role="alert"><?php esc_html_e('Your account has been activated, you can login now.', 'coolstuff'); ?></div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="wpcrl_fname"><?php esc_html_e('First name', 'coolstuff'); ?></label>
                        <sup class="wpcrl-required-asterisk">*</sup>
                        <input type="text" class="form-control" name="wpcrl_fname" id="wpcrl_fname" placeholder="First name">
                    </div>
                    <div class="form-group">
                        <label for="wpcrl_lname"><?php esc_html_e('Last name', 'coolstuff'); ?></label>
                        <input type="text" class="form-control" name="wpcrl_lname" id="wpcrl_lname" placeholder="Last name">
                    </div>
                    <div class="form-group">
                        <label for="wpcrl_username"><?php esc_html_e('Username', 'coolstuff'); ?></label>
                        <sup class="wpcrl-required-asterisk">*</sup>
                        <input type="text" class="form-control" name="wpcrl_username" id="wpcrl_username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="wpcrl_email"><?php esc_html_e('Email', 'coolstuff'); ?></label>
                        <sup class="wpcrl-required-asterisk">*</sup>
                        <input type="text" class="form-control" name="wpcrl_email" id="wpcrl_email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="wpcrl_password"><?php esc_html_e('Password', 'coolstuff'); ?></label>
                        <sup class="wpcrl-required-asterisk">*</sup>
                        <input type="password" class="form-control" name="wpcrl_password" id="wpcrl_password" placeholder="Password" >
                    </div>
                    <div class="form-group">
                        <label for="wpcrl_password2"><?php esc_html_e('Confirm Password', 'coolstuff'); ?></label>
                        <sup class="wpcrl-required-asterisk">*</sup>
                        <input type="password" class="form-control" name="wpcrl_password2" id="wpcrl_password2" placeholder="Confirm Password" >
                    </div>

                    <input type="hidden" name="wpcrl_current_url" id="wpcrl_current_url" value="<?php echo get_permalink(); ?>" />
                    <input type="hidden" name="redirection_url" id="redirection_url" value="<?php echo get_permalink(); ?>" />

                    <?php
                    // this prevent automated script for unwanted spam
                    if (function_exists('wp_nonce_field'))
                        wp_nonce_field('wpcrl_register_action', 'wpcrl_register_nonce');

                    ?>
                    <button type="submit" class="btn btn-primary">
                        <?php
                        $submit_button_text = empty($wpcrl_settings['wpcrl_signup_button_text']) ? esc_html__('Register', 'coolstuff') : $wpcrl_settings['wpcrl_signup_button_text'];
                        echo trim($submit_button_text);

                        ?></button>
                </form>
                <?php
         
            ?>
</div>

	<?php } 


}

new Coolstuff_PBR_User_Account();
?>