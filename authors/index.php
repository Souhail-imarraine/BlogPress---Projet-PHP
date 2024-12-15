<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Author Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <!-- Page Container -->
    <div class="max-w-7xl mx-auto p-6">

        <!-- Dashboard Header -->
        <header class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-indigo-600">Author Dashboard</h1>
            <p class="text-lg text-gray-600 mt-2">Manage Your Articles, Comments, and Performance</p>
        </header>

        <!-- Dashboard Navigation -->
        <div class="mb-8 flex justify-around text-center text-gray-700">
            <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Create Article</button>
            <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Manage Articles</button>
            <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">View Stats</button>
            <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Manage Comments</button>
        </div>

        <!-- Dashboard Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

            <!-- Articles Management -->
            <section class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-semibold text-indigo-600 mb-4">Manage Your Articles</h2>
                <ul class="space-y-4">
                    <li class="flex justify-between items-center">
                        <span class="text-gray-700">Article 1: "The Future of Tech"</span>
                        <div class="flex gap-4">
                            <button class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">Edit</button>
                            <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
                        </div>
                    </li>
                    <li class="flex justify-between items-center">
                        <span class="text-gray-700">Article 2: "Eco-Friendly Solutions"</span>
                        <div class="flex gap-4">
                            <button class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">Edit</button>
                            <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
                        </div>
                    </li>
                    <li class="flex justify-between items-center">
                        <span class="text-gray-700">Article 3: "Climate Change and Technology"</span>
                        <div class="flex gap-4">
                            <button class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">Edit</button>
                            <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
                        </div>
                    </li>
                </ul>
            </section>

            <!-- Article Statistics and Performance -->
            <section class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-semibold text-indigo-600 mb-4">Statistics and Performance</h2>
                <div class="grid grid-cols-2 gap-6">
                    <!-- Article Stats -->
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h3 class="font-semibold text-gray-700 mb-2">Article Views</h3>
                        <p class="text-lg font-bold text-indigo-600">1,234 Views</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h3 class="font-semibold text-gray-700 mb-2">Article Likes</h3>
                        <p class="text-lg font-bold text-indigo-600">567 Likes</p>
                    </div>
                    <!-- Comments Stats -->
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h3 class="font-semibold text-gray-700 mb-2">Comments Count</h3>
                        <p class="text-lg font-bold text-indigo-600">89 Comments</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h3 class="font-semibold text-gray-700 mb-2">Avg. Read Time</h3>
                        <p class="text-lg font-bold text-indigo-600">5 mins</p>
                    </div>
                </div>

                <!-- Graph Placeholder -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Article Performance Graph</h3>
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                        <p class="text-center text-gray-500">[Graph would appear here]</p>
                    </div>
                </div>
            </section>

        </div>

    </div>

</body>

</html>