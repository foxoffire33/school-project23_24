<?php
    $rootDiv = new \Framework\view\components\Body\Div('flex flex-wrap -mx-3 mb-6');

    $form = new \Framework\view\components\Form\Form('/login', 'POST');

    $div = new \Framework\view\components\Body\Div();
    $div->addLeave(new \Framework\view\components\Form\InputLabel('email', 'Your email'));
    $div->addLeave(new \Framework\view\components\Form\InputField('email', 'email', 'email', ''));
    $form->addLeave($div);

    $div = new \Framework\view\components\Body\Div();
    $div->addLeave(new \Framework\view\components\Form\InputLabel('password', 'password'));
    $div->addLeave(new \Framework\view\components\Form\InputField('password', 'password', 'password', ''));
    $form->addLeave($div);

    $div = new \Framework\view\components\Body\Div('w-full');
    $button = new \Framework\view\components\Form\Button('bg-black hover:bg-white text-white hover:text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-3 w-full');
    $div->addLeave($button);
    $form->addLeave($div);

    $rootDiv->addLeave($form);
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/header.render.php' ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/FlashMessages/FlasMessage.php' ?>
<div class="container items-center bg-local" style="background-image: url('https://source.unsplash.com/user/erondu'); background-repeat: no-repeat;background-attachment: fixed;background-position: center;background-size: 2000px auto;">
<?//= $rootDiv->render() ?>
    <div class="flex items-center justify-center min-h-screen">
        <div class="px-8 py-6 mt-4 text-left bg-white shadow-lg">
            <h3 class="text-2xl font-bold text-center">Login to your account</h3>
            <form action="/login" method="post">
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
                        <button class="px-6 py-2 mt-4 text-white bg-gray-600 rounded-lg hover:bg-gray-900 w-full">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/footer.render.php' ?>
