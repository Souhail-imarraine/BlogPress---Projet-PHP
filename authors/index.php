<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'author') {
    header('Location: ../login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Author Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    @media (prefers-color-scheme: dark) {
        body {
            background-color: #121212;
            color: #e5e5e5;
        }
    }
    </style>
</head>

<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-200 font-sans">

    <div class="max-w-7xl mx-auto p-6 flex flex-col lg:flex-row">
        <div class="w-full lg:w-64 bg-gray-50 dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6 lg:mb-0 lg:h-screen">
            <h2 class="text-2xl font-semibold text-indigo-600 dark:text-indigo-400 mb-8">Dashboard</h2>
            <ul class="space-y-6">
                <li>
                    <button
                        class="w-full text-left bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 dark:bg-indigo-700 dark:hover:bg-indigo-600">
                        Manage Articles
                    </button>
                </li>
                <li>
                    <button
                        class="w-full text-left bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 dark:bg-indigo-700 dark:hover:bg-indigo-600">
                        View Stats
                    </button>
                </li>
                <li>
                    <button
                        class="w-full text-left bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 dark:bg-indigo-700 dark:hover:bg-indigo-600">
                        Manage Comments
                    </button>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-6">
            <!-- Header -->
            <header class="flex justify-between items-center mb-12">
                <h1 class="text-4xl font-extrabold text-indigo-600 dark:text-indigo-400">Author Dashboard</h1>
                <button
                    class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-600"><a href="../logout.php">
                    Deconnexion
                    </a>
                </button>
            </header>

            <!-- Static Content at the Top -->
            <section class="mb-12">
                <h2 class="text-2xl font-semibold text-indigo-600 dark:text-indigo-400 mb-6">Statistics and Performance
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Article Stats -->
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                        <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Article Views</h3>
                        <p class="text-lg font-bold text-indigo-600 dark:text-indigo-400">1,234 Views</p>
                    </div>
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                        <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Article Likes</h3>
                        <p class="text-lg font-bold text-indigo-600 dark:text-indigo-400">567 Likes</p>
                    </div>
                    <!-- Comments Stats -->
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                        <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Comments Count</h3>
                        <p class="text-lg font-bold text-indigo-600 dark:text-indigo-400">89 Comments</p>
                    </div>
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                        <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Avg. Read Time</h3>
                        <p class="text-lg font-bold text-indigo-600 dark:text-indigo-400">5 mins</p>
                    </div>
                </div>

                <!-- Graph Placeholder -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Article Performance Graph
                    </h3>
                    <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-sm">
                        <p class="text-center text-gray-500 dark:text-gray-400">[Graph would appear here]</p>
                    </div>
                </div>
            </section>

            <!-- Blog Management -->
            <section class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <h2 class="text-3xl font-semibold text-indigo-600 dark:text-indigo-400 mb-6">Manage Your Articles</h2>
                <ul class="space-y-6">
                    <li class="flex justify-between items-center bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                        <span class="text-lg font-medium text-gray-800 dark:text-gray-200">Article 1: "The Future of
                            Tech"</span>
                        <div class="flex gap-4">
                            <button
                                class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 dark:bg-yellow-600 dark:hover:bg-yellow-500">Edit</button>
                            <button
                                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-600">Delete</button>
                        </div>
                    </li>
                    <li class="flex justify-between items-center bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                        <span class="text-lg font-medium text-gray-800 dark:text-gray-200">Article 2: "Eco-Friendly
                            Solutions"</span>
                        <div class="flex gap-4">
                            <button
                                class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 dark:bg-yellow-600 dark:hover:bg-yellow-500">Edit</button>
                            <button
                                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-600">Delete</button>
                        </div>
                    </li>
                    <li class="flex justify-between items-center bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                        <span class="text-lg font-medium text-gray-800 dark:text-gray-200">Article 3: "Climate Change
                            and Technology"</span>
                        <div class="flex gap-4">
                            <button
                                class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 dark:bg-yellow-600 dark:hover:bg-yellow-500">Edit</button>
                            <button
                                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-600">Delete</button>
                        </div>
                    </li>
                </ul>
            </section>

        </div>
    </div>

</body>

</html>