<?php
include_once 'admin_header.php';
 ?>
<?php
include_once '../backend/post_functions.php';

$posts = get_post();
?>
<style>
    .glyphicon-remove {
        color: red;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
    }
    .glyphicon-pencil {
        color: blue;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
    }
</style>
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Posts
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/admin">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Posts
                </li>
            </ol>

            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Created</th>
                    <th>Options</th>
                </tr>

                <?php
                foreach($posts as $post) {
                    ?>
                    <tr>
                        <td><?php echo $post['post_id']; ?></td>
                        <td><a href="post.php?id=<?php echo $post['post_id']; ?>"><?php echo $post['title']; ?></a></td>
                        <td><?php echo date('Y-m-d h:iA', $post['created_ts']); ?></td>
                        <td><span data-id="<?php echo $post['post_id']; ?>" class="glyphicon glyphicon-remove remove-post"></span>&nbsp;|&nbsp;
                        	<a href="post.php?id=<?php echo $post['post_id']; ?>"><span update-id="<?php echo $post['post_id']; ?>" class="glyphicon glyphicon-pencil update-post"></span></a></td>
                    </tr>
                <?php
				}
                ?>
            </table>
        </div>
    </div>
    <!-- /.row -->
    <script>
        $('.remove-post').click(function() {
            var confirm_result = confirm('Are you sure you want to delete this?');
            if (confirm_result) {
                var blah = $(this);
                var data = {
                    id : blah.attr('data-id')
                }
                $.post('../ajax/delete_post.php', data, function(response) {
                    if (response == 1) {
                        blah.parent().parent().remove();
                    }
                });
            }
        });
        
        $('.update-post').click(function() {
            var confirm_result = confirm('You\'re about to edit this post. Do you want to continue?');
            if (confirm_result) {
                var blah = $(this);
                var data = {
                    id : blah.attr('update-id')
                }
                $.post('../admin/post.php', data, function(response) {
                    if (response == 1) {
                        blah.parent().parent();
                    }
                });
            }
        });
    </script>

<?php
include_once 'admin_footer.php';
 ?>