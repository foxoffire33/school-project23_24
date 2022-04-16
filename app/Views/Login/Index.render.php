<?php
$head = new \Framework\view\components\Headers\Head();
$head->addLeave(new \Framework\view\components\Headers\Title("My Home page"));
?>
<html>
<head>
    <?= $head->render() ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                },
            },
            variants: {
                fill: ['hover', 'focus','delay','transition-colors','transition'],
            },
        }
    </script>
</head>
<body class="bg-local overflow-hidden" style="background-image: url('https://source.unsplash.com/user/erondu'); background-repeat: no-repeat;background-attachment: fixed;background-position: center;background-size: 2000px auto;">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/navigation.render.php' ?>
<?php //include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/header.render.php' ?>
<div class="mx-auto h-screen">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/FlashMessages/FlasMessage.php' ?>
    <div class="items-center bg-local">
        <? //= $rootDiv->render() ?>
        <div class="flex items-center justify-center h-screen overflow-hidden">
            <div class="px-8 py-6 mt-4 text-left bg-white shadow-lg">
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/FlashMessages/FlasMessage.php' ?>
                <h3 class="text-2xl font-bold text-center">Login to your account</h3>
                <form action="/login" method="post">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                    <div class="mt-4">
                        <div>
                            <label class="block" for="email">Email<label>
                                    <input type="text" placeholder="Email" name="email"
                                           class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                        </div>
                        <div class="mt-4">
                            <label class="block">Password<label>
                                    <input type="password" placeholder="Password" name="password"
                                           class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                        </div>
                        <div class="flex items-baseline justify-between">
                            <button class="px-6 py-2 mt-4 text-white bg-gray-600 rounded-lg hover:bg-gray-900 w-full">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
