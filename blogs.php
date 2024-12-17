<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Interactive Blog Features</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 font-sans">
    <div class="max-w-4xl mx-auto p-6">
        <header class="mb-8">
            <h1 class="text-4xl font-bold text-indigo-600">Interactive Blog Post</h1>
        </header>

        <article class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4">The Art of Interactive Blogging</h2>
            <p class="text-gray-600 mb-6">
                Interactive elements like comments, likes, and view counters enhance user engagement, making blogs more
                appealing and informative. Learn to add these features seamlessly.
            </p>

            <div class="flex items-center text-sm text-gray-500 mb-6">
                <div id="view-counter" class="flex items-center mr-4">
                    👁️ <span class="ml-1">Views: <span id="views">0</span></span>
                </div>
                <div id="reading-time" class="flex items-center">
                    ⏱️ <span class="ml-1">Estimated reading time: 3 minutes</span>
                </div>
            </div>

            <div class="flex items-center mb-6">
                <button id="like-btn"
                    class="flex items-center gap-2 bg-gray-100 text-gray-600 px-4 py-2 rounded-lg shadow hover:bg-indigo-100 hover:text-indigo-600 transition">
                    ❤️ <span id="like-count">0</span>
                </button>
            </div>

            <section>
                <h3 class="text-xl font-semibold mb-4">Comments</h3>
                
                <div class="mb-6">
                    <textarea id="comment-input" rows="3" placeholder="Write your comment..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none"></textarea>
                    <button id="submit-comment"
                        class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Post Comment
                    </button>
                </div>

                <div id="comment-list" class="space-y-4">
                    <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                </div>
            </section>
        </article>
    </div>

    <script>
    const viewCounter = document.getElementById("views");
    let views = 0;
    const incrementViews = () => {
        views++;
        viewCounter.textContent = views;
    };
    window.onload = incrementViews;

    // Like button functionality
    const likeBtn = document.getElementById("like-btn");
    const likeCount = document.getElementById("like-count");
    let likes = 0;

    likeBtn.addEventListener("click", () => {
        likes++;
        likeCount.textContent = likes;
    });

    // Comment system
    const commentInput = document.getElementById("comment-input");
    const submitComment = document.getElementById("submit-comment");
    const commentList = document.getElementById("comment-list");

    submitComment.addEventListener("click", () => {
        const commentText = commentInput.value.trim();
        if (commentText) {
            const commentItem = document.createElement("div");
            commentItem.classList.add("p-4", "bg-gray-100", "rounded-lg", "shadow");
            commentItem.textContent = commentText;
            commentList.appendChild(commentItem);
            commentInput.value = "";
        } else {
            alert("Please write a comment before submitting!");
        }
    });
    </script>
</body>

</html>