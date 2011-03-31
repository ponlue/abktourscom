<?php

/**
* @version		1.2
* @copyright	Copyright (C) 2010-2011 Anders Wasén
* @license		GNU/GPL
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

//jimport('joomla.html.html');
//jimport('joomla.form.formfield');//import the necessary class definition for formfield

?>

<script language="javascript" type="text/javascript">


function moveUDDuser() {
	var ol = document.getElementById('jformparamssettingidsuddsel');

	var os = ol.selectedIndex;
	if (os < 0) {
		alert('You have to select a user from the list first.');
		return false;
	}
	var userid = ol.options[os].text;
	
	var path = prompt('Give the path for the user defined directory for ' + userid + '.');
	
	var oli = document.getElementById('jformparamssettingidsudd');
	
	var val = userid + '>' + path;
	
	addOption(oli, val, val);
	
	var i = 0;
	var n = ol.options.length;
	for (i = 0; i < n; i++) {
		//oli.options[i].disabled = true;
		ol.options[i].selected = false;
	}
	
	selectAll(oli);
	
}

function selectAll(oe) {
	var i = 0;
	var n = oe.options.length;
	for (i = 1; i < n; i++) {
		//oli.options[i].disabled = true;
		oe.options[i].selected = true;
	}
}

function removeUDDuser() {
	var ol = document.getElementById('jformparamssettingidsudd');

	var os = ol.selectedIndex;
	if (os < 0) {
		alert('You have to select a user from the list first.');
		return false;
	}
	
	var ret = confirm('Are you sure you want to remove the user defined path for ' +ol.options[os].text + '?');
	
	if (ret) {
		deleteOption(ol, os);
	}
	
	selectAll(ol);
}

function addOption(theSel, theText, theValue)
{
  var newOpt = new Option(theText, theValue);
  var selLength = theSel.length;
  theSel.options[selLength] = newOpt;
}

function deleteOption(theSel, theIndex)
{ 
  var selLength = theSel.length;
  if(selLength>0)
  {
    theSel.options[theIndex] = null;
  }
}

//Make sure paths list is all selected!
var oapply = document.getElementById("toolbar-apply");
oapply.onmousedown = function() {
	selectAll(document.getElementById('jformparamssettingidsudd'));
}
var osave = document.getElementById("toolbar-save");
osave.onmousedown = function() {
	selectAll(document.getElementById('jformparamssettingidsudd'));
}



</script>

<?php


jimport('joomla.form.helper');
JFormHelper::loadFieldClass('MySettings');
 
class JFormFieldSettings extends JFormFieldMySettings {
 
	protected $type = 'Settings';
	
	//function fetchElement($name, $value, &$node, $control_name)
	protected function getInput()
	{
		$db = &JFactory::getDBO();
		
		$mid = JRequest::getVar('id');
		if (strlen($mid) == 0) {
			$mid = JRequest::getVar('cid');
			if (is_array($mid)) $mid = $mid[0];
		}
		
		$name = (string)$this->element['name'];
		$control_name = 'jform[params]';
		$control_name_basic = 'jformparams';
		if (is_array($this->value))
			$value = $this->value;
		else	
			$value 	= (string)$this->value;

		$query = 'SELECT id AS value, username AS text'
 		. ' FROM #__users'
 		. ' WHERE block=0 ORDER BY name';

		$db->setQuery($query);
		$optionsAll[] = JHTML::_('select.option', "[ALL]", "[ALL]");
		$optionsDB = $db->loadObjectList();
		
		$options = array_merge($optionsAll, $optionsDB);
		
		if ($name == "settingidsudd" ) {
			$slist = '';
			$slist = JHTML::_('select.genericlist',  $optionsDB, 'jform[params][settingidsuddsel][]', 
				'class="inputbox" size="12"',
				'value', 'text', $value, 'jformparamssettingidsuddsel');
		//test
			$optionsPath[] = JHTML::_('select.option', '0', '[user defined directory paths]');
			
			$query = 'SELECT params AS value'
			. ' FROM #__modules where id=' . $mid;
			$db->setQuery($query);
			$dblist = $db->loadObjectList();
			// Parameter list is last in array
			//$udddblist = $dblist[count($dblist)-1]->value;
			// Above not always true, make sure to search all params in dblist!!!!
			$cnt = 0;
			do {
				$udddblist = $dblist[$cnt]->value;
				//echo "udddblist$cnt=".$udddblist."(".strrpos($udddblist, "upload_location").")<br/>";
				if (strrpos($udddblist, "upload_location") >= 1) {
					//echo "FOUND IT!";
					break;
				}
				$cnt = $cnt + 1;
			} while (count($dblist) > $cnt);

//echo "dblist=".Print_R($dblist);
//echo "udddblist=".$udddblist;
/*
udddblist={"upload_location":".\/images\/","upload_maxsize":"100000","upload_capthca":"1","upload_capthcacase":"1","upload_capthcacasemsg":"1",
			"upload_email":"","upload_emailmsg":"0","upload_emailhtml":"1","upload_fileexist":"2","upload_multi":"0","upload_maxmulti":"",
			"upload_filetypes":"image\/gif;image\/jpeg;image\/pjpeg;image\/png","settingids":["43","42"],"upload_usernameddir":"1","upload_usernameddirdefault":"0",
			"upload_userlocation":".\/users\/","settingidsund":["43","42"],"upload_createdir":"1","upload_unzip":"0","upload_showerrmsg":"1",
			"upload_redirect":"","upload_advancedpopup":"0","upload_showdircontent":"0","upload_username":"","upload_password":"","upload_stdbrowse":"0",
			"upload_filewidth":"12","upload_capthcaheight":"40","upload_capthcawidth":"120","upload_capthcabg":"120-192","upload_bgcolor":"#e8edf1",
			"upload_popshowpath":"1","upload_popcaptchamsg":"1","upload_popshowbytes":"0","moduleclass_sfx":""}
*/

			// Get rid of double quotes
			$udddblist = str_replace("\"", "", $udddblist);
			// Fix front-slashes
			$udddblist = str_replace("\/", "/", $udddblist);

			$tmp = "";
			$bracket = false;
			$uddlist = "";

			for ($i=0; $i<strlen($udddblist); $i++) {
				// There must be a smarter way to do this... but...
				$tmp = substr($udddblist, $i, 1);
				
				if ($tmp === "[") {
					$bracket = true;
					$tmp = "";
				}
				if ($tmp === "]") {
					$bracket = false;
					$tmp = "";
				}
				
				if ($bracket && $tmp === ",")
					$tmp = ";";
					
				$uddlist .= $tmp;
			}


