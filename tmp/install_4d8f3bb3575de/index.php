<?php
/**
 * @template	Template by Jan Pavelka ( http://www.phoca.cz/ )
 * @copyright	Template - Copyright (C) 2011 Jan Pavelka
 * @copyright	Joomla! CMS - Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.
 * License GNU General Public License version 2 or later; see LICENSE.txt, see LICENSE.php
 */
 
defined('_JEXEC') or die;
JHTML::_('behavior.framework', true);
$dR	= ($this->countModules('position-3') or $this->countModules('position-6') or $this->countModules('position-8'));
$dB	= ($this->countModules('position-9') or $this->countModules('position-10') or $this->countModules('position-11'));
$dL	= ($this->countModules('position-4') or $this->countModules('position-7') or $this->countModules('position-5'));
if (!$dL && !$dR)	{$contentwidth = "3";}
if ($dL || $dR)		{$contentwidth = "2";}
if ($dL && $dR)		{$contentwidth = "1";}

$bottomCount = ( $this->countModules('position-9') > 0 ) + ( $this->countModules('position-10') > 0 ) + ( $this->countModules('position-11') > 0 );
$bottomWidth = $bottomCount > 0 ? ' w' . floor(99 / $bottomCount) : '';


$app					= JFactory::getApplication();
$paramsT				= $app->getTemplate(true)->params;
$pSlideshow				= $this->params->get('display_slideshow', 0);
$logo       			= $this->params->get('display_logo', 1);
$pSlideshowContent		= $this->params->get('slideshow', '');
$siteTitle				= $paramsT->get('sitetitle', '');
$siteDesc				= $paramsT->get('sitedescription', '');
$logoContent   			= $this->params->get('logo', '');
$color 		 			= $this->params->get('color_theme', 'red');

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >

<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/topmenu.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/layout.css" type="text/css" media="screen" charset="utf-8" />
<?php if ($this->direction == 'rtl') { ?>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template_rtl.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/topmenu_rtl.css" type="text/css" media="screen" charset="utf-8" />
<?php } ?>
<!--[if IE]>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template-ie.css" type="text/css" media="screen" charset="utf-8" />
<![endif]-->

<!--[if lt IE 7]>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/topmenu-ie6.css" type="text/css" media="screen" charset="utf-8" />
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/javascript/topmenu-ie6.js" type="text/javascript" charset="utf-8"></script>
<![endif]-->

<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/themes/<?php echo $color ?>/theme.css" type="text/css" media="screen" charset="utf-8" />
<?php if ($this->direction == 'rtl') { ?>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/themes_rtl.css" type="text/css" />
<?php } ?>
</head>

