<?php
require 'connection.php';

session_start();

if(isset($_SESSION['logged_in'])){
    header('Location: authors/index.php');
    exit();
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["signin"])) {
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = htmlspecialchars(trim($_POST["password"]));

    if (empty($email)) {
        $errors[] = "Email is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    if (!$errors) {
        $query = "SELECT id, username, email, password, role FROM users WHERE email = ? LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);
        $userExists = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$userExists) {
            $errors[] = "The email, $email, does not exist.";
        } else {
            if (password_verify($password, $userExists['password'])) {
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $userExists['id'];
                $_SESSION['username'] = $userExists['username'];
                $_SESSION['role'] = $userExists['role'];

                $_SESSION['success_message'] = "You have successfully signed in.";
                header('Location: authors/index.php');
                exit();
            } else {
                $errors[] = "Invalid password.";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>

<body>
    <header>
        <nav class="bg-white border-gray-200 dark:bg-gray-900">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">BlogPress</span>
                </a>
                <button data-collapse-toggle="navbar-default" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul
                        class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        <li>
                            <a href="index.php"
                                class="block py-2 px-3 text-white rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white"
                                aria-current="page">Home</a>
                        </li>

                        <li>
                            <a href="interfaceBlogs.php"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Article</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="font-[sans-serif] bg-white md:h-screen">
        <div class="grid md:grid-cols-2 items-center h-full">
            <div class="w-full h-full">
                <img src="img/technology-communication-icons-symbols-concept.jpg" class="w-full h-full object-cover"
                    alt="login-image" />
            </div>


            <div class="flex items-center md:p-8 p-6 bg-[#0C172C] h-full lg:w-11/12 lg:ml-auto">
                <form method="post" action="" class="max-w-lg w-full mx-auto">
                    <div class="mb-12">
                        <h3 class="text-3xl font-bold text-yellow-400">Sign in</h3>
                    </div>

                    <?php include 'errors.php'; ?>
                    <?php include 'succes_mess.php'; ?>

                    <div class="mt-8">
                        <label class="text-white text-xs block mb-2">Email</label>
                        <div class="relative flex items-center">
                            <input name="email" type="text"
                                class="w-full bg-transparent text-sm text-white border-b border-gray-300 focus:border-yellow-400 px-2 py-3 outline-none"
                                placeholder="Enter email" value="" />
                        </div>
                    </div>

                    <div class="mt-8">
                        <label class="text-white text-xs block mb-2">Password</label>
                        <div class="relative flex items-center">
                            <input name="password" type="password"
                                class="w-full bg-transparent text-sm text-white border-b border-gray-300 focus:border-yellow-400 px-2 py-3 outline-none"
                                placeholder="Enter password" />
                        </div>
                    </div>

                    <div class="mt-12">
                        <button type="submit" name="signin"
                            class="w-max shadow-xl py-3 px-6 text-sm text-gray-800 font-semibold rounded-md bg-yellow-400 hover:bg-yellow-500 focus:outline-none">
                            Sign In
                        </button>
                        <p class="text-sm text-white mt-8">Create New account? <a href="signup.php"
                                class="text-yellow-400 font-semibold hover:underline ml-1">Sign up</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="main.js"></script>
</body>

</html>