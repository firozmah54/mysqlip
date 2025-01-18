<?php 
/*
Template Name: Prioneer Plugins
Description: A custom template for specific pages.
*/




/**
 * for creating data  to database
 */
register_activation_hook(__FILE__, 'create_custom_table');

function create_custom_table() {
    global $wpdb;
    $prefix = $wpdb->prefix;
    $table_prefix = $prefix . 'pioneer_users';

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    $sql = "CREATE TABLE $table_prefix (
        id int(11) AUTO_INCREMENT,
        name varchar(255),
        email varchar(255),
        cell varchar(255),
        UNIQUE KEY id (id)
    );";

    dbDelta($sql);
 
}

/**
 * it have to add to functions.php
 * otheraise it will not work
 */
//wpdb datails and insert from database


if(isset($_POST['submit'])){

	$name = $_POST['name'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$cell = $_POST['cell'];

	global $wpdb;
	$table_name = $wpdb->prefix . 'pioneer_users';
	$wpdb->insert($table_name, array(
		
		'name' => $name, 
		'email' => $email, 
		'username' => $username, 
		'cell' => $cell
		
	));

	header("Location: proneer.php");
}


/**
 * for delete data from database
 */
if(isset($_GET['delete_id'])) {

    global $wpdb;
    $prefix=$wpdb->prefix;
     $table_name=$prefix.'pioneer_users';
    $id = $_GET['delete_id'];
  
    /**
     * এভাবেও  করতে পারি।
     */
   // $sql = "DELETE FROM $table_name WHERE id = '$id'";
    //$wpdb->query($sql);


    /**
     * আবার এভাবেও  করতে পারি
     */
    $wpdb->delete($table_name,array(
        'id' => $id
    ) );
    wp_redirect(get_page_link($post->ID));
}


/**
 * it have to add to functions.php
 *
 */
//for updating data from database

if(isset($_POST['update_submit'])) {
    global $wpdb;
        // prefix == wp_;
    $prefix=$wpdb->prefix;
     $table_name=$prefix.'pioneer_users';
   
	 $edit_id=$_GET['edit_id'];
     
    $id = $_POST['update_submit'];
    $name = $_POST['update_name'];
    $email = $_POST['update_email'];
    $username = $_POST['update_username'];
    $cell = $_POST['update_cell'];

    $wpdb->update($table_name,array(
        'id'=>$edit_id,
        'name'=>$name,
        'email'=>$email,
        'username'=>$username,
        'cell'=>$cell
    ),array(
        'id'=> $edit_id
    ));
   
}

?>



<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        
        <header class="header-area mt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow">
                            <div class="card-body">
                                <form action="" method="POST">
                                    <div class="my-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                    <div class="my-3">
                                        <label for="name" class="form-label">email</label>
                                        <input type="text" name="email" id="name" class="form-control">
                                    </div>
                                    <div class="my-3">
                                        <label for="name" class="form-label">username</label>
                                        <input type="text" name="username" id="name" class="form-control">
                                    </div>
                                    <div class="my-3">
                                        <label for="name" class="form-label">cell</label>
                                        <input type="text" name="cell" id="name" class="form-control">
                                    </div>
                                    <div class="my-3">
                                     
                                        <input type="submit" name="submit" id="name" value="Submit" class="btn btn-primary" >
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="table-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">email</th>
                                    <th scope="col">username</th>
                                    <th scope="col">cell</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                global $wpdb;
                                $prefix=$wpdb->prefix;
                                 $table_name=$prefix.'pioneer_users';
                               // $table_name=$prefix.'posts';

                                /**
                                 * SELECT * FROM wp_posts sokol post and page get korar jonno
                                 */
                               // $result=$wpdb->get_results("SELECT * FROM $table_name  ORDER BY id ASC");

                               //post or page of post_type er jonno 
                               // $result=$wpdb->get_results("SELECT * FROM $table_name  WHERE post_type='post' AND post_status='publish' ORDER BY id ASC");

                               $result=$wpdb->get_results("SELECT * FROM $table_name  ORDER BY id ASC");

                                foreach($result as $row):
                                    
                                
                                ?>
                                <tr>
                                    <td><?php echo $row->id?></td>
                                    <td><?php echo $row->name?></td>
                                    <td><?php echo $row->email?></td>
                                    <td><?php echo $row->username?></td>
                                    <td><?php echo $row->cell?></td>
                                    <td>
                                        
                                        <a href="?edit_id=<?php echo $row->id?>" class="btn btn-primary">edit</a>
                                        <a href="?delete_id=<?php echo $row->id?>" class="btn btn-danger">delete</a>
                                    </td>
                                </tr>
                                <?php
                                
                            endforeach;

                            //for updateimg from database

                            if(isset($_GET['edit_id'])):
                               
                                $edit_id=$_GET['edit_id'];
                                $edit_result=$wpdb->get_results("SELECT * FROM $table_name WHERE id=$edit_id");
                                foreach($edit_result as $edit_data):
                       

                                ?>
                                   <form action="" method="POST">
                                    <div class="my-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="update_name" class="form-control" value="<?php echo $edit_data->name?>">
                                    </div>
                                    <div class="my-3">
                                        <label for="name" class="form-label">email</label>
                                        <input type="text" name="update_email"  class="form-control" value="<?php echo $edit_data->email?>">
                                    </div>
                                    <div class="my-3">
                                        <label for="name" class="form-label">username</label>
                                        <input type="text" name="update_username" class="form-control" value=" <?php echo $edit_data->username?> ">
                                    </div>
                                    <div class="my-3">
                                        <label for="name" class="form-label">cell</label>
                                        <input type="text" name="update_cell" class="form-control" value="<?php echo $edit_data->cell?>">
                                    </div>
                                    <div class="my-3">
                                        <input type="submit" name="update_submit" value="Update" class="btn btn-primary" >
                                    </div>
                                   </form> 

                                <?php
                                endforeach;
                                         endif;
                            
                            ?>

                            </tbody>


                        </table>
                    </div>
                </div>
            </div>

        </div>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>




