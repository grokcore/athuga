<?php
	if (empty($_REQUEST['t'])) die();
	session_start(); 

	$authTypes=array(
		'g'=>'Google',
		'f'=>'Facebook',
		't'=>'Twitter'
	);
	$authType=$authTypes[$_REQUEST['t']];

	// config and includes
   	$config = '../hybridauth/config.php';
	require_once( "../hybridauth/Hybrid/Auth.php" );

	try{
		// hybridauth EP
		$hybridauth = new Hybrid_Auth( $config );

		// automatically try to login with Twitter
		$auth = $hybridauth->authenticate( $authType );

		// return TRUE or False <= generally will be used to check if the user is connected to auth before getting user profile, posting stuffs, etc..
		$is_user_logged_in = $auth->isUserConnected();

		// get the user profile 
		$user_profile = $auth->getUserProfile();

		if (isset($_REQUEST['o'])) {
			$auth->logout(); 
			$user_profile=$_SESSION['user']=null;
		}

		if ($user_profile) {
			//require_once("../rest/slimbean/redbean/rb.php");
			$user_profile->type=$_REQUEST['t'];
			$_SESSION['user']=(array)$user_profile;
			//$user=R::find('user',"identifier='_{$_SESSION['user']['identifier']}'");
			//$_SESSION['user']['id']=null;
			$_SESSION['user']['t']=$_REQUEST['t'];
			$_SESSION['user']['identifier']=(string)"_{$_SESSION['user']['identifier']}";
			$_SESSION['user']['type']='user';
		}
		header("Location: {$_REQUEST['r']}");
		// uncomment the line below to post something to auth if you want to
		// $auth->setUserStatus( "Hello world!" );

		// ex. on how to access the auth api with hybridauth
		//     Returns the current count of friends, followers, updates (statuses) and favorites of the authenticating user.
		//     https://dev.auth.com/docs/api/1/get/account/totals
		//$account_totals = $auth->api()->get( 'account/totals.json' );

		// print recived stats 
		//echo "Here some of yours stats on Twitter:<br /><pre>" . print_r( $account_totals, true ) . "</pre>";

	}
	catch( Exception $e ){  
		// In case we have errors 6 or 7, then we have to use Hybrid_Provider_Adapter::logout() to 
		// let hybridauth forget all about the user so we can try to authenticate again.

		// Display the recived error, 
		// to know more please refer to Exceptions handling section on the userguide
		switch( $e->getCode() ){ 
			case 0 : echo "Unspecified error."; break;
			case 1 : echo "Hybridauth configuration error."; break;
			case 2 : echo "Provider not properly configured."; break;
			case 3 : echo "Unknown or disabled provider."; break;
			case 4 : echo "Missing provider application credentials."; break;
			case 5 : echo "Authentification failed. " 
					  . "The user has canceled the authentication or the provider refused the connection."; 
				   break;
			case 6 : echo "User profile request failed. Most likely the user is not connected "
					  . "to the provider and he should to authenticate again."; 
				   $twitter->logout();
				   break;
			case 7 : echo "User not connected to the provider."; 
				   $twitter->logout();
				   break;
			case 8 : echo "Provider does not support this feature."; break;
		} 

		// well, basically your should not display this to the end user, just give him a hint and move on..
		echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();

		echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>"; 

		/*
			// If you want to get the previous exception - PHP 5.3.0+ 
			// http://www.php.net/manual/en/language.exceptions.extending.php
			if ( $e->getPrevious() ) {
				echo "<h4>Previous exception</h4> " . $e->getPrevious()->getMessage() . "<pre>" . $e->getPrevious()->getTraceAsString() . "</pre>";
			}
		*/
	}
