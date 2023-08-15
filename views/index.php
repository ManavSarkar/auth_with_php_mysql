<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication Manav</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body  class="bg-gray-100 h-screen flex justify-center items-center">
    <!-- welcome message -->
    <div class="bg-white p-8 rounded shadow-md w-1/2 text-center">
    <h1 class="text-2xl font-semibold mb-4">Welcome to Our Website</h1>
    <p class="text-gray-600 mb-6">Explore our amazing features and services.</p>
    <?php 
        session_start();
        if ($_SESSION && $_SESSION['auth']) {
            # code...
            $email = $_SESSION['email'];
            echo "<p class='text-gray-600 mb-6'>Your email is $email</p>";
            // logout button
            echo "<form action='/logout' method='POST'>
            <button type='submit' class='bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full text-sm transition duration-300'>Logout</button>
            </form>";
        } else {
            echo '<div class="flex space-x-4 justify-center">
        <a href="/login" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full text-sm transition duration-300">Login</a>
        <a href="/register" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-full text-sm transition duration-300">Register</a>
    </div>';
        }
        
    ?>
    
</div>
</body>
</html>
