<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/header.render.php' ?>

    <body>
<div class="flex h-screen">
    <div class="w-full px-4 py-2 lg:w-full">
        <div class="bg-white border-gray-200 shadow px-2 sm:px-4 py-2.5 rounded dark:bg-gray-800">
            <div class="container flex flex-wrap justify-between items-center mx-auto">
                <div class="flex md:order-2">
                    <div class="hidden relative mr-3 md:mr-0 md:block">
                        <a href="/coins/create">
                            <div class="flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition fill-green-300 hover:fill-green-400 duration-300" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </a>
                    </div>
                    <?php if (isset($entity->id)): ?>
                        <div class="hidden relative mr-3 md:mr-0 md:block">
                            <a href="/coins/<?= $entity->id ?>">
                                <div class="flex items-center pl-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="z-40 h-6 w-6 fill-green-400 hover:fill-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <div class="hidden relative mr-3 md:mr-0 md:block">
                            <a href="/coins/<?= $entity->id ?>">
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
                    <p class="size-lg font-extrabold">Summary of all coins</p>
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
                        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">

                            <?php if (!empty($entities)): ?>
                                <table class="min-w-full">
                                    <thead>
                                    <tr>
                                        <th
                                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Short name
                                        </th>
                                        <th
                                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Value
                                        </th>
                                        <th
                                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Full name
                                        </th>
                                        <?php if (isset($_SESSION['userID'])): ?>
                                            <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                View
                                            </th>
                                            <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Edit
                                            </th>
                                            <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Delete
                                            </th>
                                        <?php endif; ?>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                    <?php foreach ($entities as $entity): ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 w-1/12">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium leading-5 text-gray-900 w-1/12">
                                                            <?= $entity->short_name ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <div class="text-sm leading-5 text-gray-500">
                                                    <?= $entity->value ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 w-9/12">
                                                <div class="text-sm leading-5 text-gray-500">
                                                    <?= $entity->name ?>
                                                </div>
                                            </td>
                                            <?php if (isset($_SESSION['userID'])): ?>
                                                <td class="z-1 px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 w-1/12">
                                                    <div class="hidden relative mr-3 md:mr-0 md:block">
                                                        <a href="/users/<?= $entity->id ?>">
                                                            <div class="flex items-center pl-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     class="z-40 h-6 w-6 fill-green-300 hover:full-geen-400"
                                                                     fill="none" viewBox="0 0 24 24"
                                                                     stroke="currentColor"
                                                                     stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                                </svg>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="z-1 px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 w-1/12">
                                                    <a href="/users/<?= $entity->id ?>/edit">
                                                        <div class="flex items-center pl-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 class="z-40 h-6 w-6 fill-yellow-300 hover:-yellow-400"
                                                                 viewBox="0 0 24 24" stroke="currentColor"
                                                                 stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="z-1 px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 w-1/12">
                                                    <div class="hidden relative mr-3 md:mr-0 md:block">
                                                        <a onclick="UpdateID(<?= $entity->id; ?>)"
                                                           data-modal-toggle="popup-modal" data-action="/users/">
                                                            <div class="flex items-center pl-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     class="h-6 w-6  fill-red-300 hover:-red-400"
                                                                     viewBox="0 0 24 24" stroke="currentColor"
                                                                     stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                                </svg>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    </form>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/Admin/deleteModal.render.php' ?>
    </div>
</div>
<script>
    function UpdateID(itemID) {
        document.getElementById('model-delete-action').setAttribute('action', '/coins/' + itemID);
    }
</script>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/footer.render.php' ?>