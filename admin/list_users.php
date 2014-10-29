<?php
include_once 'admin_header.php';
 ?>
<?php
include_once '../backend/user_functions.php';

$users = get_user();
?>
<style>
    .glyphicon-remove {
        color: red;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
    }
    .glyphicon-pencil {
		color:blue;
		font-size: 18px;
		font-weight: bold;
		cursor: pointer;
	}
</style>
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Users
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/admin">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Users
                </li>
            </ol>

            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Options</th>
                </tr>

                <?php
                foreach($users as $user) {
                    ?>
                    <tr>
                        <td><?php echo $user['user_id']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><span user-id="<?php echo $user['user_id']; ?>" class="glyphicon glyphicon-remove remove-user"></span>&nbsp;|&nbsp;<span user-id="<?php echo $user['user_id']; ?>" class="glyphicon glyphicon-pencil edit-user"></span></td>
                    </tr>
                <?php
				}
                ?>
            </table>
        </div>
    </div>
    <!-- /.row -->
<script>
    $('.remove-user').click(function() {
        var confirm_result = confirm('Are you sure you want to delete this clown?');
        if (confirm_result) {
            var blah = $(this);
            var data = {
                id : blah.attr('user-id')
            }
            $.post('../ajax/delete_user.php', data, function(response) {
                if (response == 1) {
                    blah.parent().parent().remove();
                }
            });
        }
    });
</script>
<?php
include_once 'admin_footer.php';
 ?>