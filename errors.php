<?php if (!empty($errors)) : ?>
<div role="alert" class="mb-4 relative flex flex-col space-y-2 w-full p-3 text-sm text-white bg-red-600 rounded-md alertred">
    <?php foreach ($errors as $error) : ?>
    <p><?php echo $error;?></p>
    <?php endforeach; ?>    
    <button
        class="flex items-center justify-center transition-all w-8 h-8 rounded-md text-white hover:bg-white/10 active:bg-white/10 absolute top-1.5 right-1.5"
        type="button" id="alert">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>
<?php endif; ?>
