<?php
    $rootDiv = new \Framework\view\components\Body\Div('flex flex-wrap -mx-3 mb-6');

    $form = new \Framework\view\components\Form\Form('/register', 'POST');

    $div = new \Framework\view\components\Body\Div();
    $div->addLeave(new \Framework\view\components\Form\InputLabel('email', 'Your email'));
    $div->addLeave(new \Framework\view\components\Form\InputField('email', 'email', 'email', ''));
    $form->addLeave($div);

    $div = new \Framework\view\components\Body\Div();
    $div->addLeave(new \Framework\view\components\Form\InputLabel('name', 'Your name'));
    $div->addLeave(new \Framework\view\components\Form\InputField('name', 'name', 'text', ''));
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
<?= $rootDiv->render() ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/footer.render.php' ?>
