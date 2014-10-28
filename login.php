<?php
$message = '';
if(isset($_POST['username']) AND isset($_POST['password']))
{
    include 'backend/user_functions.php';
    $result = login_user($_POST['username'], $_POST['password']);

    if(is_array($result)) {
        $message = '<div class="alert alert-success">Welcome, '.$result['username'].'</div>';
    } else {
        $message = '<div class="alert alert-danger">'.$result.'</div>';
    }
}

?>
<?php include_once 'header.php'; ?>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Login</h1>
                        <hr class="small">
                        <span class="subheading">Who Are You Really?</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <?php echo $message;?>
            <form role="form" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-default">Login</button>
            </form>
        </div>
    </div>

<?php include_once 'footer.php'; ?>