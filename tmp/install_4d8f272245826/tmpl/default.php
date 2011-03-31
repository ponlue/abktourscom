<?php defined('_JEXEC') or die('Restricted access'); // no direct access ?>
<?php error_reporting (E_ALL ^ E_NOTICE); ?>

<?php
// Server redirect if user has opted to
if (isset($_FILES["uploadedfile$mid"]["name"])) {
	if ($_FILES["uploadedfile$mid"]["name"] > 0) {
		if ((strlen($upload_redirect) > 0) && ($_SESSION["uploaderr$mid"] != 1)) {
			header('Location: '.$upload_redirect);
			exit();
		}
	}
}

$document =& JFactory::getDocument();
$document->addStyleSheet( JURI::root().$sfu_basepath."mod_simplefileupload.css" );
$document->addStyleSheet( JURI::root().$sfu_basepath."tmpl/fancybox/jquery.fancybox-1.3.1.css" );
$document->addStyleSheet( JURI::root()."media/system/css/modal.css" );
// FancyBox
$document->addScript( JURI::root().$sfu_basepath."tmpl/fancybox/jquery-1.4.2.min.js" );
$document->addCustomTag( '<script type="text/javascript">jQuery.noConflict();</script>' );
$document->addScript( JURI::root().$sfu_basepath."tmpl/fancybox/jquery.mousewheel-3.0.2.pack.js" );
$document->addScript( JURI::root().$sfu_basepath."tmpl/fancybox/jquery.fancybox-1.3.1.js" );
$document->addScript( JURI::root().$sfu_basepath."tmpl/md5-min.js" );
//$document->addScript( JURI::root()."media/system/js/modal.js");
JHTML::_('behavior.modal');

// Get CAPTCHA BG color
if ($upload_capthcabg != "") {
	$bgcolor = explode('-', $upload_capthcabg);
	if(!is_array($bgcolor)) {
		$bgcolor = array(0 => "120", 1 => "192");
	} else {
		if (!is_numeric($bgcolor[0])) $bgcolor[0] = "120";
		if (!is_numeric($bgcolor[1])) $bgcolor[1] = "192";
	}
} else {
	$bgcolor = array(0 => "120", 1 => "192");
}

