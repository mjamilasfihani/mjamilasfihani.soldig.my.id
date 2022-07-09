<?= $this->extend('layouts/skeleton'); ?>
<?= $this->section('app'); ?>

<div class="container-fluid">
    <?= $this->include('partials/alert') ?>
    <h3 class="text-dark mb-3">Home</h3>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Produk</button>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Produk</h6>
        </div>
        <div class="card-body">
            <?php if (count($products) > 0): ?>
                <!-- Table -->

                <!-- End of Table -->
            <?php else: ?>
                Belum Ada Produk
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('modal'); ?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <form action="products" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Foto Produk</label>
            <input type="file" name="product_image" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="product_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga Produk</label>
            <div class="input-group">
                <div class="input-group-text">Rp.</div>
                <input type="number" name="product_price" class="form-control" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah Produk</label>
            <input type="number" name="product_stock" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
     </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
