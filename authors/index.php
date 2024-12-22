<?php
require '../connection.php';
session_start();

$user_id = $_SESSION['user_id']; 

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'author') {
    header('Location: ../login.php');
}

// create a new blog 
$errors = []; 

try{
    $quers = "SELECT a.id AS article_id,
     a.title, a.content, a.categorie, a.views, a.likes, a.author_id, us.id AS user_id 
     FROM articles a 
     INNER JOIN users us 
     ON us.id = a.author_id 
     WHERE a.author_id = ?;";

    $stmt1 = $pdo->prepare($quers);
    $stmt1->execute([$user_id]);
    
    $articles = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    // echo print_r($articles);

}catch(PDOException $e){
    echo "field select data". $e->getMessage();
};

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["create_blog"])) {
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));
    $tags = htmlspecialchars(trim($_POST['tags']));
    $categorie = htmlspecialchars(trim($_POST['category']));
    $views = 0 ;
    $likes = 0 ;

        $allowed_categories = ["technology", "lifestyle", "education", "health"];

        if(empty($title) || empty($content) || empty($tags)){
            array_push($errors, "all field is ");
        }

        if($categorie) {
            if(!in_array($categorie, $allowed_categories)){
                array_push($errors, 'Invalid category selected.');
            }
        }

    if($content){
        if(strlen($content) < 50){
            array_push($errors, "you should add more then 50 caractere");
        }
    }

    if(empty($errors)){
        try { 
            $query = "INSERT INTO articles(title, content, author_id, views, likes, tags, categorie) VALUES (?,?,?,?,?,?,?)";
            $stmt = $pdo->prepare($query); 
            $stmt->execute([$title, $content, $user_id, $views, $likes, $tags, $categorie]);
            header("Location: " . $_SERVER['PHP_SELF']); 
            exit();
        } catch (PDOException $e) 
        { 
            echo "Error: " . $e->getMessage(); 
        }
       
    }
}


/* ***********************************************************************
****************************** DELETE ************************************
**************************************************************************/

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])){
    $stmtDelete = $pdo->prepare("DELETE FROM articles WHERE id = ? ");
    $ArticleId = $_POST['ArticleId'];
    $stmtDelete->execute([$ArticleId]);

    header("Location: " . $_SERVER['PHP_SELF']); 
    exit();
}

/* ***********************************************************************
****************************** STATISTIQUE *******************************
**************************************************************************/