if ($upload_users == "true") {
?>
	
<!-- use different getImageSrc function for IE
	 - which can't parse base64-encoded images
	 -->
<script type="text/javascript">
	function getImageSrc<?php echo $mid ?>(base64Src)
	{ return base64Src; }
</script>
<!--[if gte IE 5]>
	<script type="text/javascript">
		function getImageSrc<?php echo $mid ?>(base64Src)
		{ return "<?php echo JURI::root().$sfu_basepath;?>tmpl/sfuieimgfix.php";}
	</script>
<![endif]-->


<script language="javascript" type="text/javascript">
<!--
// Check to see if we are not logged in and a user/pass is required
<?php if (($upload_username != "") && ($usr_id == 0) && (strcmp($_SESSION["upload_username_ok$mid"], md5($upload_password)) != 0)) { ?>
	var upload_username<?php echo $mid ?> = 1;
<?php } else { ?>
	var upload_username<?php echo $mid ?> = 0;
<?php } ?>

var AjaxretVal<?php echo $mid ?> = "";

function showProgress<?php echo $mid ?>() {
	if (document.getElementById("txtUploadFile<?php echo $mid ?>").value == "") {
		return false;
	}
	
	if (!(selPathSet<?php echo $mid ?>) && (document.getElementById("div_simplefileuploadpaths<?php echo $mid ?>").style.display=="block")) {
		//alert("You must select a path to upload to!");
		alert("<?php echo JText::_('ADD_PATH'); ?>");
		return false;
	}
	
	// Check user
	if (upload_username<?php echo $mid ?> == 1) {
		chkUserPass<?php echo $mid ?>();
		if (AjaxretVal<?php echo $mid ?> != "true") return false;
	}
		
	// Check multiple paths?
	if (selPath<?php echo $mid ?> == -1) {
		document.getElementById("div_simplefileuploadpaths<?php echo $mid ?>").style.display="block";
	} else {

		document.getElementById("div_simplefileuploadpaths<?php echo $mid ?>").style.display="none";

		SqueezeBox.open($("div_simplefileuploadprocess<?php echo $mid ?>"), {
			handler: "adopt",
			size: {x: 230, y: 160},
			onClose: function() {
				alert("<?php echo JText::_('NAV_INTERRUPTED'); ?>");
			}
		});
		
		
		document.forms["frm_sfu<?php echo $mid ?>"].submit();
	}

}

function userLogin<?php echo $mid ?>() {
	var tr = document.getElementsByTagName('tr');
	//var trLogin = document.getElementsByName('logintr');
	//var trUpload = document.getElementsByName('uploadtr');
	var dispLogin = "none";
	var dispUpload = "none";
	
	resetProgress<?php echo $mid ?>();

	if (upload_username<?php echo $mid ?> == 0) {
		dispUpload = "block";
	} else {
		dispLogin = "block";
	}

	for ( var j = 0; j < tr.length; j++ ) {
		if (tr[j].className == "logintr<?php echo $mid ?>") tr[j].style.display = dispLogin;
		if (tr[j].className == "uploadtr<?php echo $mid ?>") tr[j].style.display = dispUpload;
	}

}

function hidePopUp<?php echo $mid ?>() {
	document.getElementById("div_simplefileuploadmsg<?php echo $mid ?>").style.display="none";
}

function getScrollY<?php echo $mid ?>() {
  var scrOfY = 0;
  if( typeof( window.pageYOffset ) == 'number' ) {
    //Netscape compliant
    scrOfY = window.pageYOffset;
  } else if( document.body && document.body.scrollTop ) {
    //DOM compliant
    scrOfY = document.body.scrollTop;
  } else if( document.documentElement && document.documentElement.scrollTop ) {
    //IE6 standards compliant mode
    scrOfY = document.documentElement.scrollTop;
  }
  
  return scrOfY;
}

function addFile<?php echo $mid ?>() {

	var tab = document.getElementById('sfuContentTblInner<?php echo $mid ?>');
	var rowcnt=tab.rows.length;
	
	if (rowcnt >= <?php echo $upload_maxmulti; ?>) {

		alert("<?php echo JText::_('MAX_MULTI_REACHED'); ?>");
		return false;
	}
	
	var clone=tab.getElementsByTagName('tr')[0].cloneNode(true);//the clone of the first row

	tab=document.getElementById('sfuContentTblInner<?php echo $mid ?>').insertRow(-1);
	var y=tab.insertCell(0);
	var cont=clone.innerHTML;


	<?php if ($upload_stdbrowse == 0) { ?>
	cont=cont.replace(/fakefileinput/g,"fakefileinput"+rowcnt);
	<?php } else { ?>
	//Move the textbox to the left
	cont=cont.replace(/-1px/g,"-3px");
	<?php } ?>

	y.innerHTML=cont;
}

function reloadCaptcha<?php echo $mid ?>(el) {
	var date = new Date();
	var tmp = "?v=" + date.getTime();
	var col1 = "<?php echo $bgcolor[0];?>";
	var col2 = "<?php echo $bgcolor[1];?>";
	tmp += "&mid=<?php echo $mid ?>&col1=" + col1 + "&col2=" + col2;
//alert(tmp);
	var cap = document.getElementById(el);
	cap.setAttribute("src", "<?php echo JURI::root().$sfu_basepath;?>tmpl/sfuieimgfix.php" + tmp);
}

function chkUserPass<?php echo $mid ?>() {

	var user = document.getElementById('txtUploadUser<?php echo $mid ?>').value;
	var pass = document.getElementById('txtUploadPass<?php echo $mid ?>').value;
	
	var hash = hex_md5(pass);

	//alert("Give user and pass: " + user + "/" + hash);

	document.getElementById("popProgress<?php echo $mid ?>").innerHTML = "<?php echo JText::_('CHK_CREDENTIALS'); ?>";
	document.getElementById("div_simplefileuploadprocess<?php echo $mid ?>").style.display="block";
	
	makeRequest<?php echo $mid ?>("sfuuser", user, hash);
	
	setTimeout('waitForAjax<?php echo $mid ?>(0)', 500);
	
}

function waitForAjax<?php echo $mid ?>(no) {
	no += 1;
	
	if (no >= 10) {
		alert("<?php echo JText::_('FAIL_CREDENTIALS'); ?>");
		return false;
	}
	
	if ((AjaxretVal<?php echo $mid ?> == "") && (no<10)) {
		setTimeout('waitForAjax<?php echo $mid ?>()', 500);
	} else {
		if (AjaxretVal<?php echo $mid ?> == "true") {
		//if usr/pass matches
			upload_username<?php echo $mid ?> = 0;
			userLogin<?php echo $mid ?>();
		} else {
			resetProgress<?php echo $mid ?>();
			alert(AjaxretVal<?php echo $mid ?>);
		}
	}
}

function resetProgress<?php echo $mid ?>() {
	document.getElementById("div_simplefileuploadprocess<?php echo $mid ?>").style.display="none";
	document.getElementById("popProgress<?php echo $mid ?>").innerHTML = "<?php echo JText::_('UPLOADING'); ?>";
}
	
//    xhr.open("GET","<?php echo JURI::root().$sfu_basepath;?>tmpl/sfuajax.php?action=" + oper + "&val1=" + val1 + "&val2=" + val2, true);
var http_request<?php echo $mid ?> = false;
   function makeRequest<?php echo $mid ?>(oper, val1, val2) {
      http_request<?php echo $mid ?> = false;
      if (window.XMLHttpRequest) { // Mozilla, Safari,...
         http_request<?php echo $mid ?> = new XMLHttpRequest();
         if (http_request<?php echo $mid ?>.overrideMimeType) {
            http_request<?php echo $mid ?>.overrideMimeType('text/plain');
         }
      } else if (window.ActiveXObject) { // IE
         try {
            http_request<?php echo $mid ?> = new ActiveXObject("Msxml2.XMLHTTP");
         } catch (e) {
            try {
               http_request<?php echo $mid ?> = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
         }
      }
      if (!http_request<?php echo $mid ?>) {
         alert('Cannot create XMLHTTP instance');
         return false;
      }
      http_request<?php echo $mid ?>.onreadystatechange = alertContents<?php echo $mid ?>;
      http_request<?php echo $mid ?>.open("GET","<?php echo JURI::root().$sfu_basepath;?>tmpl/sfuajax.php?action=" + oper + "&mid=<?php echo $mid ?>&val1=" + val1 + "&val2=" + val2, true);
      http_request<?php echo $mid ?>.send(null);
   }

   function alertContents<?php echo $mid ?>() {
      if (http_request<?php echo $mid ?>.readyState == 4) {

         if (http_request<?php echo $mid ?>.status == 200) {
            AjaxretVal<?php echo $mid ?> = http_request<?php echo $mid ?>.responseText;
         } else {
            alert('<?php echo JText::_('FAIL_REQUEST'); ?>');
         }
      }
   }

var selPath<?php echo $mid ?> = -1;
var selPathSet<?php echo $mid ?> = false;

function getCheckedValue<?php echo $mid ?>(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			selPath<?php echo $mid ?> = radioObj.value;
		else
			selPath<?php echo $mid ?> = "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			selPath<?php echo $mid ?> = radioObj[i].value;
		}
	}
	selPathSet<?php echo $mid ?> = true;
}

