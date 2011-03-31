<?php
/**
 * Simple File Uploader Module Entry Point
 * 
 * @package    Joomla
 * @subpackage Modules
 * @author Anders Wasén
 * @link http://wasen.net/
 * @license		GNU/GPL, see LICENSE.php
 * mod_simplefileupload is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$session =& JFactory::getSession();
$sfu_version = "1.2";
$sfu_basepath = "modules/mod_simplefileuploadv".$sfu_version."/";


$upload_location = $params->get( 'upload_location', '.'.DS.'images' );
if ( substr( $upload_location , strlen($upload_location) - 1) != DS ) {
  $upload_location .= DS;
}
$upload_maxsize = $params->get( 'upload_maxsize', '100000' );
$upload_bgcolor = $params->get( 'upload_bgcolor', '#e8edf1' );
if ( substr( $upload_bgcolor, 0, 1 ) != "#" ) {
	$upload_bgcolor = "#" . $upload_bgcolor;
}
$upload_capthcaheight = $params->get( 'upload_capthcaheight', '40' );
$upload_capthcawidth = $params->get( 'upload_capthcawidth', '120' );
$upload_popshowpath = $params->get( 'upload_popshowpath', '1' );
$upload_popshowbytes = $params->get( 'upload_popshowbytes', '0' );
$upload_stdbrowse = $params->get( 'upload_stdbrowse', '0' );
$upload_filewidth = $params->get( 'upload_filewidth', '12' );
$upload_popcaptchamsg = $params->get( 'upload_popcaptchamsg', '1' );
$upload_filetypes = $params->get( 'upload_filetypes', '' );
$upload_fileexist = $params->get( 'upload_fileexist', '' );
$upload_email = $params->get( 'upload_email', '' );
$upload_emailmsg = $params->get( 'upload_emailmsg', '0' );
$upload_emailhtml = $params->get( 'upload_emailhtml', '1' );
$upload_capthca = $params->get( 'upload_capthca', '1' );
$upload_capthcacase = $params->get( 'upload_capthcacase', '0' );
$upload_capthcacasemsg = $params->get( 'upload_capthcacasemsg', '0' );
$upload_multi = $params->get( 'upload_multi', '0' );
$upload_maxmulti = $params->get( 'upload_maxmulti', '100' );
$upload_unzip = $params->get( 'upload_unzip', '0' );
$upload_capthcabg = $params->get( 'upload_capthcabg', '120-192' );
$upload_showerrmsg = $params->get( 'upload_showerrmsg', '1' );
$upload_redirect = $params->get( 'upload_redirect', '' );

$upload_showdircontent = $params->get( 'upload_showdircontent', '0' );
$upload_advancedpopup = $params->get( 'upload_advancedpopup', '0' );

$moduleclass_sfx = $params->get('moduleclass_sfx')?$params->get('moduleclass_sfx'):'' ;
// Get user id and check if user is in list
$settingids = $params->get( 'settingids', '' );

// Get current logged in user
$user =& JFactory::getUser();
$usr_id = $user->get('id');
$usr_name = $user->get('username');
//echo $usr_id;

// Get Module ID to create unique names
$mid =$module->id;

$upload_username = $params->get( 'upload_username', '' );
$upload_password = $params->get( 'upload_password', '' );
$_SESSION["upload_username$mid"] = $upload_username;
$_SESSION["upload_password$mid"] = $upload_password;
$session->set( 'upload_username', $upload_username );
$session->set( 'upload_password', $upload_password );

// ++User defined upload
$upload_usernameddir = $params->get( 'upload_usernameddir', '0' );
$upload_usernameddirdefault = $params->get( 'upload_usernameddirdefault', '0' );
$upload_createdir = $params->get( 'upload_createdir', '0' );
$upload_userlocation = $params->get( 'upload_userlocation', '' );
$settingidsund = $params->get( 'settingidsund', '' );
$settingidsudd = $params->get( 'settingidsudd', '' );

//$settingidsuddpath = $params->get( 'settingidsuddpath', '' );

$upload_userpath = array($upload_location);

if (($upload_usernameddir == 1) && ($usr_name != "")) {

	if ( substr( $upload_userlocation , strlen($upload_userlocation) - 1) != DS ) {
		$upload_userlocation .= DS;
	}

	if(is_array($settingidsund)) {
		foreach($settingidsund as $value){
			
			if($value=="[ALL]") {
				$upload_userpath[] = $upload_userlocation.$usr_name.DS;
				break;
			}
			
			if($value==$usr_id) {
				$upload_userpath[] = $upload_userlocation.$usr_name.DS;
				break;
			}

		}
	} else {
		if($settingidsund=="[ALL]") {
			// If all users are to have UDD
			$upload_userpath[] = $upload_userlocation.$usr_name.DS;
		} else {
			if($settingidsund!="") {
				// If only current user uses UDD
				if($settingidsund==$usr_id) {
					$upload_userpath[] = $upload_userlocation.$usr_name.DS;
				}
			}
		}
	}
}


//echo "upload_usernameddirdefault=".$upload_usernameddirdefault." count(upload_userpath)".count($upload_userpath); 
// If Deafult+UND,check if remove Default
	if (($upload_usernameddirdefault == 1) && (count($upload_userpath) == 2)) {
		//We should have Defalut and one UND path, only leave the UND path
		$upload_userpath = array($upload_userpath[1]);
	}

// ++ TEST: USER DEFINED
if(!(is_array($settingidsudd)) && ($settingidsudd != "")) {
	//Make it an array
	$settingidsudd = array("0", $settingidsudd);
}

// It's an array if it's present as value=0 (zero) is default info text. Always skip zero!
	if(is_array($settingidsudd)) {
		foreach($settingidsudd as $value){

			if($value=="0") {
				//nothing
			} else {
				
				//$name_chk = substr($value, 0, strpos($value, ">"));
				$name_chk = explode(">", $value);

				if($name_chk[0]==$usr_name) {
					if ( substr( $name_chk[1] , strlen($name_chk[1]) - 1) != DS ) {
						$name_chk[1] .= DS;
					}
					$upload_userpath[] = $name_chk[1];
				}
			}
		}
	}

// --


//echo $upload_userpath;
if ((count($upload_userpath) == 1) && (isset($_FILES["uploadedfile$mid"]["name"]))) {
	$upload_location = $upload_userpath[0];
} else {
	$idx = 0;
	if (isset($_POST["selpath$mid"])) {
		$idx = $_POST["selpath$mid"];
	}
	$upload_location = $upload_userpath[$idx];
	//Print_R($upload_userpath);
}
// --User defined upload

$upload_users = "false";
		
if(is_array($settingids)) {

	foreach($settingids as $value){
		
		if($value=="[ALL]") {
			$upload_users = "true";
			break;
		}
		
		if($value==$usr_id) {
			$upload_users = "true";
			break;
		}
		
		/*echo "settingids=".$value."<br />";*/
	}
} else {
	if($settingids=="[ALL]") {
		$upload_users = "true";
	} else {
		if($settingids!="") {
			if($settingids==$usr_id) {
				$upload_users = "true";
			}
			/*echo "settingids=".$settingids."<br />";*/
		} else {
			//Allow all users
			$upload_users = "true";
		}
	}
}
// include the helper file
require_once(dirname(__FILE__).DS.'helper.php');

