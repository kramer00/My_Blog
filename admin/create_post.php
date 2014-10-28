<?php include_once 'admin_header.php'; ?>
<?php
$message = '';
if(isset($_POST['title']) AND isset($_POST['body'])) {
    include_once '../backend/post_functions.php';

    $user_id = $_SESSION['user']['user_id'];
    $result = add_post($_POST['title'], $_POST['body'], $user_id);

    if($result === FALSE) {
        $message = '<div class="alert alert-danger">Failed to create post</div>';
    } else {
        $message = '<div class="alert alert-success">Successfully created post.</div>';
    }
}

?>

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Create Post!
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/admin">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Create Post
                </li>
            </ol>
            <?php echo $message;?>
            <form role="form" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="body" class="form-control" id="body"></textarea>
                </div>
                <button type="submit" class="btn btn-info">Post</button>
            </form>
        </div>
    </div>
    <!-- /.row -->

<?php include_once 'admin_footer.php'; ?>