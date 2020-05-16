<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;"><i class="fa fa-location-arrow"></i> Daftar Pelanggan (Pengguna Jasa: <b><?php echo $jasa->nama; ?></b>)</h3>

  <div class="box box-body">
      <table id="tabel-detail" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Nama</th>
            <th>No Telp</th>
            <th>Pelaksana</th>
          </tr>
        </thead>
        <tbody id="data-pelanggan">
          <?php foreach($dataPelanggan as $pelanggan) : ?>
            <tr>
              <td style="min-width:230px;"><?= $pelanggan->pelanggan; ?></td>
              <td><?= $pelanggan->nomorkontak; ?></td>
              <td><?= $pelanggan->pelaksana; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
  </div>

  <div class="text-right">
    <button class="btn btn-danger" data-dismiss="modal"> Close</button>
  </div>
</div>