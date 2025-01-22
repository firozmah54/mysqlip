// have to add in  functions.php 

<?php 

/**
 * setting api start 
 */
	function custom_setting_page_script(){
		wp_register_script(
			'custom-script', // Unique handle for the script
			get_template_directory_uri() . '/assets/js/options.js', // File path
			array('jquery'), // Dependencies (e.g., jQuery)
			'1.0.0', // Version number
			true // Load in footer (true) or header (false)
		);
	
		// Enqueue the script
		wp_enqueue_media();
		wp_enqueue_script('custom-script');
	
		
	}

add_action('admin_enqueue_scripts', 'custom_setting_page_script');



add_action('admin_init', 'custom_setting_page_callback');

function custom_setting_page_callback(){
	register_setting('options_groups','theme_value');

			//header settings
		add_settings_section('header','Header Settings','header_callback','custom_setting_page');
		add_settings_field('logo','Header Logo','logo_callback','custom_setting_page','header');



	add_settings_section('options_theme_section','Theme Options','custom_setting_page_callback_section','custom_setting_page');

	add_settings_field('pn', 'phone number', 'phone_callback','custom_setting_page', 'options_theme_section');

	add_settings_field('el', 'Email number', 'email_callback','custom_setting_page', 'options_theme_section');


	

//social settings 
add_settings_section('ss','Social Settings','social_callback','custom_setting_page');

add_settings_field('fb','facebook','facebook_callback','custom_setting_page','ss');
add_settings_field('tw','twitter','twitter_callback','custom_setting_page','ss');
add_settings_field('in','instagram','instagram_callback','custom_setting_page','ss');
add_settings_field('li','linkedin','linkedin_callback','custom_setting_page','ss');




}
//header settings callback
function header_callback(){

}
//logo callback
function logo_callback(){
	$upimg=get_option('theme_value');
	?>
	<a id="uploaddd" class="button button-primary" href="#">logo Upload</a>

	<input type="text" class="regular-text" id="logofm"  name="theme_value[upmedia]" value="<?php echo $upimg['upmedia'];?>">

	<p>
		<img id="imm" src="<?php echo $upimg['upmedia'];?>" alt="">
	</p>
	<?php
}



//soacial callback
function social_callback(){
	
}
//facebook field callback 
function facebook_callback(){
	$fb=get_option('theme_value');
	?>
	<input type="text" class="regular-text" name="theme_value[fb]" value="<?php echo $fb['fb'];?>" >
	<?php 
}

//twitter field callback
function twitter_callback(){
	$tr=get_option('theme_value');
	?>
	<input type="text" class="regular-text" name="theme_value[tr]" value="<?php echo $tr['tr'];?>">
	<?php 
}

//instagram field callback
function instagram_callback(){
	$ig=get_option('theme_value');
	?>
	<input type="text" class="regular-text" name="theme_value[ig]" value="<?php echo $ig['ig'];?>">
	<?php 
}

//linkedin field callback
function linkedin_callback(){
	$ln=get_option('theme_value');
	?>
	<input type="text" class="regular-text" name="theme_value[ln]" value="<?php echo $ln['ln'];?>">
	<?php 
}






//section callback
function custom_setting_page_callback_section(){
	
}

// phone field callback
function phone_callback(){
	?>
	<input type="text" class="regular-text" name="" id="">
	<?php 
}
// email field callback
function email_callback(){
	?>
	<input type="text" class="regular-text" name="" id="">
	<?php 
}








 add_action('admin_menu', 'custom_setting_page_api');


 function custom_setting_page_api() {

	add_theme_page(
		'options pio',
		'options pio',
		'manage_options',
		'custom_setting_page',
		'custom_setting_page_api_callback'
		
	);
 }

 function custom_setting_page_api_callback(){

	?>

	<div class="wrap">
		<h2>Theme Options</h2>
		<?php settings_errors();?>
		<form action="options.php" method="post">

		<?php
		settings_fields('options_groups');
		do_settings_sections('custom_setting_page');
		?>


		<?php submit_button();?>
		</form>
	</div>

	<?php 
 }

===================about image in jquery========================
//about image in jquery

(function($){

    $(document).ready(function(){
       $('a#uploaddd').on('click', function(e){
           e.preventDefault();

           let ttbar= wp.media({
            title: 'Upload Image',
            button: {
                text: 'Use this image',
            },
            multiple: false
        });

        ttbar.on('select', function(){
            let logomedia=ttbar.state().get('selection').first().toJSON();
            $('input#logofm').val(logomedia.url);
            $('img#imm').attr('src', logomedia.url);
        })
    
        ttbar.open();
            
         });
    });

})(jQuery);
