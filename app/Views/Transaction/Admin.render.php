<?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/header.render.php' ?>

    <body>
<div class="flex h-screen">
    <div class="w-full px-4 py-2 lg:w-full">
        <div class="bg-white border-gray-200 shadow px-2 sm:px-4 py-2.5 rounded dark:bg-gray-800">
            <div class="container flex flex-wrap justify-between items-center mx-auto">
                <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1"
                     id="mobile-menu-3">
                    <p class="size-lg font-extrabold">Summary of all trancations</p>
                </div>
            </div>
        </div>
        <div class=" mx-auto mt-12">
            <div class="grid grid-cols-5 gap-12">
                <div class="container mx-auto mt-12 pt-12 mr-5">
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/../app/Views/Layouts/AdminSideBar.php' ?>
                </div>
            <div class="flex flex-col mt-8 col-span-4">
                <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">

                        <?php if (!empty($entities)): ?>
                            <table class="min-w-full">
                                <thead>
                                <tr>
                                    <th
                                            class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        User
                                    </th>
                                    <th
                                            class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Sale
                                    </th>
                                    <th
                                            class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Buy
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white">
                                <?php foreach ($entities as $entity): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="w-10 h-10 rounded-full"
                                                         src="https://source.unsplash.com/user/erondu"
                                                         alt="admin dashboard ui">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium leading-5 text-gray-900">
                                                        <?= (\App\Models\Users::findById($entity->user_id))?->name; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-500">
                                                <?= $entity->sale_coin_amount ?>
                                                <?= (\App\Models\Coin::findById($entity->sale_coin))?->name; ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-500">
                                                <?= $entity->buy_coin_amount ?>
                                                <?= (\App\Models\Coin::findById($entity->buy_coin))?->name; ?>
                                            </div>
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
    function UpdateID(itemID) {
        document.getElementById('model-delete-action').setAttribute('action', '/coins/' + itemID);
    }
</script>