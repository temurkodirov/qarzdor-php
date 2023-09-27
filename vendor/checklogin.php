<?php
session_start();
require_once "../db.php";


if(isset($_POST['loginpassword'])){

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $login = validate($_POST['login']);
    $password = validate($_POST['password']);

    if (empty($login)) {
        $_SESSION['error'] = 'Login is required';
        header("Location: ../login.php");
        exit();
        
        
    } else if (empty($password)) {
        $_SESSION['error'] = 'Password is required';
        header("Location: ../login.php");
        exit();
    } else {
        // $sql = "SELECT * FROM `users` WHERE `login`= '$login' AND `password` = '$password'";
        $result = mysqli_query($db, "SELECT * FROM users WHERE login = '$login' AND password = '$password' ");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user'] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'login' => $row['login']
            ];
            header("Location: ../index.php");
        } else {
            $_SESSION['error'] = 'Login or password incorrect';
            header("Location: ../login.php");
            exit();
        }
    }

} else {
    header("Location: ../login.php");
    exit();
}

?>