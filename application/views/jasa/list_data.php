<?php
$no = 1;
foreach ($dataJasa as $jasa) {
?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $jasa->nama; ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-dataJasa" data-id="<?php echo $jasa->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      <button class="btn btn-danger konfirmasiHapus-jasa" data-id="<?php echo $jasa->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      <button class="btn btn-info detail-dataJasa" data-id="<?php echo $jasa->id; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button>
    </td>
  </tr>
<?php
  $no++;
}
?>