// TEST Multi SELECT in FireFox 3.6+
function listFiles<?php echo $mid ?>() {


	try {
			var input = document.querySelector("input[type='file']");
			// Only if more than one selected!
			if (input.files.length > 1) {
				var ul = document.querySelector("#bag<?php echo $mid ?>>ul");
				while (ul.hasChildNodes()) {
					ul.removeChild(ul.firstChild);
				}
				for (var i = 0; i < input.files.length; i++) {
					var li = document.createElement("li");
					li.innerHTML = "<b>* " + input.files[i].name + "</b>";
					
					ul.appendChild(li);
					document.getElementById("trfileList<?php echo $mid ?>").style.display="block";
				}
			}
	
	} catch(e) {
		// Just ignore, not supported browser
	}
}

-->
</script>

<style>
	.sfu_table {
		border-bottom: none !important;
		border-left: none !important;
		border-right: none !important;
		border-top: none !important;
	}
	
	.logintr<?php echo $mid ?> {
		border-bottom: none !important;
		border-left: none !important;
		border-right: none !important;
		border-top: none !important;
	}
	
	.uploadtr<?php echo $mid ?> {
		border-bottom: none !important;
		border-left: none !important;
		border-right: none !important;
		border-top: none !important;
	}

</style>


<!--div id="div_simplefileuploadoverlay" style="position:absolute;left:0;top:0;visibility: hidden; width:100%; height:100%; background-color:#ffffff; filter:alpha(opacity=60); -moz-opacity: 0.6; opacity: 0.6;"-->
<div id="div_simplefileuploadoverlay<?php echo $mid ?>" style="margin: 0 auto; top: 0px; bottom: 0px; left: 0px;width: 100%;height: 100%;background: #ffffff;opacity: 0.79;-ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=79);filter: alpha(opacity=79);-moz-opacity: 0.79;z-index: 19; visibility: hidden; position: absolute;"></div>