//echo "uddlist=".$uddlist;

			$uddlist = explode(',', $uddlist);
		
			$optionsAddPath = '';
			foreach($uddlist as $val){

// "settingidsudd":["Anders>aaaa","Super User>super"]  should be cleaded as: settingidsudd:Anders>aaaa;Super User>super

			    if (substr($val, 0, 14) === 'settingidsudd:') {

					$val = str_replace('settingidsudd:', '', $val);
					//$val = str_replace('"]', '', $val);

					//echo $value.'&';

					$uddsellist = explode(";", $val);
					foreach($uddsellist as $listval) {
						if ($listval != '0') {
						$optionsAddPath[] = JHTML::_('select.option', $listval, $listval);
						}
					}
					
				}
			}
			
			if (is_array($optionsAddPath)) {
				$optionsPath = array_merge($optionsPath, $optionsAddPath);
			}
			
			$slistpath = '';
			$slistpath = JHTML::_('select.genericlist', $optionsPath, 'jform[params][settingidsudd][]', 
				'class="inputbox" size="12" multiple="multiple"',
				'value', 'text', $value, 'jformparamssettingidsudd');
		//test
			return setSFUhtml($slist, $slistpath);
			
			/*return  . JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.'][]', 
				'class="inputbox" size="12" multiple="multiple"',
				'value', 'text', $value, $control_name.$name) . '</td><td>'. setSFUhtml() .'</td></tr></table>';*/
				
		} else {
			return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.'][]', 
				'class="inputbox" size="12" multiple="multiple"',
				'value', 'text', $value, $control_name_basic.$name);
		}
	}

}

function setSFUhtml($sin, $sin2) {
	$shtml = '';

	
	//$shtml .= '<table border="0" style="position: relative;"><tr><td>';
	$shtml .= $sin;
	//$shtml .= '</td><td><input type="button" style="float: none;" value=">>" onclick="javascript: moveUDDuser();"/><br /><input type="button" style="float: none;" value="<<" onclick="javascript: removeUDDuser();" /></td><td>';
	$shtml .= '<input type="button" value=">>" onclick="javascript: moveUDDuser();"/><input type="button" value="<<" onclick="javascript: removeUDDuser();" />';
	$shtml .= $sin2;
	//$shtml .= '</td></tr></table>';
	
	return $shtml;
}

?>

