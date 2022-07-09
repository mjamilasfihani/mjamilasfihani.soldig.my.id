<?= $this->extend('layouts/app'); ?>
<?= $this->section('main'); ?>

<div class="container-fluid mb-5">
    <?= $this->include('partials/alert') ?>
    <h3 class="text-dark mb-3">Cart (Halaman Keranjang)</h3>
    <div class="card mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pembelian</h6>
        </div>
        <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Nama Barang</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Subtotal</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (count($datas) > 0): ?>
                  <?php $num = 1; foreach($datas as $data): ?>
                    <!-- Table -->
                    <tr>
                        <td><?= ucwords($data['product_name']); ?></td>
                        <td>RP. <?= $data['product_price']; ?></td>
                        <td><?= $data['cart_qty']; ?></td>
                        <td>RP. <?= $data['cart_qty'] * $data['product_price']; ?></td>
                        <td>
                            <form action="cart/create" method="post">
                                <input type="number" name="product_id" value="<?= $data['product_id'] ?>" hidden>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                            <form action="cart/remove" method="post" class="my-1">
                                <input type="number" name="product_id" value="<?= $data['product_id'] ?>" hidden>
                                <button type="submit" class="btn btn-outline-primary">Minus</button>
                            </form>
                            <form action="cart/cancel" method="post">
                                <input type="number" name="product_id" value="<?= $data['product_id'] ?>" hidden>
                                <button type="submit" class="btn btn-warning">Discard</button>
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
        </div>
    </div>
    <a href="<?= base_url() ?>" class="btn btn-outline-primary">Kembali ke Awal</a>
    <?php if (count($datas) > 0): ?>
        <a href="<?= base_url('pay') ?>" class="btn btn-danger">Checkout dengan Total RP. <?= $totalPrice; ?></a>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>