<!--div id="div_simplefileuploadprocess<?php echo $mid ?>" class="sfu_content" style="position: absolute; display: none; background: <?php echo $upload_bgcolor ?>; text-align: center; border: 1px outset white; z-index: 20; left: 50%; top: 50%; margin-top: -110px; margin-left: -110px; width: 220px;"-->
<div style="display: none;">
<div id="div_simplefileuploadprocess<?php echo $mid ?>" style="text-align: center; width: 220px;">
	<table class="sfu_table" border="0" style="width: 220px; margin-top: 40px; margi-left: 30px;">
		<tr class="sfu_table">
			<td class="sfu_table" id="popProgress<?php echo $mid ?>" style="text-align: center;">
				<?php echo JText::_('UPLOADING'); ?>
			</td>
		</tr>
		<tr class="sfu_table">
			<td class="sfu_table" style="text-align: center;">
				<img src="<?php echo JURI::root().$sfu_basepath;?>images/bigrotation2.gif" />
			</td>
		</tr>
		<tr class="sfu_table">
			<td class="sfu_table" style="text-align: center;">
				<?php echo JText::_('PLEASE_WAIT'); ?>
			</td>
		</tr>
	</table>
</div>
</div>

<table class="sfu_table" style="border: 1px solid red;" border="0" cellspacing="0" cellpadding="0">
<tr class="sfu_table">
<td class="sfu_table">

<form id="frm_sfu<?php echo $mid ?>" enctype="multipart/form-data" action="" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $upload_maxsize;?>" />

