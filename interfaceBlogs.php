<?php 
require_once 'connection.php';


if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST[""]))

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive For You - Tailwind CSS</title>
    <script src="https://cdn.tailwindcss.com" defer></script>
</head>

<body class="bg-gray-900 font-sans">
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

    <!-- Page Container -->
    <div class="max-w-7xl mx-auto p-4 md:p-6">

        <!-- Search Bar -->
        <div class="relative mb-6">
            <input type="text" placeholder="Search article..."
                class="w-full py-3 px-5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 outline-none" />
        </div>

        <!-- Navigation Tabs -->
        <div class="flex gap-4 text-gray-400 border-b pb-3 mb-6 overflow-x-auto">
            <span class="text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-2">All</span>
            <span class="hover:text-indigo-600 cursor-pointer">Technology</span>
            <span class="hover:text-indigo-600 cursor-pointer">Environment</span>
            <span class="hover:text-indigo-600 cursor-pointer">Business</span>
            <span class="hover:text-indigo-600 cursor-pointer">Politics</span>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Articles Section -->
            <div class="w-full lg:w-2/3 space-y-6">
                <!-- Article Card 1 -->
                <div class="flex flex-col sm:flex-row gap-4 bg-white rounded-lg shadow p-4 hover:shadow-md transition">
                    <img src="https://via.placeholder.com/150" alt="Article Image"
                        class="w-full sm:w-32 h-32 object-cover rounded-lg" />
                    <div class="flex-1">
                        <h2 class="font-bold text-lg">
                            The overlooked benefits of real Christmas trees
                        </h2>
                        <p class="text-gray-500 text-sm my-2">
                            The environmental pros and cons of Christmas trees go far beyond
                            the...
                        </p>
                        <div class="flex items-center text-sm gap-2">
                            <span class="text-gray-700 font-semibold">⭐ Rey</span>
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs">Environment</span>
                            <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-xs">Green</span>
                        </div>
                        <div class="flex items-center gap-4 mt-2 text-gray-400">
                            <span>41 ❤️</span>
                            <span>21 💬</span>
                            <button class="ml-auto text-indigo-600 font-semibold hover:underline">
                                Read More
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Article Card 2 -->
                <div class="flex flex-col sm:flex-row gap-4 bg-white rounded-lg shadow p-4 hover:shadow-md transition">
                    <img src="https://via.placeholder.com/150" alt="Article Image"
                        class="w-full sm:w-32 h-32 object-cover rounded-lg" />
                    <div class="flex-1">
                        <h2 class="font-bold text-lg">
                            The law comes for Bankman-Fried
                        </h2>
                        <p class="text-gray-500 text-sm my-2">
                            Less than a week after telling a BBC journalist that he didn’t
                            think he’d be arrested...
                        </p>
                        <div class="flex items-center text-sm gap-2">
                            <span class="text-gray-700 font-semibold">⭐ Sam</span>
                            <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded text-xs">Tech</span>
                            <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-xs">FTX</span>
                        </div>
                        <div class="flex items-center gap-4 mt-2 text-gray-400">
                            <span>34 ❤️</span>
                            <span>24 💬</span>
                            <button class="ml-auto text-indigo-600 font-semibold hover:underline">
                                Read More
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trending Section -->
            <div class="w-full lg:w-1/3">
                <h2 class="font-bold text-white mb-4">Trending</h2>
                <div class="space-y-4">
                    <!-- Trending Card -->
                    <div class="flex gap-4 items-start">
                        <img src="https://via.placeholder.com/70" alt="Trending Image"
                            class="w-16 h-16 object-cover rounded-lg" />
                        <div>
                            <h3 class="font-semibold text-white text-sm">
                                How Will AI Image Generators Affect Artists?
                            </h3>
                            <div class="flex items-center text-xs gap-2 text-gray-500">
                                <span>Rey</span>
                                <span class="bg-purple-100 text-purple-600 px-2 py-0.5 rounded">Art</span>
                                <span class="bg-blue-100 text-blue-600 px-2 py-0.5 rounded">Tech</span>
                            </div>
                        </div>
                    </div>

                    <!-- Trending Card 2 -->
                    <div class="flex gap-4 items-start">
                        <img src="https://via.placeholder.com/70" alt="Trending Image"
                            class="w-16 h-16 object-cover rounded-lg" />
                        <div>
                            <h3 class="font-semibold text-white text-sm">
                                Burying Green: Eco-Friendly Death Care On The Rise
                            </h3>
                            <div class="flex items-center text-xs gap-2 text-gray-500">
                                <span>Ron</span>
                                <span class="bg-green-100 text-green-600 px-2 py-0.5 rounded">Environment</span>
                                <span class="bg-blue-100 text-blue-600 px-2 py-0.5 rounded">Tech</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- modulle utilisateur -->

    <div class="relative">
        <div id="modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90">
            <div class="bg-white bg-opacity-70 backdrop-blur-md p-8 rounded-lg shadow-lg w-full max-w-md relative">
                <h2 class="text-2xl font-semibold text-center text-indigo-600 mb-6">Add this information</h2>
                <form action="signup.php" method="POST">
                <div id="errors"></div>
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" name="username" id="username" placeholder="username"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" placeholder="email"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2"
                            required>
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md">Click</button>
                </form>
            </div>
        </div>
    </div>



    <script src="blogs.js"></script>
</body>

</html>