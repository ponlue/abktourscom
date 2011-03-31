<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php
/**
 * an example URL for viewing a base64-encoded image:
 * http://example.com/decode.php?image/png;base64,iVBORw0KGgoAAAANS...
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

$color1 = $_GET["col1"];
$color2 = $_GET["col2"];
$mid = $_GET["mid"];

ini_set ("session.Save_path", $_SERVER['DOCUMENT_ROOT'] . "/mySessions");
//session_destroy();
//session_start();
if (isset($_SERVER['REMOTE_HOST'])) {
	session_name($_SERVER['REMOTE_HOST'] . "-captcha");
} else {
	session_name(uniqid() . "-captcha");
}
$myCryptBase = "AB0CDE1FG2HIJ3KL4MNO5PQ6RST7UV8WX9YZ";
$capString = "";
$image = imagecreatetruecolor(150, 60);
$white = imagecolorallocate ($image, 255, 255, 255);
$rndm = imagecolorallocate ($image, rand($color1,$color2),  rand($color1,$color2),  rand($color1,$color2));
imagefill ($image, 0, 0, $white);
$fontName = "./arial.ttf";
$myX = 15;
$myY = 30;
$angle = 0;
for ($x = 0; $x <=1000; $x++) {
	$myX = rand(1,148);
	$myY = rand(1,58);
	imageline($image, $myX, $myY, $myX + rand(-5,5), $myY + rand(-5,5), $rndm);
}
for ($x = 0; $x <= 4; $x++) {
	$dark = imagecolorallocate ($image, rand(5,128),rand(5,128),rand(5,128));
	$capChar = substr($myCryptBase, rand(1,35), 1);
	$capString .= $capChar;
	$fs = rand (20, 26);
	$myX = 15 + ($x * 28+ rand(-5,5));
	$myY = rand($fs + 2,55);
	$angle = rand(-30, 30);
	ImageTTFText ($image,$fs, $angle, $myX, $myY, $dark, $fontName, $capChar);
}
$_SESSION["capString$mid"] = $capString;
ob_start();
header ("Content-type: image/jpeg");
imagejpeg($image,"",95);
$result = ob_get_contents();
ob_end_clean();
imagedestroy($image);

echo $result

?>