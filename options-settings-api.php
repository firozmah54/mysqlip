<?php 
//have to setup functions.php


//make the option page with settings api

add_action( 'admin_menu', 'add_option_page' );

function add_option_page() {
	add_menu_page(
		'Option Page',
		'Option Page',
		'manage_options',
		'option-page',
		'option_page_callback',
		'dashicons-images-alt2',
		10

	);
	add_submenu_page(
		'option-page',//parent slug
		'Header Options',//page title
		'Header OPtions',//menu title
		'manage_options',//	capability
		'header-options',//menu slug
		'option_page_callback'// function


	);
	add_submenu_page(
		'option-page',
		'Social  links',
		'Social Links',
		'manage_options',
		'social-options',
		'option_page_callback'

	);
	add_submenu_page(
		'option-page',
		'Footer Options',
		'Footer Options',
		'manage_options',
		'footer-options',
		'option_page_callback'
	);
	add_submenu_page(
		'option-page',
		'Custom CSS',
		'Custom CSS',
		'manage_options',
		'custom-css',
		'option_page_callback'
	);

}
add_action('admin_enqueue_scripts', function(){

	wp_enqueue_style('wp-color-picker');
	wp_enqueue_script('wp-color-picker');

	wp_enqueue_media();
	wp_enqueue_script('opt-js', get_template_directory_uri().'/assets/js/options.js', ['jquery'],'1.0', true);

});

add_action('admin_init', function(){

	// header settings
	register_setting('header-options-group', 'header-options-val');

	add_settings_section( 'header-options-section', 'Header Options', function(){

	}, 'header-options' );
	

	add_settings_field('upload-log', 'UPload Logo', function(){

		$logimage=get_option('header-options-val');

		?>
		<a id="uploadlogo" class="button button-primary" href="">Logo Upload </a> <br><br>

		<input class="regular-text" type="hidden" name="header-options-val[logoimg]" id="uploadUrl" value="<?php if($logimage){ echo $logimage['logoimg'];}?>"><br>
		<img id="imgup" src="<?php if($logimage){ echo $logimage['logoimg'];}?>" alt="">

		<?php 

	}, 'header-options', 'header-options-section');





	add_settings_field('hr-cell', 'Phone NO ', function(){
		$cellup=get_option('header-options-val');
		?>
		<input class="regular-text" type="text" name="header-options-val[cell]" id="" value="<?php if($cellup){ echo $cellup['cell'];}?>"><br>
		
		<?php 
	}, 'header-options', 'header-options-section');




	add_settings_field('hr-email', 'Email ', function(){
		$emailup=get_option('header-options-val');
		?>
		
		<input class="regular-text" type="text" name="header-options-val[email]" id="" value="<?php if($emailup){ echo $emailup['email'];}?>"><br>
		
		<?php 

	}, 'header-options', 'header-options-section');





	add_settings_field('hr-color', 'Header color ', function(){
		$colorup=get_option('header-options-val');
		?>
		
		<input id="colorpicker" type="text" name="header-options-val[color]" id="" value="<?php if($colorup){ echo $colorup['color'];}?>"><br>
		
		<?php 

	}, 'header-options', 'header-options-section');

	
	//social group 
	register_setting('social-group', 'social-value');

	add_settings_section('social-fb', 'Social meida', function(){

	},'social-options');



	add_settings_field('fb', 'Facebook link', function(){

		$sl_media=get_option('social-value');
		?>

		<input class="regular-text" type="text" name="social-value[fm]" value="<?php if($sl_media){echo $sl_media['fm'];}?>">
		
		<?php 
	}, 'social-options','social-fb');



	add_settings_field('tw', 'Twitter Media' , function(){
		$sl_tw=get_option('social-value');
		?>

		<input class="regular-text" type="text" name="social-value[tw-media]" value="<?php if(isset($sl_tw)){echo $sl_tw['tw-media'];}?>">

	<?php 
	}, 'social-options', 'social-fb');






});

function option_page_callback(){
	?>
	<div class="wrap">
		<h1>Option Page</h1>
		<?php settings_errors();
		
		//option page active class add here 

		if(isset($_GET['page'])) {
			$activepage=$_GET['page'];
		}
		?>

		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php if($activepage=='header-options'){ echo 'nav-tab-active';}elseif($activepage=='option-page'){ echo 'nav-tab-active'; }?> " href="?page=header-options">Header Options</a>
			<a class="nav-tab <?php if($activepage=='social-options'){ echo 'nav-tab-active';}?>" href="?page=social-options">Social links</a>
			<a class="nav-tab <?php if($activepage=='footer-options'){ echo 'nav-tab-active';}?>" href="?page=footer-options">Footer Options</a>
			<a class="nav-tab <?php if($activepage=='custom-css'){ echo 'nav-tab-active';}?>" href="?page=custom-css">Custom CSS</a>
		</h2>

		<form method="post" action="options.php">


			<?php 
				if($activepage== 'header-options'){
					settings_fields('header-options-group');
					do_settings_sections('header-options');
				}elseif($activepage== 'social-options'){
					settings_fields('social-group');
					do_settings_sections('social-options');
				}
			


			
			?>



		<?php submit_button();?>
		</form>
		</div>

	<?php 

}
