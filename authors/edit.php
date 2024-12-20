<?php
require '../connection.php';
session_start();

// 39el 3liha
if (!isset($_GET['ArticleId']) || empty($_GET['ArticleId'])) {
    die('missing id parameter');
}

$ArticleId = $_GET['ArticleId'];

$query = "SELECT * FROM articles WHERE id = ? LIMIT 1";
$stmt = $pdo->prepare($query);
$stmt->execute([$ArticleId]);

// ARTICLE JBNA FIHA DATA DYAL DAK L'ARTICLE OK
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) { 
    die('Article not found'); 
}

// DB GHADII NDECLARIW VALIABLE FIH KOLA HAJA BOHDHA OK
$title = $article['title'];
$content = $article['content'];
$tags = $article['tags'];
$category = $article['categorie'];

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["create_blog"])) {
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));
    $tags = htmlspecialchars(trim($_POST['tags']));
    $categorie = htmlspecialchars(trim($_POST['category']));
    $author_id = $_SESSION['user_id']; 
    $views = 0;
    $likes = 0;

    $allowed_categories = ["technology", "lifestyle", "education", "health"];

    if(empty($title) || empty($content) || empty($tags)){
        array_push($errors, "All fields are required.");
    }

    if($categorie) {
        if(!in_array($categorie, $allowed_categories)){
            array_push($errors, 'Invalid category selected.');
        }
    }

    if($content){
        if(strlen($content) < 50){
            array_push($errors, "You should add more than 50 characters.");
        }
    }

    if(empty($errors)){
        try {
            $stmt = $pdo->prepare("UPDATE articles SET title = ?, content = ?, tags = ?, categorie = ? WHERE id = ?");
            $stmt->execute([$title, $content, $tags, $categorie, $ArticleId]);

            $_SESSION['success_message'] = 'Your blog post has been successfully updated.';

            header('Location: index.php');

            exit();
        } catch (PDOException $e) { 
            echo "Error: " . $e->getMessage(); 
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
    <title>Edit Blog</title>
</head>

<body>
    <div class="inset-0 flex items-center justify-center p-4 containerCreateBlog">
        <div class="w-full max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Blog</h1>
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
                        placeholder="Enter blog title" value="<?php echo htmlspecialchars($title); ?>" required>
                </div>
                <!-- Content -->
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea id="content" name="content" rows="6"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm text-gray-900"
                        placeholder="Write your blog content here"
                        required><?php echo htmlspecialchars($content); ?></textarea>
                </div>
                <!-- Tags -->
                <div class="mb-4">
                    <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                    <input type="text" id="tags" name="tags"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900"
                        placeholder="e.g., technology, coding, design" value="<?php echo htmlspecialchars($tags); ?>"
                        required>
                </div>
                <!-- Category -->
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select id="category" name="category"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900"
                        required>
                        <option value="">Select a category</option>
                        <option value="technology" <?php echo ($category == 'technology') ? 'selected' : ''; ?>>
                            Technology
                        </option>
                        <option value="lifestyle" <?php echo ($category == 'lifestyle') ? 'selected' : ''; ?>>Lifestyle
                        </option>
                        <option value="education" <?php echo ($category == 'education') ? 'selected' : ''; ?>>Education
                        </option>
                        <option value="health" <?php echo ($category == 'health') ? 'selected' : ''; ?>>Health</option>
                    </select>
                </div>

                <div>
                    <button type="submit" name="create_blog"
                        class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-300">
                        Update Blog
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>