<div>
	<table class="sfu_table" id="sfuContentTbl<?php echo $mid ?>" border="0" cellpadding="0" cellspacing="0">
		
		<?php if (($upload_username != "") && ($usr_id == 0) && (strcmp($_SESSION["upload_username_ok$mid"], md5($upload_password)) != 0)) { 
			$divUploadShow = "none";
		
		?>
		<tr class="logintr<?php echo $mid ?>"><td class="sfu_table"><?php echo JText::_('FILE_LABEL'); ?></td></tr>
		<tr class="logintr<?php echo $mid ?>">
			<td class="sfu_table" colspan="2">
<!-- Added position:relative DIV due to IE bug -->
				<div style="position: relative;">
					<div id="div_simplefileuploaduser<?php echo $mid ?>" class="sfu_content" style="position: relative; width: 150px; padding: 10px 30px; margin: 10px auto; left: -28px; top:0px; display: block; background: <?php echo $upload_bgcolor ?>; text-align: left; border: 1px outset white; z-index: 20;">
						<table border=0 style="width: 100%;">
							<tr><td class="sfu_table" colspan="2" style="padding-bottom: 10px;"><b><?php echo JText::_('UPLOAD_USER'); ?></b></td></tr>
							<tr><td class="sfu_table"><?php echo JText::_('USERNAME'); ?></td><td><input type="text" style="width: 71px;" size="10" id="txtUploadUser<?php echo $mid ?>" /></td></tr>
							<tr><td class="sfu_table"><?php echo JText::_('PASSWORD'); ?></td><td><input type="password" style="width: 70px;" size="10" id="txtUploadPass<?php echo $mid ?>" /></td></tr>
							<tr><td class="sfu_table" colspan="2" style="text-align: right;"><input type="button" value="OK" onclick="javascript:chkUserPass<?php echo $mid ?>();" /></td></tr>
						</table>
					</div>
				</div>
			</td>
		</tr>
		<?php } else {
				$divUploadShow = "block";
			}

		?>
		<tr class="uploadtr<?php echo $mid ?>" style="display: <?php echo $divUploadShow; ?>">
			<td class="sfu_table"><?php echo JText::_('FILE_LABEL'); ?> <?php if ($upload_multi == 1) { ?><span style="cursor: hand; cursor: pointer;" onclick="javascript:addFile<?php echo $mid ?>()"><b>[&nbsp;+&nbsp;]</b></span> <?php } ?></td>
		</tr>
		<tr class="uploadtr<?php echo $mid ?>" style="display: <?php echo $divUploadShow; ?>">
			<td class="sfu_table">


				<table class="sfu_table" id="sfuContentTblInner<?php echo $mid ?>" border="0" cellpadding="0" cellspacing="0">
				<tr class="sfu_table"><td class="sfu_table">
				<?php if ($upload_stdbrowse == 0) { ?>



						<div style="position: relative; height: 24px; white-space: nowrap; overflow: hidden;">
							<input id="fakefileinput<?php echo $mid ?>" style="position: relative; width: 98px; z-index: 1; top: -8px;" />&nbsp;<img style="position: relative; z-index: 1; top: -5px;" src="<?php echo JURI::root().$sfu_basepath;?>images/button_select.gif" />

							<span  style="position: relative; left: -171px; top: 0px; height: 24px; z-index: 10; top: -7px;">

							<input type="file" id="txtUploadFile<?php echo $mid ?>" name="uploadedfile<?php echo $mid ?>[]" size=12 style="width: 160px; z-index: 10; -moz-opacity: 0; filter:alpha(opacity: 0); opacity: 0;" multiple="" onchange="javascript: listFiles<?php echo $mid ?>(); document.getElementById('fakefileinput<?php echo $mid ?>').value=this.value;" />
							</span>




						</div>

				<?php } else { ?>
					<input type="file" id="txtUploadFile<?php echo $mid ?>" name="uploadedfile<?php echo $mid ?>[]" size="<?php echo $upload_filewidth; ?>" style="position: relative; left: -1px;" multiple="" onchange="javascript: listFiles<?php echo $mid ?>();" />
				<?php } ?>


				</td></tr>
				</table>
			</td>
		</tr>
		<tr class="sfu_table" id="trfileList<?php echo $mid ?>" style="display: none;">
			<td class="sfu_table">
				<div id="bag<?php echo $mid ?>"><ul/></div>
			</td>
		</tr>
	

	<?php if ($upload_capthca == 1) { ?>
		<tr class="uploadtr<?php echo $mid ?>" style="display: <?php echo $divUploadShow; ?>">
			<td class="sfu_table">
				<span id="sfucaptcha<?php echo $mid ?>"><img id="sfuCaptchaImg<?php echo $mid ?>" width="<?php echo $upload_capthcawidth;?>" height="<?php echo $upload_capthcaheight;?>" src="data:image/jpeg;base64,<?php echo ModSimpleFileUploaderHelperv12::getCaptcha($sfu_version, $bgcolor, $mid);?>" /></span><a href="#" onclick="javascript: reloadCaptcha<?php echo $mid ?>('sfuCaptchaImg<?php echo $mid ?>');"><img height="24px" src="<?php echo JURI::root().$sfu_basepath;?>images/button_refresh.gif" alt="Refresh Captcha" /></a>
				
				<?php if (($upload_capthcacasemsg == 1) && ($upload_capthcacase == 1)) { ?>
				<br/>
				<span style="font-size: 7pt;" ><?php echo JText::_('CASE_INSENSITIVE'); ?></span>
				<?php } ?>
			</td>
		</tr>
		
		<tr class="uploadtr<?php echo $mid ?>" style="display: <?php echo $divUploadShow; ?>">
			<td class="sfu_table">
				<nobr>
				<?php echo JText::_('CAPTCHA_LABEL'); ?>:&nbsp;
				<input type="text" name="txtsfucaptcha<?php echo $mid ?>" id="contact_captcha<?php echo $mid ?>" value="" maxlength="10" style="width: 80px;" />
				</nobr>
			</td>	
		</tr>
	<?php
	}
	?>
		<tr class="uploadtr<?php echo $mid ?>" style="display: <?php echo $divUploadShow; ?>">
			<td class="sfu_table" style="padding-top: 5px;">
				<input type="button" style="" onclick="javascript:showProgress<?php echo $mid ?>();" value="<?php echo JText::_('UPLOAD_BUTTON_TEXT'); ?>" />
				
				<?php if (is_array($upload_userpath)) { 
						if (count($upload_userpath) > 1) {
				?>
				<div id="div_simplefileuploadpaths<?php echo $mid ?>" class="sfu_content" style="padding: 10px 30px; margin: 10px auto; position: relative; left:-20px; top:-50px; display: none; background: <?php echo $upload_bgcolor ?>; text-align: left; border: 1px outset white; z-index: 20;">
					<table class="sfu_table" border=0 style="width: 100%;">
						<tr class="sfu_table"><td class="sfu_table" colspan="2"><nobr><u><?php echo JText::_('SELECT_DIR'); ?>:</u></nobr></td></tr>
						<?php
						$ix = 0;
						foreach ($upload_userpath as $path) {
							
							echo "<tr class=\"sfu_table\"><td class=\"sfu_table\"><input type=\"radio\" name=\"selPath<?php echo $mid ?>\" value=\"".$ix."\" onclick=\"javascript:getCheckedValue".$mid."(this);\" /></td><td class=\"sfu_table\"><nobr>".$path."</nobr></td></tr>";
							$ix += 1;
						}
						?>
						<tr class="sfu_table"><td class="sfu_table" colspan="2" style="text-align: right;"><input type="button" value="Ok" onclick="javascript:showProgress<?php echo $mid ?>();" /></td></tr>
					</table>
				</div>
				<?php 
					} else {
						?>
						<div id="div_simplefileuploadpaths<?php echo $mid ?>" style="display: none;">
						</div>
				
						<script language="javascript" type="text/javascript">
							var selPath<?php echo $mid ?> = 0;
						</script>
						<?php
					}
				}
				?>

			</td>
		</tr>
	</table>

