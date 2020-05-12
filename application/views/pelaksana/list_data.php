<?php
  $no = 1;
  foreach ($dataPelaksana as $pelaksana) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $pelaksana->nama; ?></td>
      <td class="text-center" style="min-width:230px;">
        <button class="btn btn-warning update-dataPelaksana" data-id="<?php echo $pelaksana->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
        <button class="btn btn-danger konfirmasiHapus-pelaksana" data-id="<?php echo $pelaksana->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
        <button class="btn btn-info detail-dataPelaksana" data-id="<?php echo $pelaksana->id; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>