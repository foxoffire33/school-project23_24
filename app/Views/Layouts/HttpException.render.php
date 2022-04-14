<html>
<head>
    <title>Oeps...</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="flex items-center justify-center w-screen h-screen bg-local" style="background-image: url('https://source.unsplash.com/user/erondu'); background-repeat: no-repeat;background-attachment: fixed;background-position: center;background-size: 2000px auto;">
    <div class="px-4 lg:py-12 bg-local">
        <div class="lg:gap-4 lg:flex">
            <div
                    class="flex flex-col items-center justify-center md:py-24 lg:py-32"
            >
                <h1 class="font-bold text-blue-600 text-9xl">
                    <?php if ($exception->getCode() > 500): ?>
                    <?= $exception->getMessage() ?>
                    <?php endif; ?></span>
                </h1>
                <p class="mb-2 text-2xl font-bold text-center text-gray-800 md:text-3xl">
                    <span class="text-red-500">Oops!</span>
                </p>
                <p class="mb-8 text-center text-gray-500 md:text-lg">
                    <?php if ($exception->getCode() < 500): ?>
                        <?= $exception->getMessage() ?>
                    <?php else: ?>
                        Something when wrong.
                    <?php endif; ?></p>
                </p>
                <a href="/" class="px-6 py-2 text-sm font-semibold text-blue-800 bg-blue-100">Go home</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>