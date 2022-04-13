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
                    </div>
                    <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1"
                         id="mobile-menu-3">
                        <p class="size-lg font-extrabold">View user</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <div class="py-5 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                        <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 p-4">
                            <div class="flex flex-col items-center pb-10 pt-6">
                                <img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="https://source.unsplash.com/user/erondu" alt="Bonnie image"/>
                                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white"><?= $entity->name ?></h5>
                                <span class="text-sm text-gray-500 dark:text-gray-400"><?= $entity->email ?></span>
                                <div class="flex mt-4 space-x-3 lg:mt-6">
<!--                                    <a href="#" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add friend</a>-->
<!--                                    <a href="#" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-gray-900 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">Message</a>-->
                                    <div class="flex md:order-2">
                                        <?php if (isset($entity->id)): ?>
                                            <div class="hidden relative mr-3 md:mr-0 md:block">
                                                <a href="/users/<?= $entity->id ?>/edit">
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
                                </div>
                            </div>
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
