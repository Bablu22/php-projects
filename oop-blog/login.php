<?php
@include("header.php");
@include("account.php");
@include("db.php");
$user = new Account($db);
if (isset($_POST['user_login'])) {
    $user->login($_POST['username'], md5($_POST['password']));
}
?>

<div class="container mx-auto">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="bg-body-secondary shadow-md p-5 mt-3">
                <h4>Admin Login ✌</h4>
                <hr>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control rounded-0" name="username" id="username"
                               aria-describedby="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control rounded-0" id="password">
                    </div>
                    <button type="submit" name="user_login" class="btn btn-primary rounded-0">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>