try{

    $query = "SELECT us.id AS user_id, us.username, SUM(a.views) AS total_views, SUM(a.likes) AS total_likes, COUNT(c.id) AS total_comments 
    FROM users us 
    INNER JOIN articles a 
    ON us.id = a.author_id 
    LEFT JOIN comments c 
    ON a.id = c.article_id 
    GROUP BY us.id, us.username";

    $st = $pdo->prepare($query);
    $st->execute(); 
    $statusinfo = $st->fetchAll(PDO::FETCH_ASSOC);
    
    // dkhlna l'index dyal lassociative array bach n9dro nwslo les information bla mn foreachiw ;
    if(!empty($statusinfo)){
        $result = $statusinfo[0];
    }else {
        echo "no found status";
    }


}catch(PDOException $e){
    echo "field select data". $e->getMessage();
};




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Author Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <div
            class="w-full lg:w-64 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 rounded-xl shadow-md p-6 mb-6 lg:mb-0 lg:h-screen">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center">Dashboard</h2>
            <ul class="space-y-4">
                <li>
                    <button
                        class="w-full flex items-center justify-center gap-2 text-lg font-semibold bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-4 py-3 rounded-lg shadow-md hover:from-indigo-600 hover:to-indigo-700 dark:from-indigo-700 dark:to-indigo-800 dark:hover:from-indigo-800 dark:hover:to-indigo-900 transition duration-300 btnAddArticle">
                        <i class="fa-solid fa-plus"></i>
                        Add Articles
                    </button>
                </li>
                <li>
                    <button
                        class="w-full flex items-center justify-center gap-2 text-lg font-semibold bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-3 rounded-lg shadow-md hover:from-blue-600 hover:to-blue-700 dark:from-blue-700 dark:to-blue-800 dark:hover:from-blue-800 dark:hover:to-blue-900 transition duration-300">
                        <i class="fa-solid fa-chart-bar"></i>
                        View Stats
                    </button>
                </li>
                <li>
                    <button
                        class="w-full flex items-center justify-center gap-2 text-lg font-semibold bg-gradient-to-r from-green-500 to-green-600 text-white px-4 py-3 rounded-lg shadow-md hover:from-green-600 hover:to-green-700 dark:from-green-700 dark:to-green-800 dark:hover:from-green-800 dark:hover:to-green-900 transition duration-300">
                        <i class="fa-solid fa-comments"></i>
                        Manage Comments
                    </button>
                </li>
            </ul>
        </div>

        <div class="flex-1 ml-6">
            <header class="flex flex-wrap justify-between items-center mb-12 gap-4">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-indigo-600 dark:text-indigo-400">Author Dashboard
                </h1>

                <?php include 'success_message.php' ?>

                <button
                    class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-600">
                    <a href="../logout.php">Deconnexion</a>
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </header>

            <section class="mb-12">
                <h2 class="text-xl sm:text-2xl font-semibold text-indigo-600 dark:text-indigo-400 mb-6">Statistics and
                    Performance</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Article Stats -->
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                        <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Article Views</h3>
                        <p class="text-lg font-bold text-indigo-600 dark:text-indigo-400">
                            <?php echo $result['total_views'] ?>
                        </p>
                    </div>
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                        <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Article Likes</h3>
                        <p class="text-lg font-bold text-indigo-600 dark:text-indigo-400">
                            <?php echo $result['total_likes'] ?>
                        </p>
                    </div>
                    <!-- Comments Stats -->
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                        <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Comments Count</h3>
                        <p class="text-lg font-bold text-indigo-600 dark:text-indigo-400">
                            <?php echo $result['total_comments'] ?>
                        </p>
                    </div>
                </div>

                <!-- Graph Placeholder -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Article Performance Graph
                    </h3>
                    <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-sm">
                        <p class="text-center text-gray-500 dark:text-gray-400"></p>
                        <body>
                            <div style="width: 50%; margin: auto;">
                                <canvas id="myChart"></canvas>
                            </div>
                        </body>

                    </div>
                </div>
            </section>

            <!-- Blog Management -->
            <section class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="flex items-center justify-center">
                    <div class="max-w-4xl mx-auto p-8 rounded-lg shadow-2xl w-full overflow-x-auto">
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
                                <?php foreach($articles as $article) : ?>
                                <tr class="bg-gray-50 hover:bg-gray-100">
                                    <td
                                        class="border border-gray-300 px-4 py-3 bg-indigo-50 text-indigo-700 dark:bg-gray-700 dark:text-indigo-300">
                                        <?php echo $article['article_id'] ;?>
                                    </td>
                                    <td
                                        class="border border-gray-300 px-4 py-3 bg-indigo-50 text-indigo-700 dark:bg-gray-700 dark:text-indigo-300">
                                        <?php echo $article['title'] ;?>
                                    </td>
                                    <td
                                        class="border border-gray-300 px-4 py-3 bg-indigo-50 text-indigo-700 dark:bg-gray-700 dark:text-indigo-300">
                                        <?php echo $article['views'] ;?>
                                    </td>
                                    <td
                                        class="border border-gray-300 px-4 py-3 bg-indigo-50 text-indigo-700 dark:bg-gray-700 dark:text-indigo-300">
                                        <?php echo $article['likes'] ;?>
                                    </td>
                                    <td
                                        class="border border-gray-300 px-4 py-3 bg-indigo-50 text-indigo-700 dark:bg-gray-700 dark:text-indigo-300">
                                        <?php echo $article['categorie'] ;?>
                                    </td>
                                    <td
                                        class="border border-gray-300 px-4 py-3 bg-indigo-50 text-indigo-700 dark:bg-gray-700 dark:text-indigo-300">
                                        <div class="flex flex-wrap gap-2">
                                            <button
                                                class="bg-yellow-400 text-gray-800 px-4 py-2 rounded-lg hover:bg-yellow-500">
                                                <a
                                                    href="edit.php?ArticleId=<?php echo $article['article_id'];?>">Edit</a>
                                            </button>
                                            <form onsubmit="return confirm('Are you sure?')" action="" method="post">
                                                <input type="hidden" value="<?php echo $article['article_id']?>"
                                                    name="ArticleId">
                                                <button
                                                    class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600"
                                                    name="delete" type="submit">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach ; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

    </div>


    <div class="hidden absolute inset-0 flex items-center justify-center p-4 backdrop-blur containerCreateBlog">
        <div
            class="w-full max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg dark:bg-gray-700 text-gray-900 dark:text-gray-200 font-sans">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-white mb-6">Create a New Blog</h1>
                <button class="cancel"><i class="fa-solid fa-xmark"
                        style="color: #DC2626; font-size: 40px;"></i></button>
            </div>
            <form action="" method="post">
                <!-- Title -->
                <?php include 'error.php' ?>

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
                        placeholder="e.g., technology, coding, design" required>
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
                        class="w-full bg-indigo-500 text-white text-white p-2 rounded-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-300">
                        New Blog
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'My First Dataset',
                data: [65, 59, 80, 81, 56, 55, 40],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>

</html>