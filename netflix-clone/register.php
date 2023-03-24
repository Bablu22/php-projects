<?php
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");
require_once("includes/config.php");

$account = new Account($con);

if (isset($_POST['submitButton'])) {
    $firstName = FormSanitizer::sanitizeFormString($_POST['first_name']);
    $lastName = FormSanitizer::sanitizeFormString($_POST['last_name']);
    $username = FormSanitizer::sanitizeFormUsername($_POST['username']);
    $email = FormSanitizer::sanitizeFormEmail($_POST['email']);
    $password = FormSanitizer::sanitizeFormPassword($_POST['password']);
    $confirm_password = FormSanitizer::sanitizeFormPassword($_POST['confirm_password']);
    $account->register($firstName, $lastName, $username, $email, $password, $confirm_password);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome to Netflix</title>
    <link rel="stylesheet" type="text/css" href="assets/styles/styles.css"/>
</head>
<div class="signInContainer">

    <div class="column">
        <div class="header">
            <div>
                <img src="assets/images/logo.png" title="Logo" alt="Site logo"/>
            </div>
        </div>
        <form action="" method="POST">
            <label for=""></label>
            <input type="text"
                   placeholder="First Name"
                   name="first_name"
                   id=""
                   value="<?php $account::getInputValue('first_name'); ?>"
                   required>
            <small class="error"> <?php echo $account->getError(Constants::$firstNameCharacters) ?></small>

            <input type="text"
                   placeholder="Last Name"
                   name="last_name"
                   id=""
                   value="<?php $account::getInputValue('last_name'); ?>"
                   required>
            <small class="error"> <?php echo $account->getError(Constants::$lastNameCharacters) ?></small>

            <input type="text"
                   placeholder="Username"
                   name="username"
                   id=""
                   value="<?php $account::getInputValue('username'); ?>"
                   required>
            <small class="error"> <?php echo $account->getError(Constants::$usernameCharacters) ?></small>
            <small class="error"> <?php echo $account->getError(Constants::$usernameUsed) ?></small>

            <input type="email"
                   placeholder="Email"
                   name="email"
                   id=""
                   value="<?php $account::getInputValue('email'); ?>"
                   required>
            <small class="error"> <?php echo $account->getError(Constants::$invalidEmail) ?></small>
            <small class="error"> <?php echo $account->getError(Constants::$emailTaken) ?></small>

            <input type="password"
                   placeholder="Password"
                   name="password"
                   id=""
                   value="<?php $account::getInputValue('password'); ?>"
                   required>
            <small class="error"> <?php echo $account->getError(Constants::$passwordDontMatch) ?></small>
            <small class="error"> <?php echo $account->getError(Constants::$passwordLength) ?></small>

            <input type="password"
                   placeholder="Confirm Password"
                   name="confirm_password"
                   id=""
                   value="<?php $account::getInputValue('confirm_password'); ?>"
                   required>

            <input class="btn" type="submit" name="submitButton" value="Sing Up">
        </form>
        <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>
    </div>
</div>
</html>

