<?php if (!empty($errors)) : ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <?php foreach ($errors as $error) : ?>
            <p><?php echo htmlspecialchars($erros); ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>