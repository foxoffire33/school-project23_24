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
<body>
<div class="container mx-auto h-screen">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/navigation.render.php' ?>
