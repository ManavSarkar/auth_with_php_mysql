
<?php

include "./database/db_manage.php";
include "./models/user.php";

$request = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];

// database
$database = new Database();

switch ($request_method) {
    case 'GET':

        switch ($request) {
            case '/':
                require __DIR__ . '/views/index.php';
                break;
            case '/login':
                require __DIR__ . '/views/login.php';
                break;

            case '/register':
                require __DIR__ . '/views/register.php';
                break;
            default:
                require __DIR__ . '/';
                break;
        }
        break;
    case 'POST':
        switch ($request) {
            case '/login':
                handleLogin();
                break;
            case '/register':
                handleRegister();
                break;

            case '/logout':
                handleLogout();
                break;
            default:
                require __DIR__ . '/views/index.php';
                break;
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}


function handleRegister()
{
    $username = $_POST['email'];
    $password = $_POST['password'];

    $user = new User();
    $user->email = $username;
    $user->password = $password;
    $user->name = $_POST['name'];

    $user->register();
}

function handleLogout()
{
    $user = new User();
    $user->logout();
}
function handleLogin()
{
    $username = $_POST['email'];
    $password = $_POST['password'];

    $user = new User();
    $user->email = $username;
    $user->password = $password;

    $user->login();
}

function function_alert($message)
{

    // Display the alert box 
    echo "<script>alert('$message');</script>";
}
