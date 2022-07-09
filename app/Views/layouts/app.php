<?= $this->extend('layouts/skeleton'); ?>
<?= $this->section('app'); ?>

    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
			<div id="content">
			    <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
			        <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
			            <ul class="navbar-nav flex-nowrap ms-auto">
			            	<li class="nav-item dropdown no-arrow mx-1">
			            		<button type="button" class="dropdown-toggle btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Produk</button>
			            	</li>
			            </ul>
			        </div>
			    </nav>
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