<?php
/**
 * Default Theme for Croogo CMS
 *
 * @author Fahad Ibnay Heylaal <contact@fahad19.com>
 * @link http://www.croogo.org
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $title_for_layout; ?> &raquo; <?php echo Configure::read('Site.title'); ?></title>
	<?php
		echo $this->Layout->meta();
		echo $this->Layout->feed();
		echo $this->Html->css(array(
			'reset',
			'960',
			'theme',
			'ccp',
		));
		echo $this->Layout->js();
		echo $this->Html->script(array(
			'jquery/jquery.min',
			'jquery/jquery.hoverIntent.minified',
			'jquery/superfish',
			'jquery/supersubs',
			'theme',
		));
		echo $this->Blocks->get('css');
		echo $this->Blocks->get('script');
	?>
</head>
<body>
	<div id="wrapper">
		<div id="header-wrapper">
			<div id="top-nav">
				<!--this should be controlled by the cms as a navigation-->
				<ul>
					<li>PHILLADELPHIA CONVENTION CENTER</li>
					<li>|</li>
					<li>AIRPORT</li>
					<li>|</li>
					<li>CAR RENTALS</li>
					<li>|</li>
					<li>VISIT PHILLY.com</li>
				</ul>
			</div>
			<div id="header" class="container_16">
				<div id="logo" class="grid_16 float-left">
					<h1 class="site-title"><?php echo $this->Html->link(Configure::read('Site.title'), '/'); ?></h1>
					<p class="site-tagline"><?php echo Configure::read('Site.tagline'); ?></p>
					<?php echo $this->Html->image('/img/site/logo.png'); ?>
					<!-- a logo image should be add to the setting panel in the backend-->
				</div>
				<!--<div class="clear"></div>-->
				<div class="float-right">
					<div id="social">
						<?php echo $this->Html->image('/img/site/ad.png'); ?><!--ad image here-->
						<ul>
							<li><a>facebook</a></li>
							<li><a>twitter</a></li>
							<li><a>linkedin</a></li>
							<li><a>youtube</a></li>
						</ul>
					</div>
					<div id="nav" class="float-right">
						<div class="container_16">
							<?php echo $this->Layout->menu('main', array('dropdown' => true)); ?>
						</div>
					</div><!-- close nav -->
				</div>
				<div class="clear">&nbsp;</div>
			</div><!-- close header -->
		</div><!-- close header-wrapper-->
		<div class="clear">&nbsp;</div>

		<div id="main" class="container_16">
			
			<div id="sidebar" class="grid_5">
			<?php echo $this->Layout->blocks('right'); ?>
			</div>
			
			<div id="content" class="grid_11">
			<?php
				echo $this->Layout->sessionFlash();
				echo $content_for_layout;
			?>
			</div>

			

			<div class="clear"></div>
		</div>

		<div id="footer">
			<div class="container_16">
				<div class="grid_8 left">
					Powered by <a href="http://www.croogo.org">Croogo</a>.
				</div>
				<div class="grid_8 right">
					<a href="http://www.cakephp.org"><?php echo $this->Html->image('/img/cake.power.gif'); ?></a>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<?php
		echo $this->Blocks->get('scriptBottom');
		echo $this->Js->writeBuffer();
	?>
	</body>
</html>