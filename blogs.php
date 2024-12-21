<?php 
require_once 'connection.php';

if (!isset($_GET['BlogId']) || empty($_GET['BlogId']) || !is_numeric($_GET['BlogId'])){
    die('missing id parameter');
}

$ArticleId = $_GET['BlogId'];


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

// commentaire 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_btn'])) {
    $comment = htmlspecialchars(trim($_POST['content']));
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));

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
            $pdo->rollBack();
            echo 'Failed to insert data: ' . $e->getMessage();
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
    <div class="max-w-4xl mx-auto p-6">

        <?php foreach($bloginfo as $blog): ?>
        <article class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4"><?php echo $blog['title'];?></h2>
            <p class="text-gray-600 mb-6">
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
                        <div class="mb-4"> <label for="username"
                                class="block text-gray-700 text-sm font-bold mb-2">Username</label> 
                                <input type="text" id="username"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Enter your username" name="username"> </div>
                        <div class="mb-4"> <label for="email"
                                class="block text-gray-700 text-sm font-bold mb-2">Email</label> <input type="text"
                                id="email"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Enter your email" name="email">
                             </div>
                        <textarea id="comment-input" rows="3" placeholder="Write your comment..." 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none" name="content"></textarea>
                        <button type="submit" id="submit-comment" name="comment_btn" class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Post Comment
                        </button>
                    </div>
                </form>

                <div id="comment-list" class="space-y-4">
                    <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                </div>
            </section>
        </article>
        <?php endforeach ;?>



        <!--  modulle utilisateur -->

        <div class="relative">
            <div id="modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90">
                <div class="bg-white bg-opacity-70 backdrop-blur-md p-8 rounded-lg shadow-lg w-full max-w-md relative">
                    <div class="flex items-center justify-between relative">
                        <h2 class="text-2xl font-semibold text-center text-indigo-600 mb-6">Add this information</h2>
                        <button class="cancel absolute right-0 top-0">
                            <i class="fa-solid fa-xmark" style="color: #DC2626; font-size: 40px;"></i>
                        </button>
                    </div>

                    <form action="" method="POST">
                        <div id="errors"></div>

                        <div class="mb-4">
                            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                            <input type="text" name="username" id="username" placeholder="username"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" placeholder="email"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2">
                        </div>
                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md"
                            name="btn_clique">Click</button>
                    </form>
                </div>
            </div>
        </div>

    </div>


    <script src="blogs.js"></script>
</body>

</html>