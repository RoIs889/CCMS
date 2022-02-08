<?php
$conn = new mysqli("localhost", "root", "", "my_db");
$msg = "";
session_start();


if (isset($_POST['login'])) {

    // $_SESSION['post-data'] = $_POST;

    $name = $_POST["username"];
    $password = $_POST["password"];
    $_SESSION['name'] = $_POST['username'];

    $role = filter_input(INPUT_POST, 'usertype', FILTER_SANITIZE_STRING);
    $role = $_POST["usertype"];

    switch ($role) {
        case "Customer":
            $query = "SELECT * FROM `customer` WHERE `Name` = '$name' AND `password` = '$password' AND `usertype` = '$role' ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 0) {
                $msg = "Incorrect username or password!";
            } else if (mysqli_num_rows($result) !== 0) {
                header("Location: cust.php");
            }
            break;
        case "Clerks Manager":

            $query = "SELECT * FROM `employee` WHERE `Name` = '$name' AND `Password` = '$password' AND `usertype` = '$role' ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 0) {
                $msg = "Incorrect username or password!";
            } else if (mysqli_num_rows($result) != 0) {
                header("Location: clerk's_manager.php");
            }
            break;
        case "Clerk":

            $query = "SELECT * FROM `employee` WHERE `Name` = '$name' AND `Password` = '$password' AND `usertype` = '$role' ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 0) {
                $msg = "Incorrect username or password!";
            } else if (mysqli_num_rows($result) != 0) {
                header("Location: clerk.php");
            }

            break;
        case "Distributor":

            $query = "SELECT * FROM `employee` WHERE `Name` = '$name' AND `Password` = '$password' AND `usertype` = '$role' ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 0) {
                $msg = "Incorrect username or password!";
            } else if (mysqli_num_rows($result) != 0) {
                header("Location: distributor.php");
            }
            break;
        case "Admin":

            $query = "SELECT * FROM `employee` WHERE `Name` = '$name' AND `Password` = '$password' AND `usertype` = '$role' ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 0) {
                $msg = "Incorrect username or password!";
            } else if (mysqli_num_rows($result) != 0) {
                header("Location: admin.php");
            }
            break;

        default:
            $msg = "sth is wrong!";
    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="style.css?v= <?php echo time(); ?>">
    <link rel="icon" type="image/x-icon" href="logo_ccms.png">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</head>

<body>
    <div class="form">
        <form action="index.php" method="post">
            <h1>LOGIN</h1>

            <?php if ($msg != '') : ?>
                <div class="alert"><?php echo $msg; ?></div>
            <?php endif; ?>

            <label for="username">Username</label>
            <input type="text" name="username" id="" value="" autofocus>

            <label for="password">Password</label>
            <input type="password" name="password" id="" autofocus>

            <label for="usertype">User Type</label>
            <select name="usertype" id="">
                <option value="Customer">Customer</option>
                <option value="Clerk">Clerk</option>
                <option value="Clerks Manager">Clerk's Manager</option>
                <option value="Distributor">Distributor</option>
                <option value="Admin">Admin</option>
            </select>

            <button type="submit" name="login"> <i id="log" class="fas fa-sign-in-alt"></i>Login</button>

        </form>
    </div>

</body>

</html>