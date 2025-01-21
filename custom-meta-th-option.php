<?php 
//=========this part of finctions.php=============



/**
 * send the data to database
 */
add_action('save_post', 'update_post_save_like_avada');
	function update_post_save_like_avada($post_id){
		update_post_meta($post_id, 'ranger', $_POST['ranger']);
		update_post_meta($post_id, 'titlebg', $_POST['titlebg']);
	}


/**
 * 
 * create new custom page options firoz
 */

		

 //link up css 
 function custom_page_options_style_like_avada() {
    // Register the style
    wp_register_style(
        'custom-css-page', // Unique handle for the stylesheet
        get_template_directory_uri() . '/assets/css/opt-page.css', // File path
        array(), // Dependencies (none in this case)
        '1.0.0' // Version
    );

    // Enqueue the style
    wp_enqueue_style('custom-css-page');
	wp_register_script(
		'asce-script', // Unique handle for the script
		get_template_directory_uri() . '/assets/js/ace.js', // File path
		array('jquery'), // Dependencies (e.g., jQuery)
		'1.0.0', // Version number
		true // Load in footer (true) or header (false)
	);

	// Enqueue the script
	wp_enqueue_script('asce-script');

	wp_register_script(
		'custom-script', // Unique handle for the script
		get_template_directory_uri() . '/assets/js/main.js', // File path
		array('jquery'), // Dependencies (e.g., jQuery)
		'1.0.0', // Version number
		true // Load in footer (true) or header (false)
	);

	// Enqueue the script
	wp_enqueue_script('custom-script');

	
}
add_action('admin_enqueue_scripts', 'custom_page_options_style_like_avada');


add_action('add_meta_boxes', 'custom_page_options_like_avada');

function custom_page_options_like_avada(){
	add_meta_box(
		'custom_page_options_like_avada',
		 'Page Options like avada', 
		 'custom_page_options_like_avada_callback', 
		 'page', 
		 'normal',
		  'high' 
		);
}

function custom_page_options_like_avada_callback(){
	?>
	<div class="pioneer-page-opt">
		<div class="pioneer-page-menu">
			<ul>
				<li rel="panel1" class="active"><a href="#"><i class="dashicons dashicons-media-spreadsheet"></i>slider</a></li>
				<li rel="panel2"><a href="#"><i class="dashicons dashicons-media-spreadsheet"></i>page Title</a></li>
				<li rel="panel3"><a href="#"><i class="dashicons dashicons-media-spreadsheet"></i>custom css</a></li>
				<li rel="panel4"><a href="#"><i class="dashicons dashicons-media-spreadsheet"></i>layout</a></li>
				<li rel="panel5" ><a href="#"><i class="dashicons dashicons-media-spreadsheet"></i>footer</a></li>
			</ul>
		</div>
		<div class="pioneer-page-panel">
			<div id="panel1" class="panel active">Firoz mahmud</div>
			<div id="panel2" class="panel">
				<table>
					<tr>
						<td>Page Title bar</td>
						<td>
							<div class="page-title-ber">
								<button class="button button-default ">show</button>
								<button class="button button-default ">hide</button>
							</div>
						</td>
					</tr>
					<tr>
						<td>page title bar hight </td>
						<?php 
						$hg= get_post_meta( get_the_ID(), 'ranger', true );
						?>
						<td>
							<input type="range" max="200" min="10" step="10" name="ranger" id="ranger" value="<?php echo $hg;?>">
              <input type="text" id="rang-val" type="text" value="<?php echo $hg;?>">
						</td>
					</tr>
					<tr >
						<td>page title bar background image</td>
						<td>
							<a id="tittbar" href="#" class="button button-primary ">uploaded an image</a>
							<input id="imgdata" type="hidden" name="titlebg" value="" >
							<?php 
							$gtt=get_post_meta( get_the_ID(), 'titlebg', true );
							?>
							<img id="upimgbg" src="<?php echo $gtt;?>" alt="">
						</td>
					</tr>
				</table>
			</div>
			<div id="panel3" class="panel">
				<h1>Put Custom css here </h1>
				<div id="sublineText">

				</div>
			</div>
			<div id="panel4" class="panel">Amir hamja</div>
			<div id="panel5" class="panel">Seiyum Ali</div>


		</div>
	</div>
	<?php

	

	
}



==========this part of jQuery============
//this part of jQuery
jQuery(document).ready(function($) {

        let editor = ace.edit('sublineText');
        editor.setTheme("ace/theme/monokai");
        editor.getSession().setMode("ace/mode/css");

        //Title page bar

        $('.page-title-ber button').on('click', function(e) {
            e.preventDefault();
            $('.page-title-ber button').removeClass('button-primary');
            $(this).addClass('button-primary');
        })
  
        //get value from age range
    $('input#age-range').on('change', function() {

        
        var age = $(this).val();
        $('input#age-number').val(age);
    });

//pioneer page options
    $('.pioneer-page-menu ul li').on('click',  function(e) {
        e.preventDefault();
        $('.pioneer-page-menu ul li').removeClass('active');
        $(this).addClass('active');

        let relv = $(this).attr('rel');
        $('.panel.active').fadeOut(200, function(){
            $('.panel').removeClass('active');
            $('#'+relv).fadeIn(200, function(){
                $(this).addClass('active');
            });
        });
       
     })
//page title bar hight

$('input#ranger').on('change', function() {

    var range = $(this).val();
    $('input#rang-val').val(range);
 });

 //image upload
$('a#tittbar').on('click',function(ee){
    ee.preventDefault();

    let ttbar= wp.media({
        title: 'Upload Image',
        button: {
            text: 'Use this image',
        },
        multiple: false
    });

    ttbar.open();

    ttbar.on('select', function(){ 
        let attachment = ttbar.state().get('selection').first().toJSON();
        $('input#imgdata').val(attachment.url);
        $('img#upimgbg').attr('src', attachment.url);    
    })

})
     
});
