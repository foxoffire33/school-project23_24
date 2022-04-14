<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/header.render.php' ?>

    <body>
<div class="flex h-screen">
    <div class="w-full px-4 py-2 lg:w-full">
        <div class="bg-white border-gray-200 shadow px-2 sm:px-4 py-2.5 rounded dark:bg-gray-800">
            <div class="container flex flex-wrap justify-between items-center mx-auto">
                <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1"
                     id="mobile-menu-3">
                    <p class="size-lg font-extrabold">Dashboard</p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-5 gap-12">
            <div class="container mx-auto mt-12 pt-12 mr-5">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/AdminSideBar.php' ?>
            </div>
            <div class="container mx-auto mt-12 col-span-4">
                <div class="flex flex-col mt-8">
                    <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/Admin/deleteModal.render.php' ?>
<script>
    function UpdateID(itemID) {
        document.getElementById('model-delete-action').setAttribute('action', '/users/' + itemID);
    }
</script>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/footer.render.php' ?>