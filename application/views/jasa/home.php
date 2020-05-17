<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-3">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-jasa"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
    <div class="col-md-3">
        <span></span>
    </div>
    <div class="col-md-3">
        <!-- <a href="<?php echo base_url('Jasa/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a> -->
    </div>
    <div class="col-md-3">
        <!-- <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-jasa"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button> -->
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama Jasa</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-jasa">
      
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_tambah_jasa; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataJasa', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Jasa';
  $data['url'] = 'Jasa/import';
  echo show_my_modal('modals/modal_import', 'import-jasa', $data);
?>