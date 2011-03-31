<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
<jdoc:include type="head" />

<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/rhuk_milkyway/css/content.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/rhuk_milkyway/css/menu.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/rhuk_milkyway/css/<?php echo $this->params->get('colorVariation'); ?>.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/rhuk_milkyway/css/<?php echo $this->params->get('backgroundVariation'); ?>_bg.css" type="text/css" />

    
    
	<style type="text/css">
    <!--
    #apDiv1 {
	position:absolute;
	left:700px;
	top:13px;
	width:170px;
	height:23px;
	z-index:10;
    }
    #thumimage {
	position:absolute;
	left:404px;
	top:465px;
	width:435px;
	height:42px;
	z-index:11;
    }
    #apDiv3 {
        position:absolute;
        left:14px;
        top:9px;
        width:199px;
        height:57px;
        z-index:12;
    }
    #apDiv4 {
        position:absolute;
        left:50px;
        top:-19px;
        width:154px;
        height:55px;
        z-index:13;
    }
    
    
    -->
    </style>

</head>

<body style="margin:5px;padding:0px;" onload="playPic(3000)">



	<div>
	  <div id="apDiv1"> <a href="index.php?lang=fr"> <img src="images/fr.png" style="width:40px;height:20px;"></a> <a href="index.php?lang=en"><img src="images/gb.png" style="width:40px;height:20px;"></a> <a href="admin/index.php">Login</a></div>
	  <div id="apDiv3">
        <img src="images/previous_48.png" />
        <img src="images/previous_48.png" />
        <img src="images/previous_48.png" />
    </div>

  	<div id="apDiv4">
  <h1 style="float:right">Logo here</h1>
</div>

	<div style="width:100%;height:70px;background-color:#86B240;border-bottom:solid #FFF 1px;"></div>
    
<!---image slide-->    
    
    <div id="thumimage">
        <img src="images/play_48.png" style="height:20px; width:20px;" onclick="playSlide()"/>
        <img src="images/pause_48.png" style="height:20px; width:20px;" onclick="puaseSlide()" />
        <img src="image_slide/1.jpg" width="30" height="30" onclick="currentPic('image_slide/1.jpg')"/>
        <img src="image_slide/2.jpg" width="30" height="30" onclick="currentPic('image_slide/2.jpg')"/>
        <img src="image_slide/8.jpg" width="30" height="30" onclick="currentPic('image_slide/8.jpg')"/>
      <img src="image_slide/9.jpg" width="30" height="30" onclick="currentPic('image_slide/9.jpg')"/><img src="image_slide/10.jpg" width="30" height="30" onclick="currentPic('image_slide/10.jpg')"/></div>

<!---English Language-->
<div>
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

	<div style="width:100%;height:390px;background-color:#86B240;padding-top:35px;margin-top:-5px; border-top:solid #FFF 1px;">
    
    
    <div style="text-align:center;">
      	<img src="image_slide/10.jpg" id="pic" style="width:90%;height:350px;border:solid #000 1px;" />
        &nbsp;
        
<div style="margin-top:5px;;padding-right:60px; text-align:right;display:block">
       		<input name="" type="text" value="Search" size="40" style="font-size:16px;background:#86B240;border:solid 1px #060"> &nbsp;
        <!--<a href="#"><img src="images/search_48.png" width="25" height="25"></a>-->
        <input type="button" value="Search" style="background:url(images/search_48.gif) no-repeat;font-size:15px; border:outset 1px #060"/>		
   		</div>
     </div>
</div>
    
    <!--Contend==================-->
<br/><br/>

<div>



