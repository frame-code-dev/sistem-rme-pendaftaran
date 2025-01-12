<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.tailwindcss.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- select 2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <section class="bg-gray-50 00">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex flex-col items-center mb-6 text-2xl font-semibold text-gray-900 ">
                <img class="w-30 h-40 mr-2" src="<?=base_url('img/logo.jpg')?>" alt="logo">
                <span class="self-center text-xl font-semibold whitespace-nowrap ">Puskesmas Besuki</span>    
            </a>
            <div class="w-full bg-white rounded-lg shadow mt-0 sm:max-w-md xl:p-0 00 00">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                        Sign in to your account
                    </h1>
                    <?= view('layouts/components/notification') ?>
                    <form class="space-y-4 md:space-y-6" action="<?= url_to('login') ?>" method="post">
                        <?= csrf_field() ?>
                        <div>
                            <label for="email" class="block mb-2 text-sm text-gray-900 nt-bold">Username/Email</label>
                            <input type="text" name="login" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 00 00 00 ue-500 ue-500" placeholder="Masukkan Username/Email">
                            <div class="invalid-feedback text-red-500 text-xs">
								<?= session('errors.login') ?>
							</div>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm text-gray-900 nt-bold">Password</label>
                            <input type="password" name="password" id="password" placeholder="Masukkan data" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 00 00 00 ue-500 ue-500">
                        	<div class="invalid-feedback text-red-500 text-xs">
								<?= session('errors.password') ?>
							</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <?php if ($config->allowRemembering): ?>
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 00 00 ue-600 ay-800" required="">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 00">Remember me</label>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center 00 ue-700 ue-800">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</html>