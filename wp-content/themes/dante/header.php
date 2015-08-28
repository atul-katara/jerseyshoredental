<!DOCTYPE html>

<!--// OPEN HTML //-->
<html <?php language_attributes(); ?>>

	<!--// OPEN HEAD //-->
	<head>
		<?php
			$options = get_option('sf_dante_options');
			$enable_responsive = $options['enable_responsive'];
			$is_responsive = "responsive-fluid";
			if (!$enable_responsive) {
				$is_responsive = "responsive-fixed";
			}
			$header_layout = $options['header_layout'];
			$page_layout = $options['page_layout'];
			$enable_logo_fade = $options['enable_logo_fade'];
			$enable_page_shadow = $options['enable_page_shadow'];
			$enable_top_bar = $options['enable_tb'];
			$enable_mini_header = $options['enable_mini_header'];
			$enable_header_shadow = $options['enable_header_shadow'];
			$header_search_type = "search-1";
			if (isset($options['header_search_type'])) {
				$header_search_type = $options['header_search_type'];
			}
			
			$page_class = $header_wrap_class = $logo_class = $ss_enable = "";
			
			if (isset($_GET['header'])) {
				$header_layout = $_GET['header'];
			}
			
			if ($header_layout == "header-3" || $header_layout == "header-4" || $header_layout == "header-5") {
				$header_wrap_class = " container";
				$page_class .= "header-overlay ";
			}

			if (isset($options['enable_fw_header']) && $options['enable_fw_header'] == true) {
				$header_wrap_class .= " fw-header";
			}
			
			global $sf_catalog_mode;
			if (isset($options['enable_catalog_mode'])) {
				$enable_catalog_mode = $options['enable_catalog_mode'];
				if ($enable_catalog_mode) {
					$sf_catalog_mode = true;
					$page_class .= "catalog-mode ";
				}
			}
			
			if ($enable_mini_header) { 
			$page_class .= "mini-header-enabled ";
			}
			
			if ($enable_page_shadow) { 
			$page_class .= "page-shadow ";
			}
			
			if ($enable_header_shadow) {
			$page_class .= "header-shadow ";
			}
			
			if ($enable_logo_fade) {
			$logo_class = "logo-fade";
			}

			if (isset($_GET['layout'])) {
				$page_layout = $_GET['layout'];
			}
			
			$page_class .= "layout-".$page_layout." ";
			
			if (isset($options['ss_enable'])) {
				$ss_enable = $options['ss_enable'];
			} else {
				$ss_enable = true;
			}
			
			global $post, $remove_promo_bar, $enable_one_page_nav;
			$extra_page_class = $description = "";
			if ($post) {
				$extra_page_class = sf_get_post_meta($post->ID, 'sf_extra_page_class', true);
				$remove_promo_bar = sf_get_post_meta($post->ID, 'sf_remove_promo_bar', true);
				$enable_one_page_nav = sf_get_post_meta($post->ID, 'sf_enable_one_page_nav', true);
				$enable_naked_header = sf_get_post_meta($post->ID, 'sf_enable_naked_header', true);
				if ($enable_naked_header == "naked-light" || $enable_naked_header == "naked-dark") {
					if ($header_layout == "header-1" || $header_layout == "header-2") {
						$header_layout = "header-7";
					}
					$page_class .= "naked-header " . $enable_naked_header;
				}
			}
		?>
		
		<!--// SITE TITLE //-->
		<title><?php wp_title( '|', true, 'right' ); ?></title>
			
		<!--// SITE META //-->
		<meta charset="<?php bloginfo( 'charset' ); ?>" />	
		<?php if ($enable_responsive) { ?><meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php } ?>
		<?php if (isset($options['custom_ios_title']) && $options['custom_ios_title'] != "") { ?><meta name="apple-mobile-web-app-title" content="<?php echo $options['custom_ios_title']; ?>">
		<?php } ?>
		
		<!--// PINGBACK & FAVICON //-->
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php if (isset($options['custom_favicon']) && $options['custom_favicon'] != "") { ?><link rel="shortcut icon" href="<?php echo $options['custom_favicon']; ?>" /><?php } ?>
		
		<?php if (isset($options['custom_ios_icon144']) && $options['custom_ios_icon144'] != "") { ?>
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $options['custom_ios_icon144']; ?>" />
		<?php } ?>
		<?php if (isset($options['custom_ios_icon114']) && $options['custom_ios_icon114'] != "") { ?>
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $options['custom_ios_icon114']; ?>" />
		<?php } ?>
		<?php if (isset($options['custom_ios_icon72']) && $options['custom_ios_icon72'] != "") { ?>
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $options['custom_ios_icon72']; ?>" />
		<?php } ?>
		<?php if (isset($options['custom_ios_icon57']) && $options['custom_ios_icon57'] != "") { ?>
		<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo $options['custom_ios_icon57']; ?>" />
		<?php } ?>
				
		<?php
			$custom_fonts = $google_font_one = $google_font_two = $google_font_three = $google_font_subset = $subset_output = "";

			$body_font_option = $options['body_font_option'];
			if (isset($options['google_standard_font'])) {
			$google_font_one = $options['google_standard_font'];
			}
			$headings_font_option = $options['headings_font_option'];
			if (isset($options['google_heading_font'])) {
			$google_font_two = $options['google_heading_font'];
			}
			$menu_font_option = $options['menu_font_option'];
			if (isset($options['google_menu_font'])) {
			$google_font_three = $options['google_menu_font'];
			}
			
			if (isset($options['google_font_subset'])) {
			$google_font_subset = $options['google_font_subset'];
				$s = 0;
				if (is_array($google_font_subset)) {
					foreach ($google_font_subset as $subset) {
						if ($subset == "none") {
							break;
						}
						if ($s > 0) {
						$subset_output .= ','.$subset;
						} else {
						$subset_output = ':'.$subset;
						}
						$s++;
					}
				}
			}
			    
			if ($body_font_option == "google" && $google_font_one != "") {
				$custom_fonts .= "'".$google_font_one.$subset_output."', ";
			}
			if ($headings_font_option == "google" && $google_font_two != "") {
				$custom_fonts .= "'".$google_font_two.$subset_output."', ";
			}
			if ($menu_font_option == "google" && $google_font_three != "") {
				$custom_fonts .= "'".$google_font_three.$subset_output."', ";
			}
			
			$fontdeck_js = $options['fontdeck_js'];
		?>
		<?php if (($body_font_option == "google") || ($headings_font_option == "google") || ($menu_font_option == "google")) { ?>
		<!--// GOOGLE FONT LOADER //-->
		<script>
			var html = document.getElementsByTagName('html')[0];
			html.className += '  wf-loading';
			setTimeout(function() {
			  html.className = html.className.replace(' wf-loading', '');
			}, 3000);
			
			WebFontConfig = {
			    google: { families: [<?php echo $custom_fonts; ?> 'Vidaloka'] }
			};
			
			(function() {
				document.getElementsByTagName("html")[0].setAttribute("class","wf-loading")
				//  NEEDED to push the wf-loading class to your head
				document.getElementsByTagName("html")[0].setAttribute("className","wf-loading")
				// for IE
			
			var wf = document.createElement('script');
				wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
				 '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
				wf.type = 'text/javascript';
				wf.async = 'false';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(wf, s);
			})();
		</script>
		<?php } ?>
		<?php if (($body_font_option == "fontdeck") || ($headings_font_option == "fontdeck") || ($menu_font_option == "fontdeck")) { ?>
		<!--// FONTDECK LOADER //-->
		<?php echo $fontdeck_js; ?>
		<?php } ?>
		
		<!--// WORDPRESS HEAD HOOK //-->
		<?php wp_head(); ?>

             <script> (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-66797689-1', 'auto'); ga('send', 'pageview'); </script>
               
	
	<!--// CLOSE HEAD //-->
	</head>
	
	<!--// OPEN BODY //-->
	<body <?php body_class($page_class.' '.$is_responsive.' '.$extra_page_class.' '.$header_search_type); ?> ontouchstart="">
<!--<div class="phone_header" style="position: fixed; top: 45%; z-index: 100; right: -68px;"><div class="phone_tel"><p>(620) 627-7626</p></div>
<div class="phone_number"><img src="http://dental.webtage.com/wp-content/uploads/2015/07/phone_number_telephone-128.png" style="width: 20%;"></div></div>-->
<!--<div class="phone_header" style="position: fixed; top: 45%; z-index: 100; right: -68px;"><a href="tel:620-7626">(620) 627-7626<img src="http://dental.webtage.com/wp-content/uploads/2015/07/Dental-1.png" style="width: 20%;"></a></div>-->


<div class="phone_header" style="position: fixed; top: 55%; z-index: 100; right: 8px;">
<div class="noScroll" id="fixLeft">
	<ul>
    	<li class="iconB"><a href="#" title="Call Us"></a></li>
    	</ul>
</div></div>

		<div class="dental_sign"><a class="sf-button standard accent standard" href="#modal-dentalsign" role="button" data-toggle="modal"><img src="/wp-content/uploads/2015/07/Icon.png" style="width: 80%;"></a></div>

<!-- dental sign popup -->
<div id="modal-dentalsign" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="ss-delete"></i></button><h3 id="modal-label"></h3></div><div class="modal-body">
<div role="form" class="wpcf7" id="wpcf7-f986-p262-o1" lang="en-US" dir="ltr">
<div class="screen-reader-response"></div>
<form name="" action="/about-us-2/#wpcf7-f986-p262-o1" method="post" class="wpcf7-form" novalidate="novalidate">
<div style="display: none;">
<input type="hidden" name="_wpcf7" value="986" />
<input type="hidden" name="_wpcf7_version" value="4.2.1" />
<input type="hidden" name="_wpcf7_locale" value="en_US" />
<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f986-p262-o1" />
<input type="hidden" name="_wpnonce" value="3dd174d068" />
</div>
<h1 style="text-align: center; text-align: center;background-color: #45C2C5; color: white;">Contact Addison Dental Today</h1>
<p style="font-weight: bold;">Phone Number</p>
<p><img style="width: 30px;" src="http://www.addisondental.com/wp-content/uploads/2015/07/MB__phone.png"><a href="tel:630-627-7626">(630) 627-7626<a/></p>
<p style="margin-top: 20px; font-weight: bold;">Office Hours</p>
<p>Mon, Wed,Thurs,Fri – 9:00AM-5:30PM<br />
1st Sat of the Month – 9:00AM – Noon<br />
ON CALL 24 HOURS</p>
<p style="margin-top: 20px; font-weight: bold;">Find Us</p>
<p>Addison Dental<br />
190 N. Swift Rd Addison, IL 60194</p>
<h2 style="text-align: center; text-align: center;background-color: #45C2C5; color: white;">Request Appointment</h2>
<p style="font-size:16px;"><span class="wpcf7-form-control-wrap your-name"><input type="text" name="your-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Name" /></span> </p>
<p style="font-size:16px;"><span class="wpcf7-form-control-wrap your-phone"><input type="text" name="your-phone" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Phone Number" /></span> </p>
<p style="font-size:16px;">Reason for your appointment?</p>
<p style="font-size:16px;"><span class="wpcf7-form-control-wrap your-reason"><select name="your-reason" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false"><option value="Select">Select</option><option value="Schedule New Patient Appoinment">Schedule New Patient Appoinment</option><option value="Schedule a Routine Checkup">Schedule a Routine Checkup</option><option value="Schedule a Comprehensive Dental Exam">Schedule a Comprehensive Dental Exam</option><option value="Schedule ZOOM Teeth Whitening">Schedule ZOOM Teeth Whitening</option><option value="Schedule a Consultation">Schedule a Consultation</option><option value="My Tooth Hurts &amp; I Need to See a Doctor">My Tooth Hurts &amp; I Need to See a Doctor</option><option value="Other">Other</option></select></span></p>
<p style="font-size:16px;"><span class="wpcf7-form-control-wrap your-message"><textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" placeholder="Other Comments"></textarea></span> </p>
<p><input type="submit" value="REQUEST APPOINTMENT" class="wpcf7-form-control wpcf7-submit" /></p>
<div class="wpcf7-response-output wpcf7-display-none"></div></form></div><br />
</div></div></div></div>

		</div> 
	</div> </div></div>

<!-- dental sign popup -->

		<div id="header-search">
			<div class="container clearfix">
				<i class="ss-search"></i>
				<form method="get" class="search-form" action="<?php echo home_url(); ?>/"><input type="text" placeholder="<?php _e("Search for something...", "swiftframework"); ?>" name="s" autocomplete="off" /></form>
				<a id="header-search-close" href="#"><i class="ss-delete"></i></a>
			</div>
		</div>
		
		<?php
			// SUPER SEARCH
			if (sf_woocommerce_activated() && $ss_enable) { 
				echo sf_super_search();
			}
		?>
		
		<?php  
			// MOBILE MENU
			echo sf_mobile_menu();
		?>
		
		<!--// OPEN #container //-->
		<?php if ($page_layout == "fullwidth") { ?>
		<div id="container">
		<?php } else { ?>
		<div id="container" class="boxed-layout">
		<?php } ?>
			
			<!--// HEADER //-->
			<div class="header-wrap<?php echo $header_wrap_class; ?>">
				
				<?php if ($enable_top_bar) { ?>
					<!--// TOP BAR //-->
					<?php echo sf_top_bar(); ?>
				<?php } ?>	
					
				<div id="header-section" class="<?php echo $header_layout; ?> <?php echo $logo_class; ?>">
					<?php echo sf_header($header_layout); ?>
				</div>

			</div>
			
			<!--// OPEN #main-container //-->
			<div id="main-container" class="clearfix">
				
				<?php if (is_page()) {
					global $post;
					$show_posts_slider = sf_get_post_meta($post->ID, 'sf_posts_slider', true);
					$rev_slider_alias = sf_get_post_meta($post->ID, 'sf_rev_slider_alias', true);
					$layerSlider_ID = sf_get_post_meta($post->ID, 'sf_layerslider_id', true);
									
					if ($show_posts_slider) {
						sf_swift_slider();
					} else if ($rev_slider_alias != "") { ?>
						<div class="home-slider-wrap">
							<?php if (function_exists('putRevSlider')) {
								putRevSlider($rev_slider_alias);
							} ?>
						</div>
				<?php } else if ($layerSlider_ID != "") { ?>
					<div class="home-slider-wrap">
						<?php echo do_shortcode('[layerslider id="'.$layerSlider_ID.'"]'); ?>
					</div>
				<?php }
					}
				?>
								
				<!--// OPEN #page-wrap //-->
				<div id="page-wrap">