</div>


	<div style="background:#CCC;" id="content">
    
        <div class="content_left">
            <div>
               &nbsp;&nbsp; <span>About Cambodia</span>
                
                <p><a href="#"><img src="images/4.jpg" align="left" hspace="12"></a>
        No one knows for certain how long people have lived in whatis now Cambodia, asstudies of its prehistory are undeveloped. A carbon-l4 dating from a cave in northwestern Cambodia suggests that people using stone tools lived in the cave as early as 4000 bc, and rice has been grown on Cambodian soil since well before the 1st century ad. The first Cambodians… <a href="script_gallery/ajax.htm?im=image_page/4.jpg" onclick="return hs.htmlExpand(this,{objectType:'ajax'})"><span>Read more</span></a></p>
                <br><Br>
                &nbsp;&nbsp;<span>About Cambodiatripadvisor</span>
                <p><a href="#"><img src="images/1.JPG" align="left" hspace="12"/></a>
        No one knows for certain how long people have lived in whatis now Cambodia, asstudies of its prehistory are undeveloped. A carbon-l4 dating from a cave in northwestern Cambodia suggests that people using stone tools lived in the cave as early as 4000 bc, and rice has been grown on Cambodian soil since well before the 1st century ad. The first Cambodians… <a href="script_gallery/ajax.htm" onclick="return hs.htmlExpand(this,{objectType:'ajax'})"><span>Read more</span></a>
                </p>
                <br><Br>
               &nbsp;&nbsp; <span>Travel Review</span>
                <p><a href="#"><img src="images/5.jpg" align="left" hspace="12"/></a>
        No one knows for certain how long people have lived in whatis now Cambodia, asstudies of its prehistory are undeveloped. A carbon-l4 dating from a cave in northwestern Cambodia suggests that people using stone tools lived in the cave as early as 4000 bc, and rice has been grown on Cambodian soil since well before the 1st century ad. The first Cambodians… <a href="script_gallery/ajax.htm" onclick="return hs.htmlExpand(this,{objectType:'ajax'})"><span>Read more</span></a>
                </p>
                <br><Br>
                
                <table>
                <tr>
                <td style="width:200px;padding-right:30px;">
                    <span>About Cambodia</span>
                    <p>
                        No one knows for certain  
                        people have lived in whatis
                        Cambodia, as studies of its 
                        are undeveloped. A carbon-l4
                        from a cave … 
                        <a href="script_gallery/ajax.htm" onclick="return hs.htmlExpand(this,{objectType:'ajax'})"><span>Read more</span></a>
                    </p>
                </td>
                <td style="width:200px;padding-right:30px;">
                    <span>About Cambodia</span>
                    <p>
                        No one knows for certain  
                        people have lived in whatis
                        Cambodia, as studies of its 
                        are undeveloped. A carbon-l4
                        from a cave … 
                        <a href="script_gallery/ajax.htm" onclick="return hs.htmlExpand(this,{objectType:'ajax'})"><span>Read more</span></a>
                    </p>
                </td>
                <td style="width:200px;">
                    <span>About Cambodia</span>
                    <p>
                        No one knows for certain  
                        people have lived in whatis
                        Cambodia, as studies of its 
                        are undeveloped. A carbon-l4
                        from a cave … 
                        <a href="script_gallery/ajax.htm" onclick="return hs.htmlExpand(this,{objectType:'ajax'})"><span>Read more</span></a>
                    </p>
                </td>
                </tr>
                </table>
            </div>
      </div>
        
        <div class="content_right" style="padding:5px;">
            <p>
                <span>Subcription</span><br>
          <table>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="txtName" size="30"/></td>
                </tr>
                <tr>
                    <td >Email:</td>
                    <td><input type="text" name="txtEmail" size="30" /></td>
                </tr>
                <tr>
                    <td colspan="2">Description:</td>
            </tr>
                <tr>
                    <td colspan="2"> <textarea cols="30" rows="4"></textarea> </td>
                </tr>
                <tr><td colspan="2" align="right"><input type="button" value="Send" name="btnSend"></td></tr>
                
          </table>
            </p>
            <p>
                <span>Cambodia The land of wonder</span><br>
            
          <div style="padding:10px;text-align:center">
                <a href="#"><img src="images/a1.jpg" height="85" width="138" /></a>
                <a href="#"><img src="images/a11.png" height="85" width="138"/></a>
                <a href="#"><img src="images/a22.png" height="85" width="138"/></a>
                <a href="#"><img src="images/a33.png" height="85" width="138"/></a>
                <a href="#"><img src="images/a44.jpg" height="85" width="138"/></a>
                <a href="#"><img src="images/a55.jpg" height="85" width="138"/></a>
          </div>
            </p>
            <p>
                <span>Number of Visitor</span>
          <table style="color:#FFF">
                    <tr>
                        <td>Today :</td>
                        <td>92939392</td>
                    </tr>
                    <tr>
                        <td>Yesterday :</td>
                        <td>393992000</td>
                    </tr>
                    <tr>
                        <td>All :</td>
                        <td>39399292039</td>
                    </tr>
                    <tr>
                        <td colspan="2">                    	
                        <a href="http://www.facebook.com/pages/Reachponlue/147971065267041" >facebook</a><br>
                         <iframe src="http://www.facebook.com/plugins/like.php?href=www.bavoyages.herobo.com"
                          scrolling="no" frameborder="0" style="border:none; width:250px; height:80px"></iframe>
                        </td>
					</tr> 
                 
          </table>
            </p>
        </div>
        
    </div>
    
