<?php
include_once 'admin_header.php';
 ?>
<?php
	require_once '../backend/post_functions.php';

	$post_id = $_GET['id'];

	$message = "";

	if (isset($_POST['title']) AND isset($_POST['body'])) {

		$user_id = $_SESSION['user']['user_id'];

		$picture = '';
		if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0) {
			move_uploaded_file($_FILES['photo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] .'/img/headers/'. $_FILES['photo']['name']);
			$picture = $_FILES['photo']['name'];
		}

		$result = update_post($post_id, $_POST['title'], $_POST['body'], $user_id, $picture);

		if ($result === FALSE) {
			$message = '<div class="alert alert-danger">Failed to update post</div>';
		} else {
			$message = '<div class="alert alert-success">Successfully updated post.</div>';
		}
	}
	$posts = get_post($post_id);
	$post = $posts[0];
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Shh. I'm Updating A Post. </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i><a href="/admin">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Update Post
            </li>
        </ol>
        <?php echo $message; ?>
        <?php
		include 'inc/post_form.php';
        ?>
    </div>
</div>
<!-- /.row -->

<?php
	include_once 'admin_footer.php';
?>