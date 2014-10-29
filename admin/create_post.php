<?php
include_once 'admin_header.php';
?>

<?php
$message = '';
if (isset($_POST['title']) AND isset($_POST['body'])) {
	include_once '../backend/post_functions.php';

	$user_id = $_SESSION['user']['user_id'];
	$result = add_post($_POST['title'], $_POST['body'], $user_id);

	if ($result === FALSE) {
		$message = '<div class="alert alert-danger">Failed to create post</div>';
	} else {
		$message = '<div class="alert alert-success">Successfully created post.</div>';
	}
}
?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Create Post! </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i><a href="/admin">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Create Post
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