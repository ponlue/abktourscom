<?php
/**
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
<jdoc:include type="head" />

<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/rhuk_milkyway/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/rhuk_milkyway/css/menu.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/rhuk_milkyway/css/content.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/rhuk_milkyway/js/ie6.js" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/rhuk_milkyway/css/slide.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/rhuk_milkyway/js/jquery.js" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/rhuk_milkyway/js/scripts.js" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/rhuk_milkyway/css/<?php echo $this->params->get('colorVariation'); ?>.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/rhuk_milkyway/css/<?php echo $this->params->get('backgroundVariation'); ?>_bg.css" type="text/css" />
<!--[if lte IE 6]>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/ieonly.css" rel="stylesheet" type="text/css" />
<![endif]-->
<?php if($this->direction == 'rtl') : ?>
	<link href="<?php echo $this->baseurl ?>/templates/rhuk_milkyway/css/template_rtl.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
<style>

		#language_en_fr
	{
		position:absolute;
		left:850px;
		top:13px;
		width:170px;
		height:23px;
		margin-top:20px;
		z-index:10;
    }
	
	 #thumimage {
	position:absolute;
	left:256px;
	top:388px;
	width:435px;
	height:42px;
	z-index:11;
	text-align:right;
    }
</style>
</head>
<body  id="page_bg" onload="playPic(3000)">
<a name="up" id="up"></a>
<div class="center" align="center">
	<div id="wrapper">
		<div id="wrapper_r">
			<div id="header">
				<div id="header_l">
					<div id="header_r">
                    	
						<!--<div id="logo"></div>-->
						<jdoc:include type="modules" name="top" />
                        
  <!--Language French and English===========================================-->
  							
                        	  <div id="language_en_fr"> <a href="index.php?lang=fr"> <img src="images/fr.png" style="width:40px;height:20px;"></a> 
                              	<a href="index.php?lang=en"><img src="images/gb.png" style="width:40px;height:20px;"></a>
                              	<a href="http://localhost/joomla/administrator/index.php" style="font-size:13px;color:#FFF;">Login</a>
                              </div>
                              
						</div>
				</div>
			</div>

			<div style="width:100%;">
						<table cellpadding="0" cellspacing="0" class="pill" width="100%">
							<tr>
								<td>&nbsp;</td>
								<td>
							
  <!--menu dropdown ===========================================-->
<div style="border-top:solid 1px #FFF;border-bottom:solid 1px #FFF;">
<?php

if(isset($_GET['lang'])) $lang=$_GET['lang'];
else{$lang='en';} 
if($lang=='en')
echo'<div id="menu">
		<ul class="menu">
			<li><a href="#" class="parent"><span>Home</span></a></li>
			<li><a href="#"><span>Cambodia Tours</span></a>
				<div><ul>
					<li><a href="#" class="parent"><span>Classic Tours</span></a></li>
					<li><a href="#"><span>Honeymoon Tours</span></a></li>
					<li><a href="#"><span>Adventure Tours</span></a></li>
					<li><a href="#"><span>Goft Tours</span></a></li>
					<li><a href="#"><span>Phnom Penh Tours</span></a></li>
					<li><a href="#"><span>Siem Reap Tours</span></a></li>
				</ul></div></li>
			<li><a href="#"><span>Cambodia Heltel</span></a>
				<div><ul>
					<li><a href="#" class="parent"><span>Battambang Hotel</span></a></li>
					<li><a href="#"><span>Kampot Hotel</span></a></li>
					<li><a href="#"><span>Kep Hotel</span></a></li>
					<li><a href="#"><span>Koh Kong Hotel</span></a></li>
					<li><a href="#"><span>Kompong Tom Hotel</span></a></li>
					<li><a href="#"><span>Phnom Penh Tours</span></a></li>
					<li><a href="#"><span>Siem Reap Tours</span></a></li><li>
					<a href="#"><span>Sihonoukville Hotels</span></a></li>
				</ul></div></li>
			<li><a href="#"><span>Gallary</span></a></li>
			<li><a href="#"><span>Travel Guide</span></a>
				<div><ul>
					<li><a href="#" class="parent"><span>Battambang Hotel</span></a></li>
					<li><a href="#"><span>Embassy Abroad</span></a></li>
					<li><a href="#"><span>Before You Go</span></a></li>
					<li><a href="#"><span>Time and Currency</span></a></li>
					<li><a href="#"><span>Get in and Get Out</span></a></li>
					<li><a href="#"><span>Heal and Advice</span></a></li>
				</ul></div></li>
			<li class="last"><a href="#"><span>About us</span></a></li></ul>
</div>';


if ($lang=='fr')
echo'
	<div id="menu">
		<ul class="menu">
		  <li><a href="#" class="parent"><span>Accueil</span></a></li>
		  <li><a href="#"><span>Tours au Cambodge</span></a>
				<div><ul>
					<li><a href="#" class="parent"><span>Classic Tours</span></a></li>
					<li><a href="#"><span>Circuits classiques</span></a></li>
					<li><a href="#"><span>Adventure Tours</span></a></li>
					<li><a href="#"><span>Golf Tours</span></a></li>
					<li><a href="#"><span>Tours à Phnom Penh</span></a></li>
					<li><a href="#"><span>Siem Reap Tours</span></a></li>
				</ul></div>
			</li>
		  <li><a href="#"><span>Hôtel Cambodge</span></a>
            	<div><ul>
					<li><a href="#" class="parent"><span>Battambang Hôtel</span></a></li>
					<li><a href="#"><span>Hôtel de Kampot</span></a></li>
					<li><a href="#"><span>Kep Hôtel</span></a></li>
					<li><a href="#"><span>Koh Kong Hôtel</span></a></li>
                    <li><a href="#"><span>Kompong Tom Hôtel</span></a></li>
					<li><a href="#"><span>Tours à Phnom Penh</span></a></li>
					<li><a href="#"><span>Tours Siem Reap</span></a></li>
                    <li><a href="#"><span>Hôtel Sihonoukville</span></a></li>
				</ul></div>
          </li>
		  <li><a href="#"><span>Gallary</span></a></li>
            <li><a href="#"><span>Guide de Voyage</span></a>
            	<div><ul>
					<li><a href="#" class="parent"><span>Hôtel Battambang</span></a></li>
					<li><a href="#"><span>Ambassade à létranger</span></a></li>
					<li><a href="#"><span>Avant de partir</span></a></li>
					<li><a href="#"><span>Horaires et le dollar</span></a></li>
                    <li><a href="#"><span>Entrez et Get Out</span></a></li>
					<li><a href="#"><span>Heal et conseils</span></a></li>
				</ul></div>
            </li>
            <li class="last"><a href="#"><span>About us</span></a></li>
		</ul>
</div>';
?>
</div>
                         
								</td>
								<td class="pill_r">&nbsp;</td>
							</tr>
                            <tr><td colspan="3">
                            <div style="width:100%;height:390px;background-color:#86B240;padding-top:25px;">
      				<img src="image_slide/10.jpg" id="pic" style="width:80%;height:350px;border:solid #000 1px;" />
                                
                                
                                
                                
				<div style="margin-top:-20px;z-index:1000">
                                 
                                 
                                 
                                 
        				<img src="images/play_48.png" style="height:20px; width:20px;" onclick="playSlide()"/>
       					<img src="images/pause_48.png" style="height:20px; width:20px;" onclick="puaseSlide()" />
        									                                            
		 <?php 
          $images = scandir(realpath('images/image_slide/'));
          foreach ($images as $image)
          {
              if (substr($image, 0, 1) != '.') 
              {
                  $extension = substr($image, strrpos($image, '.')); // Gets the File Extension
                  if($extension == ".jpg" || $extension == ".jpeg" || $extension == ".gif" |$extension == ".png")
                  echo "<img src=\"images/image_slide/$image\" width=\"30\" height=\"30\" 
                          onclick=\"currentPic('images/image_slide/$image')\"/>&nbsp;";
              }
              
          }
         ?>                                            
  </div>
                                   
                                
							</div>
                            
                            </td></tr>
							</table>
						</div>
				
			

		

			<div class="clr"></div>
			
			<div id="whitebox">
				<div id="whitebox_m">
                <br /><br />
                <div id="content">
               		<div style="float:left;width:68%;"  style="">
					<!--<jdoc:include type="modules" name="left" style="rounded" />-->
           
                             
 						  <?php 	$db =& JFactory::getDBO();   
                          	$query = "SELECT title,introtext FROM jos_content";
							$db=mysql_query($query);
							while(list($title,$text)=mysql_fetch_row($db))
							{
								echo"<p><span>".$title."</span></p><br />";
								echo "<div style='font-size:13px;color:#666;word-spacing:1px;line-height:18px;'>".$text."&nbsp;&nbsp;&nbsp;&nbsp;<a hret='' style='background:red;color:#fff' >Read More...</a></div><br />";
								
							}
							 ?>
                           </div>
                          <div style="float:right;width:29%">  
                       		 <div style="height:730px;background-color:#86B240;padding:10px;">
                        
                            		<span>Scription</span><br /><br />
                                    
                                    <table style="color:#000">
                                    	<tr>
                                        	<td>Name:</td>
                                            <td><input type="text" name="name" size="30px;" /></td>
                                        </tr>
                                        <tr>
                                        	<td>Email:</td>
                                            <td><input type="text" name="name" size="30px;" /></td>
                                        </tr>
                                        <tr>
                                        	<td>Discription</td>
                                        </tr>
                                         <tr>
                                        	<td colspan="2">
                                            	<textarea cols="30" rows="5" name="Description"> </textarea>
                                            </td>
                                         <tr><td><input type="button" value="Send" /></td></tr>
                                        </tr>
                                    </table>
                                    <br /><br />
                                    
                                    <p><span>Cambodai the land of wonder</span></p><br />
                                    <!--Images =======================================-->
                                    <div>
                                     <?php 
									
												$images = scandir(realpath('images/Lan_of_wonder/'));
												
												echo"<center><table>";
												$i=0;
												foreach ($images as $image)
												{
													if (substr($image, 0, 1) != '.') 
													{
														$extension = substr($image, strrpos($image, '.')); 
														if($extension == ".jpg" || $extension == ".jpeg" 
														||$extension == ".gif" ||$extension == ".png")
														{
															$i=$i+1;
															$im=$im."<td style='padding:3px;'>
															<img src=\"images/Lan_of_wonder/$image\" 
															width='120' height='70' /></td>";
															if ($i==2){$i=0;echo "<tr>".$im."</tr>";$im="";}
														}
													}
													
												}
												echo"</table></center>";
 											   ?>    
                                     </div>  
                                     
                                     <br /><br />
                                     <p><span>Number of Visiter</span></p><br />
                                  	 <table style="color:#fff;font-size:16px;">
                                     	<tr><td style="padding:5px;">- Yester day :</td><td>0</td></tr>
                                     	<tr><td style="padding:5px;">- Today :</td><td>0</td></tr>
                                        <tr><td style="padding:5px;">- All :</td><td>0</td></tr>
                                     </table>
                                        
                                </div>
                          </div>
                     
                     </div>
				</div>
			<div id="footerspacer"></div>
		</div>
        
        <div class="clr"></div>
        <br /><br /><br /><br /><br />
        	        
        	<div id="footer" align="center"  style="color:#FFF;font-size:14px;" >
							<br /><br /><br />
                             Address: #104Eo, Tnal Trang,Bakong, Siem Reap, Cambodia <br />
							 Tel: +855 63963164<br />
							 HP: +855 16836690<br />
							 Fax: +855 63963164 +855 977817278 <br />
							 Email: kymaye@hotmail.fr
			</div>
		</div>
	</div>
</div>


 <div id="content_footer" style="margin-top:-225px;" align="center">
	
    <p><span style="color:#00F;border-bottom:double 4px #F00;font-size:16px;">Cambodia Photo</span></p><br />
       <?php 
	   
	   	//images footer 
				
                $images = scandir(realpath('images/Cambodia_Photos/'));
                foreach ($images as $image)
                {
                    if (substr($image, 0, 1) != '.') 
                    {
                        $extension = substr($image, strrpos($image, '.')); // Gets the File Extension
                        if($extension == ".jpg" || $extension == ".jpeg" || $extension == ".gif" |$extension == ".png")
                        echo "<img src=\"images/Cambodia_Photos/$image\" width='70' height='70' />&nbsp;&nbsp;";
                    } 
                }
        ?>
        
  </div> 
                        </center>  



</body>
</html>

<!--runner slide by get image from server-->

<script>
//// Get image from server for runner slide
var time=null;
var ad=null;

  <?php    	
		$images = scandir(realpath('images/image_slide/'));
			  foreach ($images as $image)
			  {
				  if (substr($image, 0, 1) != '.') 
				  {
					  $extension = substr($image, strrpos($image, '.')); // Gets the File Extension
					  if($extension == ".jpg" || $extension == ".jpeg" || $extension == ".gif" |$extension == ".png")
					  $getimages.="\"images/image_slide/$image\",";
				  }
				  
			  }
				echo "var PicArray = new Array(".substr($getimages,0,-1).");";
?>
 
function showPics(file)
{
	if(file=="")
	{
 		 ad = parseInt( Math.random() * PicArray.length ); 
		 document.getElementById('pic').setAttribute('src',PicArray[ad]);
		 
	}
	else{document.getElementById('pic').setAttribute('src',file);}
}
function playPic(interval,file){time=setInterval("showPics('')",interval);}



function playSlide(){playPic(3000);}
      

function puaseSlide()
{  							
    clearInterval(time);
	document.getElementById('pic').setAttribute('src',PicArray[ad]);
}

function currentPic(file)
{
	clearInterval(time);
	document.getElementById('pic').setAttribute('src',file);
}



</script>
