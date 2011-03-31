<?php

//JPATH_BASE   JPATH_SITE

// no direct access
defined('_JEXEC') or die('Restricted access');

//require_once( JPATH_COMPONENT.DS.'controller.php' );

//JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_attachments'.DS.'tables');

?>

<form action="" method="post" enctype="multipart/form-data">
<p>Arquivo:<input type="file" name="arquivo[]" />
<input name="enviar" type="submit" value="Enviar" />
</p>
</form>

<?php
// Código original no site do PHP
if(isset($_POST['enviar'])){
	$uploads_dir = JPATH_BASE.'/upload/';
	foreach ($_FILES["arquivo"]["error"] as $key => $error) {
	    if ($error == UPLOAD_ERR_OK) {
	        $tmp_name = $_FILES["arquivo"]["tmp_name"][$key];
	        $name = $_FILES["arquivo"]["name"][$key];
	        move_uploaded_file($tmp_name, "$uploads_dir/$name");
	    }else{
	       echo "There was a problem with your upload.";
	       $err_msg = "Unrecognized file POST error: ".$HTTP_POST_FILES['arquivo']['error'];
	       if (!(strpos($err_msg, "\n") === false)) {
	           $err_lines = explode("\n", $err_msg);
	           foreach ($err_lines as $msg) {
	               error_log($msg, 0);
	           }
	       } else {
	           error_log($err_msg, 0);
	       }
		}
	}
}
?>

