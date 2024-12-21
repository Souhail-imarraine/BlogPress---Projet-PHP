<script src="main.js"></script>
<?php if (!empty($errors)) : ?>
    <?php foreach($errors as $error) : ?>
        <p class="text-red-600 bg-red-100 border border-red-400 p-2 rounded-md mb-2"><?php echo $error; ?></p>
    <?php endforeach; ?>
    <script>document.querySelector(".containerCreateBlog").classList.remove("hidden");</script>
<?php endif; ?>
