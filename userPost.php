<?php 
	include_once 'header.php';
	include_once 'backend/post_functions.php';
?>

<?php

	$post_id = $_GET['id'];

	$message = "";

	if (isset($_POST['title']) AND isset($_POST['body'])) {

		$user_id = $_SESSION['user']['user_id'];

		$picture = '';
		if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0) {
			move_uploaded_file($_FILES['photo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] .'/img/headers/'. $_FILES['photo']['name']);
			$picture = $_FILES['photo']['name'];
		}

		$result = add_post($post_id, $_POST['title'], $_POST['body'], $user_id, $picture);

		if ($result === FALSE) {
			$message = '<div class="alert alert-danger">Failed to add post</div>';
		} else {
			$message = '<div class="alert alert-success">Successfully added post.</div>';
		}
	}
	$posts = get_post($post_id);
	$post = $posts[0];
?>
<header class="intro-header" style="background-image: url('img/headers/<?php echo $post['picture']; ?>')">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
				<div class="site-heading">
					<h1></h1>
					<br />
					<br />
					<br />
					<span class="subheading"></span>
				</div>
			</div>
		</div>
	</div>
</header>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">What I Have, Need's To Be Said.</h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i><a href=""></a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Post
            </li>
        </ol>
        <?php echo $message; ?>

        <form role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="<?php echo $post['title']; ?>" />
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body" class="form-control" id="body"><?php echo $post['body']; ?></textarea>
            </div>
            <div class="form-group">
            	<input type="hidden" name="original_picture" value="<?php echo $post['picture']; ?>" />
            	<?php
            	
            	if(!empty($post['picture'])) { ?>
            		<a href="/img/headers/<?php echo $post['picture']; ?>" target="_new"></a>
            		<?php
            	}
            	?>
            	<label for="photo">add file</label>
            	<input type="file" name="photo" id="photo" />
            </div>
            <button type="submit" class="btn btn-info">
                Post
            </button>
        </form>
        
<script>
	var post id =<?php echo $_GET['id']; ?>;
	var user id =<?php echo $_SESSION['user']['user_id']; ?>;
	
	var comment;
	$(function() {
		$('#comment-form').submit(function(){
			comment = $('#comment').val();
			
			var data = {
				'post_id': post_id,
				'user_id': user_id,
				'comment': comment
			}
		});
	});
</script>
    </div>
</div>
