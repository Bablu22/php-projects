<?php
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");
require_once("includes/config.php");


$account = new Account($con);

if (isset($_POST['submitButton'])) {
    $username = FormSanitizer::sanitizeFormUsername($_POST['username']);
    $password = FormSanitizer::sanitizeFormPassword($_POST['password']);
    $account->login($username, $password);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome to Netflix</title>
    <link rel="stylesheet" type="text/css" href="assets/styles/styles.css"/>
</head>
<body>
<div class="signInContainer">
    <div class="column">
        <div class="header">
            <div>
                <img src="assets/images/logo.png" title="Logo" alt="Site logo"/>
            </div>
        </div>
        <form action="" method="POST">
            <small class="error"> <?php echo $account->getError(Constants::$invalidCredentials) ?></small>
            <label for=""></label>
            <input type="text" placeholder="Username" value="<?php $account::getInputValue('username'); ?>"
                   name="username" id="" required>

            <input type="password" placeholder="Password" name="password" id="" required>

            <input class="btn" type="submit" name="submitButton" value="Sing In">
        </form>
        <a href="register.php" class="signInMessage">Need an account? Sign up here!</a>
    </div>
</div>
</body>
</html>




