<?php
/**
 * Make mini-controller
 * Anders Wasén, 2010-10-21 for Simple File Upload
 */
 
if( defined( '_JEXEC' ) ) {
	//Do nothing
} else {
	// _JEXEC isn't defined - act as a mini controller
	define( '_JEXEC', 1 );
	define( '_VALID_MOS', 1 );
	// JPATH_BASE should point to Joomla root directory
	define( 'JPATH_BASE', realpath(dirname(__FILE__) .'/../../../' ) );
	define( 'DS', DIRECTORY_SEPARATOR );
	require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
	require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
	$mainframe =& JFactory::getApplication('site');
	$mainframe->initialise();
	$user =& JFactory::getUser();
	$session =& JFactory::getSession();
}

defined('_JEXEC') or die('Restricted access'); // no direct access


$retVal = "false";

if ($_GET["action"] == "sfuuser") {
	$user = $_GET["val1"];
	$pass = $_GET["val2"];
	$mid = $_GET["mid"];

	// TODO: Should I fetch this from DB if session has expired before trying to login... Else it will return failed...
	$session_username = $_SESSION["upload_username$mid"];
	$session_password = $_SESSION["upload_password$mid"];
	
	if ($session_username == "") {
		// Workaround for missing session user... should be from DB I guess...
		$retVal = "Credentials not found. Please refresh your session."; //JText::_('USER PASS MISSING');
		
	} else {
		
		$hashedpw = md5($session_password);
		
		if ((strcmp($user, $session_username) == 0) && (strcmp($pass, $hashedpw) == 0)) {
			$_SESSION["upload_username_ok$mid"] = $hashedpw;
			$retVal = "true";
		} else {
			$retVal = "Username and/or password does not match"; //JText::_('USER PASS FAILED');
		
			/* debug
			$retVal .= "\nGiven user = " . $user;
			$retVal .= "\nGiven pass = " . $pass;
			$retVal .= "\nStored user = " . $session_username;
			$retVal .= "\nStored pass = " . $session_password;
			$retVal .= "\nStored hash = " . md5($session_password);
			*/
		}
	}
}

echo $retVal;

?>