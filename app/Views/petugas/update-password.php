<?=$this->extend('layouts/app')?>
<?=$this->section('js')?>
<script>
	const passwordToggle = document.querySelector('.js-password-toggle')

	passwordToggle.addEventListener('change', function() {
	const password = document.querySelector('.js-password'),
		passwordLabel = document.querySelector('.js-password-label')

	if (password.type === 'password') {
		password.type = 'text'
		passwordLabel.innerHTML = 'hide'
	} else {
		password.type = 'password'
		passwordLabel.innerHTML = 'show'
	}

	password.focus()
	})
</script>
<?=$this->endSection()?>
<?=$this->section('content')?>
<div class="p-4 sm:ml-64 h-screen">
    <div class="p-4 mt-14">
        <div class="head lg:flex grid grid-cols-1 justify-between w-full">
            <div class="heading flex-auto">
                <p class="text-blue-950 font-sm text-xs">
                    Profile
                </p>
                <h2 class="font-bold tracking-tighter text-2xl text-theme-text">
                    <?=esc($title)?>
                </h2>
            </div>
        </div>

        <div class="card bg-white p-5 mt-4 border rounded-md w-full relative">
        <form action="<?= base_url('dashboard/petugas/update-password/store/') ?>" method="POST" class="w-full mx-auto space-y-4" enctype="multipart/form-data">
				<div class="grid grid-cols-4 gap-3">
					<div class="col-span-4">
						<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Nama<span class="me-2 text-red-500">*</span></label>
						<input type="text" placeholder="Masukkan Nama" name="nama" id="nama" value="<?= set_value("nama", $data->nama) ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
						<div class="text-red-500 text-xs italic font-semibold">
							<?php if (session("errors.nama")) : ?>
								<div class="text-red-500 text-sm">
									<?= session("errors.nama") ?>
								</div>
							<?php endif ?>
						</div>
					</div>
                    <div class="col-span-2">
						<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Username<span class="me-2 text-red-500">*</span></label>
						<input type="text" placeholder="Masukkan Username" name="username" value="<?= set_value("username", $data->username) ?>" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
						<div class="text-red-500 text-xs italic font-semibold">
							<?php if (session("errors.username")) : ?>
								<div class="text-red-500 text-sm">
									<?= session("errors.username") ?>
								</div>
							<?php endif ?>
						</div>
					</div>
                    <div class="col-span-2">
						<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Email<span class="me-2 text-red-500">*</span></label>
						<input type="email" placeholder="Masukkan Email" value="<?= set_value("email",$data->email) ?>" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
						<div class="text-red-500 text-xs italic font-semibold">
							<?php if (session("errors.email")) : ?>
								<div class="text-red-500 text-xs">
									<?= session("errors.email") ?>
								</div>
							<?php endif ?>
						</div>
					</div>
                    <div class="col-span-4">
						<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Password<span class="me-2 text-red-500">*</span></label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 right-0 flex items-center px-2">
                                <input class="hidden js-password-toggle" id="toggle" type="checkbox" />
                                <label class="bg-gray-300 hover:bg-gray-400 rounded px-2 py-1 text-sm text-gray-600 font-mono cursor-pointer js-password-label" for="toggle">show</label>
                            </div>
                            <input type="password" placeholder="Masukkan Password"  value="<?= set_value("password") ?>" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 js-password">
                        </div>
                        <div class="text-sm font-bold text-gray-900">
                            <span>Kosongkan jika tidak ingin mengganti password</span>
                        </div>
						<div class="text-red-500 text-xs italic font-semibold">
							<?php if (session("errors.password")) : ?>
								<div class="text-red-500 text-sm">
									<?= session("errors.password") ?>
								</div>
							<?php endif ?>
						</div>
					</div>
					
				</div>
				<div class="flex justify-end align-middle content-center bg-gray-100 p-3 rounded-md">
					<div>
						<button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">Simpan</button>
					</div>
					<div>
						<button class="bg-white text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" type="reset">Batal</button>
					</div>

				</div>
			</form>
        </div>
    </div>
</div>
<?=$this->endSection()?>