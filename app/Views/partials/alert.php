<!-- Alert -->
<?php if (session()->has('message')) : ?>
	<div class="alert alert-success" role="alert">
		<?= session('message') ?>
	</div>
<?php endif ?>
<?php if (session()->has('error')) : ?>
	<div class="alert alert-danger" role="alert">
		<?= session('error') ?>
	</div>
<?php endif ?>
<?php if (session()->has('errors')) : ?>
	<ul class="alert alert-danger" role="alert">
		<?php foreach (session('errors') as $error) : ?>
			<li><?= $error ?></li>
		<?php endforeach ?>
	</ul>
<?php endif ?>
