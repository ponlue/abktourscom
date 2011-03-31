<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
class ModSimpleFileUploaderHelperv12
{
	function getUploadForm(
							$sfu_basepath,
							$sfu_version, 
							$upload_location, 
							$upload_maxsize, 
							$upload_filetypes, 
							$upload_fileexist, 
							$upload_users, 
							$upload_email, 
							$upload_emailmsg,
 							$upload_emailhtml,
							$upload_unzip, 
							$upload_showerrmsg, 
							$upload_showdircontent,
							$upload_advancedpopup,
							$upload_popshowpath,
							$upload_popshowbytes,
							$moduleclass_sfx,
							$mid
						)
    {
	
	    $results = "";
		$fileCnt = 0;
		$fileErr = 0;
		$written = 0;
		$filename = "";
		$fileList = "";
		$fileInfo = "";
		
		$baseurl = "";
		$serverurl = "";
		$protocol = "";
		$protocol = "http://";
		if (substr($_SERVER["HTTP_REFERER"], 0, 5) == "https") $protocol = "https://";
		$folder = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")); 
		if ($folder === "//") $folder = "";
		// Check if relative path
		if (substr($upload_location, 0, 1) == ".") {
			$serverurl .= str_replace(".", $protocol.$_SERVER["HTTP_HOST"].$folder, $upload_location);
			// Fix Windows path...
			$baseurl .= str_replace("\\", "", $serverurl);
		} else {
			if ((substr($upload_location, 1, 2) == ":\\") || (substr($upload_location, 0, 1) == "/")) {
				// Server root path
				$baseurl = "file://".str_replace("\\", "/", $upload_location);
			} else {
		
				$serverurl = str_replace("\\", "/", $_SERVER["DOCUMENT_ROOT"]);
				
				$baseurl = str_replace("\\", "/", $upload_location);
				
				$baseurl = str_replace($serverurl, "", $baseurl);
				//$baseurl = dirname($_SERVER["HTTP_REFERER"])."/".$baseurl;
				$baseurl = $protocol.$_SERVER["HTTP_HOST"].$folder."/".$baseurl;
			}
		}
		//Replace space with %20 for URL
		$baseurl = str_replace(" ", "%20", $baseurl);
		
		// Make sure it ends with front slash
		if ( substr( $baseurl , strlen($baseurl) - 1) != "/" ) {
			$baseurl .= "/";
		}
		
			
			if(is_array($_FILES["uploadedfile$mid"]["name"])) {
				foreach($_FILES["uploadedfile$mid"]["name"] as $value){
					if(strlen($value) > 0) {
						//Check that we have a filename
						$filename = $value;
					}
					$fileCnt += 1;
				}
			}
			for ($cnt = 0; $cnt<$fileCnt; $cnt++) {
				if ((strlen($_FILES["uploadedfile$mid"]["name"][$cnt]) > 0) && ($upload_users == "true")) {
				
					$fileList .= $_FILES["uploadedfile$mid"]["name"][$cnt] . "|";
					$fileInfo .= "(" . JText::_('TYPE') . ": " . $_FILES["uploadedfile$mid"]["type"][$cnt] . " " . JText::_('SIZE') . ": " . $_FILES["uploadedfile$mid"]["size"][$cnt] . " " . JText::_('BYTES') . ")|";
					
					
					$filetype = $_FILES["uploadedfile$mid"]["type"][$cnt];
					
					if ($filetype == "") $filetype = "false";
					
					if (strpos($upload_filetypes, $filetype) === false) {
						$filetypeok = false;
					} else {
						$filetypeok = true;
					}
					if ($upload_filetypes == "*") {
						$filetypeok = true;
					}
				  if (($filetypeok > 0) && ($_FILES["uploadedfile$mid"]["size"][$cnt] < $upload_maxsize)) {
					$errmsg = "";
					if ($_FILES["uploadedfile$mid"]["error"][$cnt] > 0) {
					  if (($_FILES["uploadedfile$mid"]["size"][$cnt] == 0) && ($_FILES["uploadedfile$mid"]["error"][$cnt] == 2)) {
						$errmsg = "(<span style='color:#dd2222'>".$_FILES["uploadedfile$mid"]["name"][$cnt].")</span>".JText::sprintf('ERROR_TOO_BIG', "<br />[PHP Error: " . $_FILES["uploadedfile$mid"]["error"][$cnt]) . "]<br />";
					  } else {
						$errmsg = "(<span style='color:#dd2222'>".$_FILES["uploadedfile$mid"]["name"][$cnt].")</span>".JText::sprintf('ERROR_LABEL', $_FILES["uploadedfile$mid"]["error"][$cnt]) . "<br />";
					  }
					  if ($upload_showerrmsg == 1)
						$results .= $errmsg;
					  else
						$results .= JText::_('UPLOAD_FAILED');
					  $fileErr = 1;
					} else {
					
					  $filesize = $_FILES["uploadedfile$mid"]["size"][$cnt];
					  $bytesfilesize = $filesize;
					  
					  $kb=1024;
					  $mb=1048576;
					  $gb=1073741824;
					  $tb=1099511627776;
					  if(!$filesize)
					    $filesize = '0 B';
					  elseif($filesize<$kb)
					    $filesize = $filesize.' B';
					  elseif($filesize<$mb)
					    $filesize = round($filesize/$kb, 2).' KB';
					  elseif($filesize<$gb)
					    $filesize = round($filesize/$mb, 2).' MB';
					  elseif($filesize<$tb)
					    $filesize = round($filesize/$gb, 2).' GB';
					  else
					    $filesize = round($filesize/$tb, 2).' TB';
						
					  if (($upload_popshowbytes == 1) && ($bytesfilesize != $filesize)) $filesize = $filesize . " (" . $bytesfilesize . " " . JText::_('BYTES') . ")";
					
					  //$results .= "<strong>" . JText::_('FILE_OK_MSG') . "</strong><br /><br />";
					  $results .= "<span style='color:#55dd55'>".JText::sprintf('FILE_UPLOAD_LABEL', $_FILES["uploadedfile$mid"]["name"][$cnt]) . "</span><br />";
					  $results .= JText::sprintf('FILE_TYPE_LABEL', $_FILES["uploadedfile$mid"]["type"][$cnt]) . "<br />";
					  $results .= JText::sprintf('FILE_SIZE_LABEL', $filesize) . "<br />";
					  #$results .= "uploaded to: " . $_FILES["uploadedfile$mid"]["tmp_name"][$cnt] . "<br />";
					  
					  if (file_exists($upload_location . $_FILES["uploadedfile$mid"]["name"][$cnt])) {
						if ( $upload_fileexist == "0" ) {
						  // FAIL
						  $results .= "<br /><strong>" . JText::sprintf('FILE_EXISTS_MSG', $_FILES["uploadedfile$mid"]["name"][$cnt]) . "</strong><br /><br />" . JText::_('FILE_EXISTS_CORR');
						  $fileErr = 1;
						}
						if ( $upload_fileexist == "1" ) {
						  // REPLACE
						  unlink($upload_location . $_FILES["uploadedfile$mid"]["name"][$cnt]);
						  $results .= JText::_('FILE_EXISTS_REPLACE') . "<br />";
						  $upload_fileexist = "no";
						}
						if ( $upload_fileexist == "2" ) {
						  // BACKUP
						  $new_filename = $_FILES["uploadedfile$mid"]["name"][$cnt] . microtime();
						  rename($upload_location . $_FILES["uploadedfile$mid"]["name"][$cnt], $upload_location . $new_filename);
						  $results .= JText::sprintf('FILE_EXISTS_BACKUP',  $new_filename) . "<br />";
						  $upload_fileexist = "no";
						}
					  } else {
						$upload_fileexist = "no";
					  }
					  if ( $upload_fileexist == "no" ) {
						if (move_uploaded_file($_FILES["uploadedfile$mid"]["tmp_name"][$cnt], $upload_location . $_FILES["uploadedfile$mid"]["name"][$cnt])) {
							$fileErr = 0;
						} else {
							$fileErr = 1;
							$results .= JText::_('FAIL_REQUEST') . "<br />";
							$_FILES["uploadedfile$mid"]["name"][$cnt] = "";
						}

						if ($upload_popshowpath == 1) {
							$results .= JText::sprintf('FILE_SAVE_AS', '<a href="'.$baseurl.str_replace(" ", "%20", $_FILES["uploadedfile$mid"]["name"][$cnt]).'" target="blank">'.$baseurl.$_FILES["uploadedfile$mid"]["name"][$cnt].'</a>').'<br /><br />';
						}

						//$results .= "<div style=\"width: 90%; text-align: right;\"><input type='button' value='" . JText::_('OK_BUTTON') . "' onclick='document.getElementById(\"div_simplefileuploadmsg\").style.display=\"none\";'></div>";
					  }
					}
					
					// UNZIP
					if (($upload_unzip == 1) && ($fileErr == 0)) {

						if ($_FILES["uploadedfile$mid"]["type"][$cnt] == "application/x-tar") {
							//system("tar -zxvf ".$upload_location.$_FILES["uploadedfile$mid"]["name"]);
							$res = shell_exec("cd ".$upload_location.";tar -xvzf ".$_FILES["uploadedfile$mid"]["name"][$cnt].";");
							if ($res === FALSE) {
								$results .= "<p>".JText::_('MSG_UNZIP_ERROR')."</p>";
							} else {
								$results .= "<p>".JText::_('MSG_UNZIP')."</p>";
							}
						}

						if ($_FILES["uploadedfile$mid"]["type"][$cnt] == "application/x-zip") {
							$zip = new ZipArchive;
							$res = $zip->open($upload_location.$_FILES["uploadedfile$mid"]["name"][$cnt]);
							if ($res === TRUE) {
								$zip->extractTo($upload_location);
								$zip->close();
								$results .= "<p>".JText::_('MSG_UNZIP')."</p>";
							} else {
								$results .= "<p>".JText::_('MSG_UNZIP_ERROR')."</p>";
							}
						}
					}
					
					$_SESSION["uploaderr$mid"] = $fileErr;
					
				  } else {
				  
					$fileErr = 1;
					$errmsg = "(<span style='color:#dd2222'>".$_FILES["uploadedfile$mid"]["name"][$cnt].")</span>".JText::sprintf('FILE_IN_ERROR', $filetype) . "<br /><br />";
					$_SESSION["uploaderr$mid"] = 1;
					if ($upload_showerrmsg == 1)
						$results .= $errmsg;
					  else
						$results .= JText::_('UPLOAD_FAILED')."<br /><br />";
					
					if ($written == 0) {
					
					  $filesize = $upload_maxsize;
					  $kb=1024;
					  $mb=1048576;
					  $gb=1073741824;
					  $tb=1099511627776;
					  if(!$filesize)
					    $filesize = '0 B';
					  elseif($filesize<$kb)
					    $filesize = $filesize.' B';
					  elseif($filesize<$mb)
					    $filesize = round($filesize/$kb, 2).' KB';
					  elseif($filesize<$gb)
					    $filesize = round($filesize/$mb, 2).' MB';
					  elseif($filesize<$tb)
					    $filesize = round($filesize/$gb, 2).' GB';
					  else
					    $filesize = round($filesize/$tb, 2).' TB';
					
						$results .= JText::_('ALLOWED_TYPES') . ": " . $upload_filetypes . "<br />" . JText::_('FILE_MAX_SIZE') . ": " . $filesize . "<br /><br />";
						//$results .= "<div style=\"width: 90%; text-align: right;\"><input type='button' value='" . JText::_('OK_BUTTON') . "' onclick='document.getElementById(\"div_simplefileuploadmsg\").style.display=\"none\";'></div>";
						$written = 1;
					}
				  }
				} else {
					if ($upload_users == "false") {
						$_SESSION["uploaderr$mid"] = 1;
						$results .= JText::_('NOT_ALLOWED_USER');
					}
				}
			} // end for
			
			// SHOW DIR CONTENT
			if (($upload_showdircontent == 1) && ($fileErr == 0)) {
			
				$results .= "<br /><div style=\"text-align: left\">";
				if($bib = @opendir($upload_location)) {

					while (false !== ($lfile = readdir($bib))) {
						//if($lfile != "." && $lfile != ".." && !ereg("^\..+", $lfile) && $lfile != "index.html") {
						if($lfile != "." && $lfile != ".." && !preg_match("/^\..+/", $lfile) && $lfile != "index.html") {
							$fil_list[] = "<a href=\"$upload_location/$lfile\" target=\"blank\">$lfile</a>";
						}
					}

					closedir($bib);

					if(is_array($fil_list)) {
						$liste = "<li>" . join("</li><li>", $fil_list) . "</li>";
					} else {
						$liste = "<li>" . JText::_('NO_FILES_FOUND') . " " . $upload_location . "</li>";
					}

					$results .=  "<h2>" . JText::_('FILES_IN_DIR') . " (" . $upload_location . "):</h2><ul>" . $liste . "</ul>";
				} else {
					die("Could not read files in " . $upload_location);
				}	
		
				$results .= "</div><br/>";
			
			}
			
			
			// SEND E-MAIL
			if ((strlen($upload_email) > 0) && ($fileErr == 0)) {
				$to = $upload_email;
				$subject = JText::_('MAIL_SUBJECT');
				
				$infos = explode("|", $fileInfo);

				$text = "";
				$headers = "";
				//Replace space with %20 for URL
				
				if ($upload_emailhtml == 0) {
					for ($cnt = 0; $cnt<$fileCnt; $cnt++) {
						$text .= $upload_location.$_FILES["uploadedfile$mid"]["name"][$cnt]." (".$baseurl.str_replace(" ", "%20", $_FILES["uploadedfile$mid"]["name"][$cnt]).")\r\n";
					}
				
					$body = JText::sprintf('MAIL_BODY', $_SERVER["HTTP_HOST"]);
					$body .= "\r\n\r\n".$text;
					$body .= "\r\n\r\n(Find out more about Simple File Upload for Joomla at http://wasen.net/)";
				} else {
				
					$text = "<br /><br/><table>";
					for ($cnt = 0; $cnt<$fileCnt; $cnt++) {
						$text .= "<tr><td>".$upload_location.$_FILES["uploadedfile$mid"]["name"][$cnt]." (".$baseurl.str_replace(" ", "%20", $_FILES["uploadedfile$mid"]["name"][$cnt]).")</td><td>".$infos[$cnt]."</td></tr>";
					}
					$text .= "<table><br />";
					$body = JText::sprintf('MAIL_BODY', $_SERVER["HTTP_HOST"]);
					if (empty($usr_name)) $usr_name = "Anonymous (@".$_SERVER['REMOTE_ADDR'].")";
					$body .= " ".JText::sprintf('BY_USER', $usr_name);
					$body .= $text;
					
					$body .= "<br /><br/><small>(Find out more about Simple File Upload for <a href='http://www.joomla.org/'>Joomla</a> at <a href='http://wasen.net/'>http://wasen.net/</a>)</small>";
					
					// To send HTML mail, the Content-type header must be set
					$headers = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

					// Additional headers
					//$headers .= 'To: ' . $to . "\r\n";
					$headers .= 'From: noreply@simplefileupload.com' . "\r\n";
				}
				
				
				
				if (mail($to, $subject, $body, $headers)) {
					if ($upload_emailmsg == 1) 
						$results .= "<p>".JText::_('MSG_SENT')."</p>";
				} else {
					if ($upload_emailmsg == 1) 
						$results .= "<p>".JText::_('MSG_FAILED')."(To:".$to.")</p>";
				}
			}
		
		return $results;
	}

	function getCaptcha($sfu_version, $bgcolor, $mid) {
		ini_set ("session.Save_path", $_SERVER['DOCUMENT_ROOT'] . "/mySessions");
		
		session_start();
		if (isset($_SERVER['REMOTE_HOST'])) {
			session_name($_SERVER['REMOTE_HOST'] . "-captcha");
		} else {
			session_name(uniqid() . "-captcha");
		}
		$myCryptBase = "AB0CDE1FG2HIJ3KL4MNO5PQ6RST7UV8WX9YZ";
		$capString = "";
		$image = imagecreatetruecolor(150, 60);
		$white = imagecolorallocate ($image, 255, 255, 255);
		$rndm = imagecolorallocate ($image, rand($bgcolor[0],$bgcolor[1]),  rand($bgcolor[0],$bgcolor[1]),  rand($bgcolor[0],$bgcolor[1]));
		imagefill ($image, 0, 0, $white);

		$folder_captcha_class = JPATH_SITE.DS.'modules'.DS.'mod_simplefileuploadv'.$sfu_version.DS.'tmpl';
		$fontName = $folder_captcha_class."/arial.ttf";
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
		echo base64_encode($result);
		imagedestroy($image);
	}

	
}

?>