</div>

</form>

</td>
</tr>

<?php
if (isset($_FILES["uploadedfile$mid"]["name"])) {
	if ($_FILES["uploadedfile$mid"]["name"] > 0) {

?>

<tr class="sfu_table">
<td class="sfu_table" valign="top">

<?php if (($upload_popcaptchamsg == 0) && ($results == JText::_('FAULTY_CAPTCHA'))) {
	echo "<span style='font-weight: bold; color: #dd1010;'>" . $results . "</span>";
	$results = "";
} else { ?>

<script type="text/javascript">
// <!--

window.addEvent('domready', function() {
 
	SqueezeBox.initialize();
	
	SqueezeBox.open($('div_simplefileuploadmsg<?php echo $mid ?>'), {
		handler: 'adopt',
		overflow: 'scroll',
		size: {x: 360, y: 260}
	});

});	
// -->
</script>
<div style="display:none;">
<div id="div_simplefileuploadmsg<?php echo $mid ?>">
	<table class="sfu_table" id="tbl_simplefileuploadmsg<?php echo $mid ?>" class="sfu_content" style="position: absolute; left: 50%; top: 50%; margin-top: -110px; margin-left: -175px; z-index: 20; width: 350px; height:252px;" cellspacing=0 cellpadding=0>
	<!--table id="div_simplefileuploadmsg" style="position:relative; top:-30px; left: 25px; z-index: 10; width: 100%; height:252px;" cellspacing=0 cellpadding=0-->
		<tr class="sfu_table">
			<td class="sfu_table" valign="top" style="width: 100%; height: 25px; font-weight: bold; font-size: 12pt; color: #898998;">
				<?php echo JText::_('FILE_UPLOAD_NAME'); ?>
			</td>
		</tr>
		<tr class="sfu_table">
			<td class="sfu_table" valign="top" style="width: 100%; font-size: 9pt; color: #898998;">
				<hr />

				<?php echo $results; ?>
				
			</td>
			<!--td style="width: 12px;" valign="bottom"><img src="<?php echo JURI::root().$sfu_basepath;?>images/infobox_bg.gif" /></td-->
		</tr>
	</table>
</div>
</div>
	
<?php } ?>
	
</td>
</tr>

<?php

	}
}

?>

</table>

<!--  DIV to push down mod due to relative positions -->
<!--div style="height: 30px;"></div-->

<?php

} else {

	echo "<div style=\"font-size: 10pt; color: #898998; width: 90%;\">" . JText::_('NOT_ALLOWED_USER') . "</div>";

}

?>