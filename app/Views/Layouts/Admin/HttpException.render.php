<html>
<head>
    <title>Oeps...</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class=" flex items-center justify-center w-screen h-screen bg-gradient-to-r from-indigo-600 to-blue-400">
    <div class="px-40 py-20 bg-white rounded-md shadow-xl">
        <div class="flex flex-col items-center">
            <h1 class="font-bold text-blue-600 text-9xl"><?= $exception->getCode() ?></h1>
            <h6 class="mb-2 text-2xl font-bold text-center text-gray-800 md:text-3xl">
                <span class="text-red-500">Oops!</span>
                <?php if ($exception->getCode() < 500): ?>
                    <?= $exception->getMessage() ?>
                <?php else: ?>
                    Something when wrong.
                <?php endif; ?>
            </h6>
            <p class="mb-8 text-center text-gray-500 md:text-lg">
                <?php if ($exception->getCode() > 500): ?>
                    <?= $exception->getMessage() ?>
                <?php endif; ?>
            </p>
            <a href="/" class="px-6 py-2 text-sm font-semibold text-blue-800 bg-blue-100">Go home</a>
        </div>
    </div>
</div>
</body>
</html>