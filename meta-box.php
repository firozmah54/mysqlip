
show করার জন্য।  meta box সব সময় while loop এর মাধ্যমে show হয় 

<?php 
/**
 * template Name: Meta Box
 * 
 */
 get_header();
 while(have_posts()): the_post();
?>
<h2>
    <?php the_title(); ?>
    <span><?php echo get_post_meta(get_the_ID(), 'name', true)?></span>
</h2>
<?php
endwhile;


get_footer();?>

//***make the meta field for admin page ***//

ofcourse to functions.php
<?php
function my_custom_scripts() {

    // Register the script
	wp_register_script(
		'custom-jquery', // Unique handle for the script
		'//ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js',
		array('jquery'), // Dependencies (e.g., jQuery)
		'1.0.0', // Version number
		true
	);

	// Enqueue the script
	wp_enqueue_script('custom-jquery');

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
add_action('admin_enqueue_scripts', 'my_custom_scripts');


//rearch meta box so now start 

function sample_meta_boxes_fields() {
		add_meta_box(
			'page-meta-box',
			'Page Meta Box',
			'page_meta_box_callback',
			'page',
			'normal',
			'high'
		);
}
function page_meta_box_callback(){
	?>
	<!---start part--->
	<p>
		<label for="page_meta_box">Page Meta Box</label>
		<input type="text" id="page_meta_box" name="name" value="<?php echo get_post_meta(get_the_ID(), 'name', true);?>" class="widefat">
	</p>
	<!---end part--->

	<!---start part--->
	<p>
		<label for="gander_box">Gender</label>
		<br>
		<?php 
		$gender = get_post_meta(get_the_ID(), 'gender', true);
		?>
		<input type="radio" <?php echo $gender == 'male' ? 'checked' : '';?> name="gender" value="male"><label for="gander_box">Male</label>
		<input type="radio" <?php echo $gender == 'female' ? 'checked' : '';?> name="gender" value="female"><label for="female_box">Female</label>
	</p>
<!---end part--->

	<!---start part--->
	<p>
		<label for="date_box">Students </label>
		<br>
		<?php 
		$student = get_post_meta(get_the_ID(), 'student', true);
		$options=['SSC','JSC','PSC','HSC','BBA'];
		?>
		<select name="student" id="" class="widefat">
			<option value="">--select--</option>
			<?php 
			foreach($options as $option):
				?>
			
			<option <?php echo $student == $option ? 'selected' : '';?> value="<?php echo $option;?>"><?php echo $option; ?></option>
			
			<?php endforeach;?>

		</select>
	</p>

<!---end part--->

<!---start part--->
	<p>
		<label for="">Age</label>
		<?php 
		$ager=get_post_meta(get_the_ID(), 'age', true);
		
		?>
		<br>
		<input type="text" id="age-number" value="<?php echo $ager;?>" name="age"  style="width: 80px;">
		
		<input min="15" max="100" value="<?php echo $ager;?>" step="1" type="range" name="age" id="age-range" >
	</p>
<!---end part--->
	<?php

}

add_action('add_meta_boxes', 'sample_meta_boxes_fields');


/**
 * meta box থেকে  data save করার জন্য নিচের hook ব্যবহার করতে হবে 
 */
add_action('save_post', 'save_meta_box_data');

function save_meta_box_data($post_id){
	//meta box থেকে  database data পাঠানোর জন্য জন্য নিচের function ব্যবহার করতে হবে 
	update_post_meta($post_id,'name',$_POST['name']);
	update_post_meta($post_id,'gender',$_POST['gender']);
	update_post_meta($post_id,'student',$_POST['student']);
	update_post_meta($post_id,'age',$_POST['age']);

}
