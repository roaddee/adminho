<?php
  foreach ($dataPelanggan as $pelanggan) {
    ?>
    <tr>
      <td style="min-width:230px;"><?php echo $pelanggan->pelanggan; ?></td>
      <td><?php echo $pelanggan->kecamatan; ?></td>
      <td><?php echo $pelanggan->jasa; ?></td>
      <td><?php echo $pelanggan->pelaksana; ?></td>
      <td><?php echo $pelanggan->keterangan; ?></td>
      <td class="text-center" style="min-width:230px;">
        <button class="btn btn-warning update-dataPelanggan" data-id="<?php echo $pelanggan->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
        <button class="btn btn-danger konfirmasiHapus-pelanggan" data-id="<?php echo $pelanggan->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
  }
?>