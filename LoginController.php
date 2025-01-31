<?php


require_once 'DatabaseUser.php';

class LoginController
{
    private $errorMessage;

    public function __construct()
    {
        $this->errorMessage;
    }

    public function handleLogin()
    {
        if (isset($_POST['Login'])) {
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            if (empty($email) || empty($password)) {
                $this->errorMessage = "Fill The Fields";
                return;
            }
            $userDBHandler = new DatabaseUser();
            $user = $userDBHandler->getUserEmailPass($email, $password);
            if (empty($user)) {
                $this->errorMessage = "Email or Password invalid";
            } else {
                session_start();
                if ($user['role'] == "user") {
                    $_SESSION['useremail'] = $email;
                    header("Location: index.php");
                } else {
                    $_SESSION['adminemail'] = $email;
                    header("Location: dashboard.php");
                }
                exit;
            }
        }
    }
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}
?>