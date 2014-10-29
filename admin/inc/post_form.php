
        <form role="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body" class="form-control" id="body"></textarea>
            </div>
            <div class="form-group">
            	<input type="hidden" name="original_picture" value="<?php echo $post['picture']; ?>" />
            	<?php
            	
            	if(!empty($post[picture])) { ?>
            		<a href="/img/<?php echo $post['picture']; ?>" target="_new">Picture Goes Here</a>
            		<?php
            	}
            	?>
            	<label for="photo">add file</label>
            	<input type="file" name="photo" id="photo">
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