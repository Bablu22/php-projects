<?php

class Account
{
    private object $con;
    private array $errorsArray = array();

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function register($firstname, $lastname, $username, $email, $password, $confirm_password): bool
    {
        $this->validateFirstName($firstname);
        $this->validateLastName($lastname);
        $this->validateUsername($username);
        $this->validateEmail($email);
        $this->validatePassword($password, $confirm_password);

        if (empty($this->errorsArray)) {
            $this->insertUserDetails($firstname, $lastname, $username, $email, $password);
            $_SESSION['registeredUser'] = $username;
            header('Location: index.php');
            exit;
        }
        return false;
    }

    private function insertUserDetails($firstname, $lastname, $username, $email, $password): void
    {
        $password = hash("sha256", $password);
        $query = $this->con->prepare("INSERT INTO users (first_name, last_name, username, email, password) VALUES (:first_name,:last_name,:username,:email,:password)");

        $query->bindValue(":first_name", $firstname);
        $query->bindValue(":last_name", $lastname);
        $query->bindValue(":username", $username);
        $query->bindValue(":email", $email);
        $query->bindValue(":password", $password);
        $query->execute();
    }

    public function login($username, $password): bool
    {
        $password = hash("sha256", $password);
        $query = $this->con->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
        $query->bindValue(":username", $username);
        $query->bindValue(":password", $password);
        $query->execute();

        if ($query->rowCount() == 1) {
            $_SESSION['registeredUser'] = $username;
            header('Location: index.php');
            exit;
        }
        $this->errorsArray[] = Constants::$invalidCredentials;
        return false;
    }

    private function validateFirstName($firstName): void
    {
        if (strlen($firstName) < 2 || strlen($firstName) > 25) {
            $this->errorsArray[] = Constants::$firstNameCharacters;
        }
    }

    private function validateLastName($lastname): void
    {
        if (strlen($lastname) < 2 || strlen($lastname) > 25) {
            $this->errorsArray[] = Constants::$lastNameCharacters;
        }
    }

    private function validateUsername($username): void
    {
        if (strlen($username) < 2 || strlen($username) > 25) {
            $this->errorsArray[] = Constants::$usernameCharacters;
            return;
        }
        $query = $this->con->prepare("SELECT * FROM  users WHERE username=:un");
        $query->bindValue(":un", $username);
        $query->execute();

        if ($query->rowCount() != 0) {
            $this->errorsArray[] = Constants::$usernameUsed;
        }

    }

    private function validateEmail($email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errorsArray[] = Constants::$invalidEmail;
            return;
        }
        $query = $this->con->prepare("SELECT * FROM  users WHERE email=:em");
        $query->bindValue(":em", $email);
        $query->execute();

        if ($query->rowCount() != 0) {
            $this->errorsArray[] = Constants::$emailTaken;
        }
    }

    private function validatePassword($password, $confirm_password): void
    {
        if ($password != $confirm_password) {
            $this->errorsArray[] = Constants::$passwordDontMatch;
            return;
        }
        if (strlen($password) < 6 || strlen($password) > 25) {
            $this->errorsArray[] = Constants::$passwordLength;
        }
    }

    public function getError($error)
    {
        if (in_array($error, $this->errorsArray)) {
            return $error;
        }
        return null;
    }

    public static function getInputValue($input): void
    {
        if (isset($_POST[$input])) {
            echo $_POST[$input];
        }
    }
}

