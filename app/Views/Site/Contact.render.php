<?php
$rootDiv = new \Framework\view\components\Body\Div('flex flex-wrap -mx-3 mb-6');

$form = new \Framework\view\components\Form\Form('/contact', 'POST');

$div = new \Framework\view\components\Body\Div('w-full md:w-1/2 px-3 mb-6 md:mb-0');
$div->addLeave(new \Framework\view\components\Form\InputLabel('name', 'Your name'));
$div->addLeave(new \Framework\view\components\Form\InputField('name', 'name', 'text', ''));
$form->addLeave($div);


$div = new \Framework\view\components\Body\Div('w-full md:w-1/2 px-3 mb-6 md:mb-0');
$div->addLeave(new \Framework\view\components\Form\InputLabel('email', 'Your email'));
$div->addLeave(new \Framework\view\components\Form\InputField('email', 'email', 'email', ''));
$form->addLeave($div);

$div = new \Framework\view\components\Body\Div('w-full md:w-1/2 px-3 mb-6 md:mb-0');
$div->addLeave(new \Framework\view\components\Form\InputLabel('subject', 'Subject'));
$div->addLeave(new \Framework\view\components\Form\InputField('subject', 'subject', 'text', ''));
$form->addLeave($div);

$div = new \Framework\view\components\Body\Div('w-full md:w-1/2 px-3 mb-6 md:mb-0');
$button = new \Framework\view\components\Form\Button();
$div->addLeave($button);
$form->addLeave($div);

$rootDiv->addLeave($form);
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/header.render.php' ?>
    <?= $rootDiv->render() ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/footer.render.php' ?>