$filename = "";
if (isset($_FILES["uploadedfile$mid"]["name"])) {
	if(is_array($_FILES["uploadedfile$mid"]["name"])) {
		foreach($_FILES["uploadedfile$mid"]["name"] as $value){
			if(strlen($value) > 0) {
				//Check that we have a filename
				$filename = $value;
			}
		}
	}
}

//print_r($_SERVER);

if (strlen($filename) > 0) {
	// get the items to display from the helper
	//echo "CAPTCHA:".$_SESSION["capString"];
	//echo "TEXT:".$_POST["txtsfucaptcha"];
	
	$results = "";
	$_SESSION["uploaderr$mid"] = 0;
	
	if ($upload_createdir == 1) { 
		if (!file_exists($upload_location)) {
			//Create directory if missing
			if (mkdir($upload_location, 0777, true)) {
				//echo "Created dir: " . $upload_location;
				$results = JText::_('NEW_DIR')."<br/>";
				// Add empty HTML page to newly created directory
				$fhIndex = fopen($upload_location . "/index.html", "w") or die("can't open file");
				$stringData = "<html><body bgcolor=\"#FFFFFF\"></body></html>\n";
				fwrite($fhIndex, $stringData);

				fclose($fhIndex);

				
			} else {
				$_SESSION["uploaderr$mid"] = 1;
				$results = JText::_('NEW_DIR_FAILED');
				//echo "Failed to create dir: " . $upload_location;
			}
			
		}
	}
	
	$tmp_upload_capthca = $upload_capthca;

	if ((isset($_POST["txtsfucaptcha$mid"])) && ($tmp_upload_capthca == 1) && (isset($_SESSION["capString$mid"]))) {
		$sessioncapString = $_SESSION["capString$mid"];
		$posttxtsfucaptcha = $_POST["txtsfucaptcha$mid"];
		
		if ($upload_capthcacase == 1) {
			$sessioncapString = strtoupper($sessioncapString);
			$posttxtsfucaptcha = strtoupper($posttxtsfucaptcha);
		}
	
		if ($sessioncapString == $posttxtsfucaptcha) $tmp_upload_capthca = 0;
	}

	
	if ($tmp_upload_capthca == 0) {
		if ($_SESSION["uploaderr$mid"] == 0) {
			$results .= ModSimpleFileUploaderHelperv12::getUploadForm($sfu_basepath, $sfu_version, $upload_location, $upload_maxsize, $upload_filetypes, $upload_fileexist, $upload_users, $upload_email, $upload_emailmsg, $upload_emailhtml, $upload_unzip, $upload_showerrmsg, $upload_showdircontent, $upload_advancedpopup, $upload_popshowpath, $upload_popshowbytes, $moduleclass_sfx, $mid);
		}
	} else {
			
		$_SESSION["uploaderr$mid"] = 1;
		$results = JText::_('FAULTY_CAPTCHA');
	}
	
	//echo "[".$chk_capthca."]";
	
}

// include the template for display
require(JModuleHelper::getLayoutPath('mod_simplefileuploadv'.$sfu_version));

?>
