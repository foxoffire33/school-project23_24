<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/header.render.php' ?>
<div class="flex h-screen">
    <div class="w-full px-4 py-2 lg:w-full">
        <div class="container mx-auto mt-12">
            <div class="bg-white border-gray-200 shadow px-2 sm:px-4 py-2.5 rounded dark:bg-gray-800">
                <div class="container flex flex-wrap justify-between items-center mx-auto">
                    <div class="flex md:order-2">
                        <div class="hidden relative mr-3 md:mr-0 md:block">
                            <a href="/users">
                                <div class="flex items-center pl-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-cyan-300 hover:fill-cyan-400 dela" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <div class="hidden relative mr-3 md:mr-0 md:block">
                            <a href="/users/create">
                                <div class="flex items-center pl-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition fill-green-300 hover:fill-green-400 duration-300" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <?php if (isset($entity->id)): ?>
                            <div class="hidden relative mr-3 md:mr-0 md:block">
                                <a href="/users/<?= $entity->id ?>">
                                    <div class="flex items-center pl-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-yellow-300 hover:-yellow-400" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                            <div class="hidden relative mr-3 md:mr-0 md:block">
                                <a onclick="UpdateID(<?= $entity->id; ?>)" data-modal-toggle="popup-modal" data-action="/users/">
                                    <div class="flex items-center pl-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6  fill-red-300 hover:-red-400" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1"
                         id="mobile-menu-3">
                        <p class="size-lg font-extrabold"><?= (isset($entity->id) ? "Update" : "Create") ?> User</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col mt-8">
                <div class="py-5 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg py-6 px-4">
                        <?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/User/_form.php' ?>
                    </div>
                </div>
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/Admin/deleteModal.render.php' ?>
    </div>
</div>
<script>
    function UpdateID(itemID){
        document.getElementById('model-delete-action').setAttribute('action','/users/' + itemID);
    }
</script>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/footer.render.php' ?>
