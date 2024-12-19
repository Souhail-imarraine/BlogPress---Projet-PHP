<?php if (isset($_SESSION['success_message'])): ?> 
    <div
         class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
         <strong class="font-bold">Success!</strong> 
         <span class="block sm:inline"><?php echo $_SESSION['success_message']; ?>
    </span> 
</div> 
<?php unset($_SESSION['success_message']); ?> 
<?php endif; ?>