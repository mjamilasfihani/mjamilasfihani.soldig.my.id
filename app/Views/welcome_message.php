<?= $this->extend('layouts/app'); ?>
<?= $this->section('main'); ?>

<div class="container-fluid mb-5">
    <?= $this->include('partials/alert') ?>
    <h3 class="text-dark mb-3">Home (Halaman Utama)</h3>
    <div class="card mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
        </div>
        <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Nama Barang</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Stok</th>
                  <th scope="col">Gambar</th>
                  <th scope="col">Kode</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (count($products) > 0): ?>
                  <?php $num = 1; foreach($products as $product): ?>
                    <!-- Table -->
                    <tr>
                        <th scope="row"><?= $num ++ ?></th>
                        <td><?= ucwords($product['product_name']); ?></td>
                        <td>RP. <?= $product['product_price']; ?></td>
                        <td><?= $product['product_stock']; ?></td>
                        <td><img src="<?= (WRITEPATH . 'uploads/' . $product['product_code']); ?>"></td>
                        <td><?= strtok($product['product_code'], '.'); ?></td>
                        <td>
                            <form action="cart" method="post">
                                <input type="number" name="product_id" value="<?= $product['product_id'] ?>" hidden>
                                <button type="submit" class="btn btn-primary">Beli</button>
                            </form>
                        </td>
                    </tr>
                    <!-- End of Table -->
                  <?php endforeach; ?>
                <?php else: ?>
                    Belum Ada Produk
                <?php endif; ?>
              </tbody>
            </table>
        </div>
    </div>
    <a href="cart" class="btn btn-outline-primary">Lihat Shoping Cart</a>
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
