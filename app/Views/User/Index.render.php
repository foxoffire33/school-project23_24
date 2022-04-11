<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/Admin/header.render.php' ?>

    <body>
<div class="flex h-screen">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/Admin/navigation.render.php' ?>
    <div class="w-full px-4 py-2 bg-gray-200 lg:w-full">
        <div class="container mx-auto mt-12">
            <div class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-800">
                <div class="container flex flex-wrap justify-between items-center mx-auto">
                    <div class="flex md:order-2">
                        <div class="hidden relative mr-3 md:mr-0 md:block">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" id="email-adress-icon"
                                   class="block p-2 pl-10 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Search...">
                        </div>
                        <button data-collapse-toggle="mobile-menu-3" type="button"
                                class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                aria-controls="mobile-menu-3" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1"
                         id="mobile-menu-3">
                        <p class="size-lg font-extrabold">Manage users</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col mt-8">
                <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                        <?php if (!empty($entities)): ?>
                            <table class="min-w-full">
                                <thead>
                                <tr>
                                    <th
                                            class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Name
                                    </th>
                                    <th
                                            class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Email
                                    </th>
                                    <th
                                            class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Edit
                                    </th>
                                    <th
                                            class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Delete
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white">
                                <?php foreach ($entities as $entity): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="https://source.unsplash.com/user/erondu"
                                                         alt="admin dashboard ui">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium leading-5 text-gray-900">
                                                        <?= $entity->name ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-500">
                                                <?= $entity->email ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                            <a href="/users/<?= $entity->id; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="w-6 h-6 text-blue-400"
                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">

                                                <button onclick="UpdateID(<?= $entity->id; ?>)" type="button" data-modal-toggle="popup-modal" data-action="/users/">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
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
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/Admin/footer.render.php' ?>