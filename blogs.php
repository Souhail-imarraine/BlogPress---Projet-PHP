<?php 
require_once 'connection.php';

if (!isset($_GET['BlogId']) || empty($_GET['BlogId']) || !is_numeric($_GET['BlogId'])){
    die('missing id parameter');
}

$ArticleId = $_GET['BlogId'];

$errors = [] ;
try {
    $query = "SELECT * FROM articles WHERE id = ? LIMIT 1";
    $st = $pdo->prepare($query);
    $st->execute([$ArticleId]);
    $bloginfo = $st->fetchAll(PDO::FETCH_ASSOC);

    if (!$bloginfo) {
        echo 'No article found with the given ID.';
        header("Location: interfaceBlogs.php");
    }

} catch (PDOException $e) {
    echo "Error fetching data from article: " . $e->getMessage();
}

// views
$queryViews = "UPDATE articles SET views = views + 1 WHERE id = ?";
$stmt = $pdo->prepare($queryViews);
$stmt->execute([$ArticleId]);

// likes
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['like'])){
    $queryLikes = "UPDATE articles SET likes = likes + 1 where id = ?";
    $stmt = $pdo->prepare($queryLikes);
    $stmt->execute([$ArticleId]);

    header('Location: '. $_SERVER['PHP_SELF']."?BlogId=".$ArticleId);
};

/*************************************** 
 * ******** commentaire ******************
 * *************************************/ 


// afficher le commentaire.

$afficheQuery = "SELECT * FROM comments Where article_id = ? ";
$stmtComm = $pdo->prepare($afficheQuery);
$stmtComm->execute([$ArticleId]);
$allComment = $stmtComm->fetchAll(PDO:: FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_btn'])) {
    $comment = htmlspecialchars(trim($_POST['content']));
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));

    // validation 

    if (empty($comment) || empty($username) || empty($email)) {
        array_push($errors, "All fields are required");
    } elseif (!ctype_alpha($username)){
        array_push($errors, "Username must contain only alphabetic characters");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
     array_push($errors, "Invalid email format"); 
    }

        if(empty($errors)){

            try {
                $queryUser = "INSERT INTO users (username, email) VALUES (?, ?)";
                $stmt = $pdo->prepare($queryUser);
                $stmt->execute([$username, $email]);
    
                // hna jbna akhir id i seret f table sdyal users
                $userId = $pdo->lastInsertId();
    
               $queryComment = "INSERT INTO comments (article_id, user_id, content) VALUES (?, ?, ?)";
                $stmt = $pdo->prepare($queryComment);
                $stmt->execute([$ArticleId, $userId, $comment]);
    
    
                header('Location: ' . $_SERVER['PHP_SELF']."?BlogId=".$ArticleId);
                exit();
            } catch (Exception $e) {
                echo 'Failed to insert data: ' . $e->getMessage();
            }
        }   
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Interactive Blog Features</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 font-sans">
    
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
    <div class="max-w-4xl mx-auto p-6">

        <?php foreach($bloginfo as $blog): ?>
        <article class="bg-black rounded-lg shadow p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4"><?php echo $blog['title'];?></h2>
            <p class="text-gray-200 mb-6">
                <?php echo $blog['content'] ; ?>
            </p>

            <div class="flex items-center text-sm text-gray-500 mb-6">
                <div id="view-counter" class="flex items-center mr-4">
                    👁️ <span class="ml-1">Views: <span id="views"><?php echo $blog['views'];?></span></span>
                </div>
                <!-- <div id="reading-time" class="flex items-center">
                    ⏱️ <span class="ml-1">Estimated reading time: 3 minutes</span>
                </div> -->
            </div>

            <div class="flex items-center mb-6">
                <form action="" method="post">
                    <button type="submit" id="like-btn" name="like"
                        class="flex items-center gap-2 bg-gray-100 text-gray-600 px-4 py-2 rounded-lg shadow hover:bg-indigo-100 hover:text-indigo-600 transition">
                        ❤️ <span id="like-count"><?php echo $blog['likes'];?></span>
                    </button>
                </form>
            </div>

            <section>
                <h3 class="text-xl font-semibold mb-4">Comments</h3>

                <form action="" method="post">
                    <div class="mb-6">
                        <?php include 'errors.php'; ?>
                        <div class="mb-4"> <label for="username"
                                class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                            <input type="text" id="username"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Enter your username" name="username">
                        </div>
                        <div class="mb-4"> <label for="email"
                                class="block text-gray-700 text-sm font-bold mb-2">Email</label> <input type="text"
                                id="email"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Enter your email" name="email">
                        </div>
                        <label for="email"
                                class="block text-gray-700 text-sm font-bold mb-2">Comment</label>
                        <textarea id="comment-input" rows="3" placeholder="Write your comment..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none"
                            name="content"></textarea>
                        <button type="submit" id="submit-comment" name="comment_btn"
                            class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Post Comment
                        </button>
                    </div>
                </form>

                <div id="comment-list" class="space-y-4">

                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Comments</h2>
                    <div id="comment-list" class="space-y-4">
                        <?php foreach($allComment as $comment): ?>
                        <div class="bg-gray-400 p-4 rounded-lg shadow">
                            <p class="text-black-600"><?php echo $comment['content'];?></p>
                            <p class="text-gray-700 text-sm"><?php echo $comment['created_at'];?></p>
                        </div>
                        <?php endforeach ;?>
                        <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                    </div>
                </div>
            </section>
        </article>
        <?php endforeach ;?>

    </div>


    <script src="blogs.js"></script>
</body>

</html>