<body>
<!-- |begin| phoca-site -->
<div id="phoca-site">
	
	<!-- |begin| phoca-wrap -->
	<div id="phoca-wrap">

		<!-- |begin| phoca-header -->
		<div id="phoca-header">
		
			<h1 id="logo"><?php if ($logo == 1) { ?>
			<a href="<?php echo $this->baseurl ?>"><img src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($logoContent); ?>"  alt="<?php echo htmlspecialchars($siteTitle);?>" /></a>
			<?php }
			if ($logo == 0 ) {
				if (htmlspecialchars($siteTitle != '')) {
					echo '<a href="'. $this->baseurl .'">'.htmlspecialchars($siteTitle).'</a>';
				} else {
					echo '<a href="'. $this->baseurl .'">'.htmlspecialchars($app->getCfg('sitename')).'</a>';
				}
			} ?>
			<br /><span class="header-desc">
			<?php echo htmlspecialchars($siteDesc);?>
			</span></h1>
			
			<?php if ($this->countModules('position-15')) { ?>
			<div class="banner" >
				<jdoc:include type="modules" name="position-15"  />
			</div>
			<?php } ?>
		
		</div>
		<!-- |end| phoca-header -->
		
		<!-- |begin| phoca-topmenu -->
		<div id="phoca-topmenu">
			<jdoc:include type="modules" name="position-1" style="phocaTopMenu" />
		</div>
		<!-- |end| phoca-topmenu -->
		
		<div id="phoca-slideshow">
		<?php if ($pSlideshow == 1) { ?>
			<jdoc:include type="modules" name="position-16" />
		<?php } else { ?>
			<img src="<?php echo $this->baseurl ?>/<?php echo $pSlideshowContent; ?>" alt="" />
		<?php } ?>
		</div>
		
		
		<?php if ($this->countModules('position-0')) { ?>
			<div id="phoca-search" ><jdoc:include type="modules" name="position-0"  /></div>
		<?php }; ?>
		
		<?php if ($this->countModules('position-2')) { ?>
		<div id="breadcrumbs"><jdoc:include type="modules" name="position-2"  /></div>
		<?php } ?> 
		
		
		<div id="phoca-middle">
		
		<?php if ($dL) { ?>
			<!-- |begin| phoca-side1-bg -->
			<div id="phoca-side1-bg">
		<?php } ?>
				
				<?php if ($dR) { ?>
				<!-- |begin| phoca-side2-bg -->
				<div id="phoca-side2-bg">
				<?php }
				
				if ($dL) { ?>
				<!-- |begin| phoca-side1 -->
				<div id="phoca-side1">
					<jdoc:include type="modules" name="position-7" style="phocaBasic" headerLevel="3" />
					<jdoc:include type="modules" name="position-4" style="phocaBasic" headerLevel="3" />
					<jdoc:include type="modules" name="position-5" style="phocaDivision" headerLevel="2" />
				</div>
				<!-- |end| phoca-side1 -->
				<?php } ?>
	
				<!-- |begin| phoca-content -->
				<div id="phoca-content<?php echo $contentwidth; ?>">
					<div class="phoca-in">
					
						<?php if ($this->countModules('position-12')) { ?>
                        <div id="phoca-top"><jdoc:include type="modules" name="position-12"   /></div>
                        <?php } ?>
						
						<?php if ($this->getBuffer('message')) { ?>
						<div class="error"><h2><?php echo JText::_('JNOTICE'); ?></h2>
							<jdoc:include type="message" />
						</div>
						<?php } ?>
						<jdoc:include type="component" />
					</div>
					
					<?php if ($dB) { ?>
						<!-- |begin| phoca-content-bottom -->
						<!-- |end| phoca-content-bottom -->
					<?php } ?>
				</div>
				<!-- |end| phoca-content -->
		
				<?php if ($dR) { ?>
				<!-- |begin| phoca-side2 -->
				<div id="phoca-side2">
					<jdoc:include type="modules" name="position-6" style="phocaBasic"  headerLevel="3"/>
					<jdoc:include type="modules" name="position-8" style="phocaBasic"  headerLevel="3"  />
					<jdoc:include type="modules" name="position-3" style="phocaDivision"  headerLevel="3"  />
				</div>
				<!-- |end| phoca-side2 -->
				<?php } ?>
				
	
				<!-- |begin| phoca-footer -->
				<div id="phoca-clr"></div>
				<!-- |end| phoca-footer -->

			<?php
				if ($dR) { ?></div><!-- |end| phoca-side2-bg --><?php }
				if ($dL) { ?></div><!-- |end| phoca-side1-bg --><?php }
			?>
	
		</div>
		<!-- |end| phoca-middle -->
	
		<?php if ($dB) { ?>
		<!-- |begin| phoca-bottom -->
		<div id="phoca-bottom" class="bottomwidth<?php echo $bottomWidth; ?>">
			<div class="phoca-in" >
				<jdoc:include type="modules" name="position-9" style="phocaDivision" headerlevel="3" />
				<jdoc:include type="modules" name="position-10" style="phocaDivision" headerlevel="3" />
				<jdoc:include type="modules" name="position-11" style="phocaDivision" headerlevel="3" />
			</div>
		</div>
		<!-- |end| phoca-bottom -->
		<?php } ?>
	
	</div>
	<!-- |end| phoca-wrap -->

	<!-- |begin| phoca-footer -->
	<div id="phoca-footer">
		<div class="phoca-in">
			<?php if ($this->countModules('position-14')) { ?>
            <div class="phoca-footer-last"><jdoc:include type="modules" name="position-14"   /></div>
            <?php } ?>
			<div class="phoca-footer"><?php include_once('templates.php'); ?></div>
		</div>
	</div>
	<!-- |end| phoca-footer -->

<?php if ($this->countModules('debug')) { ?>
	<!-- |begin| phoca-debug -->
	<div id="phoca-debug">
		<jdoc:include type="modules" name="debug" />
	</div>
	<!-- |end| phoca-debug -->
	<?php } ?>

	<!-- Load the MenuMatic Class -->
	<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/javascript/MenuMatic_0.68.3.js" type="text/javascript" charset="utf-8"></script>
	<!-- Create a MenuMatic Instance -->
	<script type="text/javascript" >
		window.addEvent('domready', function() {			
			var myMenu = new MenuMatic(
				<?php if ($this->direction == 'rtl') { ?> {direction:{x: 'left',y: 'down' }} <?php } ?>
			);
		});		
	</script>
	<div>&nbsp;</div>
	
</div>
<!-- |end| phoca-site -->
</body>
</html>