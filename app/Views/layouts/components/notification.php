<?php if (session()->has('message')) : ?>
	<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50  ">
		<?= session('message') ?>
	</div>
<?php endif ?>

<?php if (session()->has('error')) : ?>
	<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50  ">
		<?= session('error') ?>
	</div>
<?php endif ?>

<?php if (session()->has('errors')) : ?>
	<ul class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50  ">
	<?php foreach (session('errors') as $error) : ?>
		<li><?= $error ?></li>
	<?php endforeach ?>
	</ul>
<?php endif ?>
