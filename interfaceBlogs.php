<?php 
require_once 'connection.php';

$errors = [];

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["btn_clique"])){
    $username = htmlspecialchars(trim($_POST["username"]));
    $email = htmlspecialchars(trim($_POST["email"]));

    if (empty($username) || empty($email)) {
        array_push($errors, "All fields are required");
    }

    if(strlen($username) < 7){
        array_push($errors, "Username is required and must be at least 7 characters long.");
    }

    if($email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Invalid email format");
        }
    }

    if (!count($errors)) {
        $query = "SELECT id, email FROM users WHERE email = ? LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);

        if ($userExists) {
            array_push($errors, "Email already registered");
        }
    }

    if(empty($errors)){
        $query = "INSERT INTO users (username, email, role) VALUES (?, ?, 'visitor');";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $email]);

        // Jib l-id dyal l-user mn l-database
        $query = "SELECT id, username FROM users WHERE email = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);
        $userExists = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userExists) { 
            $_SESSION['is_visiteur'] = true;
            $_SESSION['id'] = $userExists['id'];
            $_SESSION['username'] = $userExists['username']; 
        }
        exit();
    }
}



    try {

        $query = "SELECT * FROM articles";
        $st = $pdo->prepare($query);
        $st->execute();
        $datainfo = $st->fetchAll(PDO:: FETCH_ASSOC);


    }catch(ErrorException $e){
        echo "error fetch data from article " . $e->getMessage();
    }


    // read blogs 

    if(isset($_POST["btnOpenBlogs"])) {
        header('Location: blogs.php');
    }

    // trending blogs 
    $queryTrend = "SELECT * FROM articles ORDER BY views desc LIMIT 3";
    $stTrent = $pdo->prepare($queryTrend);
    $stTrent->execute();
    $trendBlogs = $stTrent->fetchAll(PDO:: FETCH_ASSOC);

    
    // searching
    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['searching'])){
        $valueInput = '%'.$_GET['search'].'%';
        $querySearch = "SELECT * FROM articles WHERE title LIKE ? OR content LIKE ?";
        $stmt = $pdo->prepare($querySearch);
        $stmt->execute([$valueInput, $valueInput]);
        $datainfo = $stmt->fetchAll(PDO:: FETCH_ASSOC);
    }else {
        $querySearch = "SELECT * FROM articles";
        $stmt = $pdo->prepare($querySearch);
        $stmt->execute();
        $datainfo = $stmt->fetchAll(PDO:: FETCH_ASSOC);
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive For You - Tailwind CSS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 font-sans">
    <header>
        <nav class="bg-white border-gray-200 dark:bg-gray-900">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
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

    <div class="max-w-7xl mx-auto p-4 md:p-6">

        <div class="relative mb-6 w-full max-w-md">
            <form action="" method="get" class="flex items-center bg-white rounded-lg shadow-md overflow-hidden">
                <input type="text" placeholder="Search article..." name="search"
                    class="w-4/5 py-3 px-5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-400" />
                <button type="submit" name="searching"
                    class="w-1/5 bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 focus:outline-none focus:shadow-outline">Search
                </button>
            </form>
        </div>

        <div class="flex gap-4 text-gray-400 border-b pb-3 mb-6 overflow-x-auto">
            <span class="text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-2">All</span>
            <span class="hover:text-indigo-600 cursor-pointer">Technology</span>
            <span class="hover:text-indigo-600 cursor-pointer">Environment</span>
            <span class="hover:text-indigo-600 cursor-pointer">Business</span>
            <span class="hover:text-indigo-600 cursor-pointer">Politics</span>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <div class="w-full lg:w-2/3 space-y-6">
                <?php foreach($datainfo as $data) : ?>
                <div class="flex flex-col sm:flex-row gap-4 bg-white rounded-lg shadow p-4 hover:shadow-md transition">
                    <img src="blogs.jpg" alt="Article Image" class="w-full sm:w-32 h-32 object-cover rounded-lg" />
                    <div class="flex-1">
                        <h2 class="font-bold text-lg">
                            <?php echo $data['title']; ?>
                        </h2>
                        <p class="text-gray-500 text-sm my-2">
                            <?php echo $data['content'] ;?>
                        </p>
                        <div class="flex items-center text-sm gap-2">
                            <span class="text-gray-700 font-semibold">⭐ Rey</span>
                            <span
                                class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs"><?php echo $data['categorie']; ?></span>
                            <span
                                class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-xs"><?php echo $data['created_at'] ;?></span>
                        </div>
                        <div class="flex items-center gap-4 mt-2 text-gray-400">
                            <span> <?php echo $data['likes']; ?> ❤️</span>
                            <span>21 💬</span>
                            <div id="view-counter" class="flex items-center mr-4">
                                <span class="ml-1">Views: <span id="views"><?php echo $data['views'];?></span></span>
                            </div>
                            <button class="ml-auto text-indigo-600 font-semibold hover:underline btnOpenBlogs"
                                name="btnOpenBlogs">
                                <a href="blogs.php?BlogId=<?php echo $data['id']; ?>">Read More</a>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach ; ?>

            </div>

            <div class="w-full lg:w-1/3">
                <h2 class="font-bold text-white mb-4">Trending</h2>
                <div class="space-y-4">

                    <?php foreach($trendBlogs as $query): ?>
                    <div class="flex gap-4 items-start">
                        <img src="blogs.jpg" alt="Trending Image" class="w-16 h-16 object-cover rounded-lg" />
                        <div>
                            <h3 class="font-semibold text-white text-sm">
                                <?php echo $query['title'] ?>
                            </h3>
                            <div class="flex items-center text-xs gap-2 text-gray-500">
                                <span> <?php echo $query['views'] ?> vue</span>
                                <span
                                    class="bg-purple-100 text-purple-600 px-2 py-0.5 rounded"><?php echo $query['categorie'] ?></span>
                                <span
                                    class="bg-blue-100 text-blue-600 px-2 py-0.5 rounded"><?php echo $query['tags'] ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="blogs.js"></script>
</body>

</html>