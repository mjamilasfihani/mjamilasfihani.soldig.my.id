<?= $this->extend('layouts/skeleton'); ?>
<?= $this->section('app'); ?>

    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
			<div id="content" class="mt-5">
			    <?= $this->renderSection('main') ?>
			</div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2022</span></div>
                </div>
            </footer>
        </div>
    </div>

<?= $this->endSection(); ?>