</div>

    <div style="text-align:center;">
            
           
           
            <div class="footer">
			<p><span style="color:#00C;border-bottom:double 3px #00F;">Cambodia Photo</span></p>
                <a href="#"><img src="images/akr4.jpg" width="60" height="60"/></a>
                <a href="#"><img src="images/akr80.jpg" width="60" height="60"/></a>
                <a href="#"><img src="images/akr138.jpg" width="60" height="60"/></a>
                <a href="#"><img src="images/akr163.jpg" width="60" height="60"/></a>
                <a href="#"><img src="images/angkor95.jpg" width="60" height="60"/></a>
                <a href="#"><img src="images/cmb19.jpg" width="60" height="60"/></a>
             </div>
            
  <div style="z-index:0;background:#86B240;height:140px;padding-left:30px;margin-top:-35px;font-size:15px;" align="center">
                <br/><br/><br/>
                
        Address: #104Eo, Tnal Trang,Bakong, Siem Reap, Cambodia <br/> 
        Tel: +855 63963164<br/>
        HP: +855 16836690<br/>
        Fax: +855 63963164 +855 977817278<br/>
        Email:  kymaye@hotmail.fr
               
            </div>
 </div>



<a name="up" id="up"></a>
<div class="center" align="center">
	<div id="wrapper">
		<div id="wrapper_r">
			<div id="header">
				<div id="header_l">
					<div id="header_r">
						<div id="logo"></div>
						<jdoc:include type="modules" name="top" />
					</div>
				</div>
			</div>

			<div id="tabarea">
				<div id="tabarea_l">
					<div id="tabarea_r">
						<div id="tabmenu">
						<table cellpadding="0" cellspacing="0" class="pill">
							<tr>
								<td class="pill_l">&nbsp;</td>
								<td class="pill_m">
								<div id="pillmenu">
									<jdoc:include type="modules" name="user3" />
								</div>
								</td>
								<td class="pill_r">&nbsp;</td>
							</tr>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div id="search">
				<jdoc:include type="modules" name="user4" />
			</div>

			<div id="pathway">
				<jdoc:include type="modules" name="breadcrumb" />
			</div>

			<div class="clr"></div>

			<div id="whitebox">
				<div id="whitebox_t">
					<div id="whitebox_tl">
						<div id="whitebox_tr"></div>
					</div>
				</div>

				<div id="whitebox_m">
					<div id="area">
									<jdoc:include type="message" />

						<div id="leftcolumn">
						<?php if($this->countModules('left')) : ?>
							<jdoc:include type="modules" name="left" style="rounded" />
						<?php endif; ?>
						</div>

						<?php if($this->countModules('left')) : ?>
						<div id="maincolumn">
						<?php else: ?>
						<div id="maincolumn_full">
						<?php endif; ?>
							<?php if($this->countModules('user1 or user2')) : ?>
								<table class="nopad user1user2">
									<tr valign="top">
										<?php if($this->countModules('user1')) : ?>
											<td>
												<jdoc:include type="modules" name="user1" style="xhtml" />
											</td>
										<?php endif; ?>
										<?php if($this->countModules('user1 and user2')) : ?>
											<td class="greyline">&nbsp;</td>
										<?php endif; ?>
										<?php if($this->countModules('user2')) : ?>
											<td>
												<jdoc:include type="modules" name="user2" style="xhtml" />
											</td>
										<?php endif; ?>
									</tr>
								</table>

								<div id="maindivider"></div>
							<?php endif; ?>

							<table class="nopad">
								<tr valign="top">
									<td>
										<jdoc:include type="component" />
										<jdoc:include type="modules" name="footer" style="xhtml"/>
									</td>
									<?php if($this->countModules('right') and JRequest::getCmd('layout') != 'form') : ?>
										<td class="greyline">&nbsp;</td>
										<td width="170">
											<jdoc:include type="modules" name="right" style="xhtml"/>
										</td>
									<?php endif; ?>
								</tr>
							</table>

						</div>
						<div class="clr"></div>
					</div>
					<div class="clr"></div>
				</div>

				<div id="whitebox_b">
					<div id="whitebox_bl">
						<div id="whitebox_br"></div>
					</div>
				</div>
			</div>

			<div id="footerspacer"></div>
		</div>

		<div id="footer">
			<div id="footer_l">
				<div id="footer_r">
					<p id="syndicate">
						<jdoc:include type="modules" name="syndicate" />
					</p>
					<p id="power_by">
	 				 	<?php echo JText::_('Powered by') ?> <a href="http://www.joomla.org">Joomla!</a>.
						<?php echo JText::_('Valid') ?> <a href="http://validator.w3.org/check/referer">XHTML</a> <?php echo JText::_('and') ?> <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>.
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
<jdoc:include type="modules" name="debug" />




</body>
</html>


<script>

var time=null;
var ad=null;

 var PicArray = new Array("image_slide/1.jpg","image_slide/2.jpg","image_slide/8.jpg","image_slide/9.jpg","image_slide/10.jpg");


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