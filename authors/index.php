<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'author') {
    header('Location: ../login.php');
}


// create a new blog 


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["create_blog"])) {
    $title = htmlspecialchars(trim($_POST['']));
    $content = htmlspecialchars(trim($_POST['']));
    $tags = htmlspecialchars(trim($_POST['']));
    $categorie = htmlspecialchars(trim($_POST['']));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Author Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
                        class="w-full text-left bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 dark:bg-indigo-700 dark:hover:bg-indigo-600 btnAddArticle">
                        Add Articles
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
                    class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-600"><a
                        href="../logout.php">
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
                <div class="inset-0 flex items-center justify-center">
                    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-2xl">
                        <h1 class="text-3xl font-extrabold text-gray-800 mb-6 border-b-2 border-indigo-500 pb-4">Manage
                            Your Articles</h1>
                        <table class="w-full table-auto border-collapse border border-gray-200 rounded-lg">
                            <thead>
                                <tr class="bg-indigo-500 text-white text-left">
                                    <th class="border border-gray-200 px-4 py-3">ID</th>
                                    <th class="border border-gray-200 px-4 py-3">Title</th>
                                    <th class="border border-gray-200 px-4 py-3">Views</th>
                                    <th class="border border-gray-200 px-4 py-3">Likes</th>
                                    <th class="border border-gray-200 px-4 py-3">Category</th>
                                    <th class="border border-gray-200 px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-gray-50 hover:bg-gray-100">
                                    <td class="border border-gray-200 px-4 py-3">1</td>
                                    <td class="border border-gray-200 px-4 py-3">The Future of Tech</td>
                                    <td class="border border-gray-200 px-4 py-3">1200</td>
                                    <td class="border border-gray-200 px-4 py-3">150</td>
                                    <td class="border border-gray-200 px-4 py-3">Technology</td>
                                    <td class="border border-gray-200 px-4 py-3">
                                        <div class="flex gap-4">
                                            <button
                                                class="bg-yellow-400 text-gray-800 px-4 py-2 rounded-lg hover:bg-yellow-500">Edit</button>
                                            <button
                                                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bg-gray-100 hover:bg-gray-200">
                                    <td class="border border-gray-200 px-4 py-3">2</td>
                                    <td class="border border-gray-200 px-4 py-3">Eco-Friendly Solutions</td>
                                    <td class="border border-gray-200 px-4 py-3">980</td>
                                    <td class="border border-gray-200 px-4 py-3">87</td>
                                    <td class="border border-gray-200 px-4 py-3">Lifestyle</td>
                                    <td class="border border-gray-200 px-4 py-3">
                                        <div class="flex gap-4">
                                            <button
                                                class="bg-yellow-400 text-gray-800 px-4 py-2 rounded-lg hover:bg-yellow-500">Edit</button>
                                            <button
                                                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bg-gray-50 hover:bg-gray-100">
                                    <td class="border border-gray-200 px-4 py-3">3</td>
                                    <td class="border border-gray-200 px-4 py-3">Climate Change and Technology</td>
                                    <td class="border border-gray-200 px-4 py-3">760</td>
                                    <td class="border border-gray-200 px-4 py-3">45</td>
                                    <td class="border border-gray-200 px-4 py-3">Environment</td>
                                    <td class="border border-gray-200 px-4 py-3">
                                        <div class="flex gap-4">
                                            <button
                                                class="bg-yellow-400 text-gray-800 px-4 py-2 rounded-lg hover:bg-yellow-500">Edit</button>
                                            <button
                                                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </div>
    </div>


    <div class="hidden absolute inset-0 flex items-center justify-center p-4 containerCreateBlog">
        <div class="w-full max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Create a New Blog</h1>
                <button class="cancel"><i class="fa-solid fa-xmark"
                        style="color: #DC2626; font-size: 40px;"></i></button>
            </div>
            <form>
                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" name="title"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900"
                        placeholder="Enter blog title" required>
                </div>
                <!-- Content -->
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea id="content" name="content" rows="6"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900"
                        placeholder="Write your blog content here" required></textarea>
                </div>
                <!-- Tags -->
                <div class="mb-4">
                    <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                    <input type="text" id="tags" name="tags"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900"
                        placeholder="e.g., technology, coding, design">
                </div>
                <!-- Category -->
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select id="category" name="category"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900"
                        required>
                        <option value="">Select a category</option>
                        <option value="technology">Technology</option>
                        <option value="lifestyle">Lifestyle</option>
                        <option value="education">Education</option>
                        <option value="health">Health</option>
                    </select>
                </div>
                <!-- Submit Button -->
                <div>
                    <button type="submit" name="create_blog"
                        class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-300">
                        Create Blog
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script src="main.js"></script>
</body>

</html>