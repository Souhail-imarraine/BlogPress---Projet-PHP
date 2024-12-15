<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive For You - Tailwind CSS</title>
    <script src="https://cdn.tailwindcss.com" defer></script>
</head>

<body class="bg-gray-900 font-sans">
    <!-- Page Container -->
    <div class="max-w-7xl mx-auto p-4 md:p-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white  mb-4 md:mb-0">
            BlogPress
            </h1>
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2">
                Deconnection
            </button>
        </div>

        <!-- Search Bar -->
        <div class="relative mb-6">
            <input type="text" placeholder="Search article..." class="w-full py-3 px-5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-400 outline-none" />
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
</body>

</html>