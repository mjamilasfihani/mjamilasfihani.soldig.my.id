<?= $this->extend('layouts/app'); ?>
<?= $this->section('main'); ?>

<div class="container-fluid mb-5">
    <?= $this->include('partials/alert') ?>
    <h3 class="text-dark mb-2">Home (Halaman Utama)</h3>
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Produk</button>
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
                        <td>
                            <img src="images/<?= $product['product_code']; ?>" class="img-thumbnail" style="width: 100px;">
                        </td>
                        <td><?= strtok($product['product_code'], '.'); ?></td>
                        <td>
                            <form action="cart/create" method="post">
                                <input type="number" name="product_id" value="<?= $product['product_id'] ?>" hidden>
                                <button type="submit" class="btn btn-primary">Beli</button>
                            </form>
                        </td>
                    </tr>
                    <!-- End of Table -->
                  <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td>Belum Ada Pembelian</td>
                    </tr>
                <?php endif; ?>
              </tbody>
            </table>
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <?php for ($i = 1; $i <= $pages; $i++): ?>
                    <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>"><a class="page-link" href="<?= base_url('?page=' . $i) ?>"><?= $i; ?></a></li>
                <?php endfor; ?>
              </ul>
            </nav>
        </div>
    </div>
    <a href="cart" class="btn btn-outline-primary">Lihat Shoping Cart <sup><?= $total; ?></sup></a>
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
