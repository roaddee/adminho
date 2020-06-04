<div class="col-md-12 well">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;"><i class="fa fa-briefcase"></i> Daftar Pelanggan (Pelaksana : <b><?php echo $pelaksana->nama; ?></b>)</h3>

  <div class="box box-body">
    <table id="tabel-detail" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Nomor Kontak</th>
          <th>Jasa</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody id="data-pelaksana">
        <?php
        foreach ($dataPelanggan as $pelanggan) {
        ?>
          <tr>
            <td style="min-width:230px;"><?php echo $pelanggan->pelanggan; ?></td>
            <td><?php echo $pelanggan->nomorkontak; ?></td>
            <td><?php echo $pelanggan->jasa; ?></td>
            <td><?php echo $pelanggan->keterangan; ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>

  <div class="text-right">
    <button class="btn btn-danger" data-dismiss="modal"> Close</button>
  </div>
</div>