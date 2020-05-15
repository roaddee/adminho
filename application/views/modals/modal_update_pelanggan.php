<div class="col-md-offset-1 col-md-12 col-md-offset-1 well">
  <!-- <h3 style="display:block; text-align:center;">Tambah Data pelanggan</h3> -->
  <form id="form-update-pelanggan" method="POST">
  <input type="hidden" name="id" value="<?php echo $dataPelanggan->id; ?>">
  <!-- baris pertama -->
  <div class="row">
				<div class='col-sm-6'>
					<div class='form-group'>
						<label for="nama">Nama Desa </label>
             <input type="text" class="form-control input-sm" placeholder="Nama Desa" name="nama" aria-describedby="sizing-addon2" value="<?php echo $dataPelanggan->nama; ?>"></input>
					</div>
				</div>
				<div class='col-sm-6'>
					<div class='form-group'>
						<label for="kecamatan">Nama Kecamatan</label>
						<input type="text" class="form-control input-sm" placeholder="Kecamatan" name="kecamatan" aria-describedby="sizing-addon2" value="<?php echo $dataPelanggan->kecamatan; ?>"></input>
					</div>
				</div>
  </div>

  <!-- baris kedua -->
  <div class="row">
				<div class='col-sm-6'>
					<div class='form-group'>
						<label for="kabupaten">Nama Kabupaten </label>
             <input type="text" class="form-control input-sm" placeholder="Nama Kabupaten" name="kabupaten" aria-describedby="sizing-addon2" value="<?php echo $dataPelanggan->kabupaten; ?>"></input>
					</div>
				</div>
				<div class='col-sm-6'>
					<div class='form-group'>
						<label for="provinsi">Nama Provinsi</label>
						<input type="text" class="form-control input-sm" placeholder="Kecamatan" name="provinsi" aria-describedby="sizing-addon2" value="<?php echo $dataPelanggan->provinsi; ?>"></input>
					</div>
				</div>
  </div>

  <!-- baris ketiga -->
  <div class="row">
				<div class='col-sm-6'>
					<div class='form-group'>
						<label for="namakontak">Nama Kontak </label>
             <input type="text" class="form-control input-sm" placeholder="Nama Kontak" name="namakontak" aria-describedby="sizing-addon2" value="<?php echo $dataPelanggan->namakontak; ?>"></input>
					</div>
				</div>
				<div class='col-sm-6'>
					<div class='form-group'>
						<label for="nomorkontak">Nomor Kontak</label>
						<input type="text" class="form-control input-sm" placeholder="Nomor Kontak" name="nomorkontak" aria-describedby="sizing-addon2" value="<?php echo $dataPelanggan->nomorkontak; ?>"></input>
					</div>
				</div>
  </div>

  <!-- baris keempat -->
  <div class="row">
				<div class='col-sm-6'>
					<div class='form-group'>
						<label for="domain">Alamat Domain</label>
             <input type="url" class="form-control input-sm" placeholder="Alamat Domain" name="domain" aria-describedby="sizing-addon2" value="<?php echo $dataPelanggan->domain; ?>"></input>
					</div>
				</div>
				<div class='col-sm-6'>
					<div class='form-group'>
						<label for="alamat_cpanel">Alamat cPanel</label>
						<input type="url" class="form-control input-sm" placeholder="Alamat cPanel" name="alamat_cpanel" aria-describedby="sizing-addon2" value="<?php echo $dataPelanggan->alamat_cpanel; ?>"></input>
					</div>
				</div>
  </div>
   
  <!-- baris kelima -->
  <div class="row">
				<div class='col-sm-4'>
					<div class='form-group'>
						<label for="uname_cpanel">Username cPanel</label>
             <input type="text" class="form-control input-sm" placeholder="User Name cPanel" name="uname_cpanel" aria-describedby="sizing-addon2" value="<?php echo $dataPelanggan->uname_cpanel; ?>"></input>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class='form-group'>
						<label for="pwd_cpanel">Password cPanel</label>
						<input type="text" class="form-control input-sm" placeholder="Password cPanel" name="pwd_cpanel" aria-describedby="sizing-addon2" value="<?php echo $dataPelanggan->pwd_cpanel; ?>"></input>
					</div>
				</div>
        <div class='col-sm-4'>
					<div class='form-group'>
						<label for="pwd_admin">Password Admin</label>
						<input type="text" class="form-control input-sm" placeholder="Password Admin" name="pwd_admin" aria-describedby="sizing-addon2" value="<?php echo $dataPelanggan->pwd_admin; ?>"></input>
					</div>
				</div>
  </div>

  <!-- baris keenam -->
  <div class="row">
				<div class='col-sm-4'>
					<div class='form-group'>
						<label for="jasa">Jenis Jasa</label>
            <select name="jasa" class="form-control input-sm"  aria-describedby="sizing-addon2">
            <?php
             foreach ($dataJasa as $jasa) {
            ?>
              <option value="<?php echo $jasa->id; ?>" <?php if($jasa->id == $dataPelanggan->id_jasa){echo "selected='selected'";} ?>><?php echo $jasa->nama; ?></option>
            <?php
            } 
            ?>
            </select>
					</div>
				</div>

				<div class='col-sm-4'>
					<div class='form-group'>
						<label for="rupiah">Biaya</label>
						<input type="text" id="input_mask_rupiah" class="form-control input-sm" name="rupiah" aria-describedby="sizing-addon2" value="<?php echo $dataPelanggan->rupiah; ?>"></input>
					</div>
				</div>
        
        <div class='col-sm-4'>
					<div class='form-group'>
						<label for="pelaksana">Jenis Jasa</label>
            <select name="pelaksana" class="form-control input-sm"  aria-describedby="sizing-addon2">
            <?php
             foreach ($dataPelaksana as $pelaksana) {
            ?>
              <option value="<?php echo $pelaksana->id; ?>" <?php if($pelaksana->id == $dataPelanggan->id_pelaksana){echo "selected='selected'";} ?>><?php echo $pelaksana->nama; ?></option>
            <?php
            } 
            ?>
            </select>
					</div>
				</div>
  </div>

  <!-- konversi tanggal dari database menjadi string -->
  <?php
  $tgl_mulai = date("d-m-Y", strtotime($dataPelanggan->tgl_mulai));
  $tgl_akhir = date("d-m-Y", strtotime($dataPelanggan->tgl_akhir));
  ?>

  <!-- baris ketujuh -->
  <div class="row">
				<div class='col-sm-4'>
					<div class='form-group'>
						<label for="tgl_mulai">Tanggal Mulai</label>
             <input id="input_mask_tanggal_mulai_update" type="text" class="form-control input-sm" placeholder="Tanggal Mulai" name="tgl_mulai" aria-describedby="sizing-addon2" value="<?php echo $tgl_mulai; ?>"></input>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class='form-group'>
						<label for="tgl_akhir">Tanggal Akhir</label>
						<input id="input_mask_tanggal_akhir_update" type="text" class="form-control input-sm" placeholder="Tanggal Akhir" name="tgl_akhir" aria-describedby="sizing-addon2" value="<?php echo $tgl_akhir; ?>"></input>
					</div>
				</div>
        <div class='col-sm-4'>
					<div class='form-group'>
						<label for="keterangan">Keterangan</label>
						<input type="text" class="form-control input-sm" placeholder="Keterangan" name="keterangan" aria-describedby="sizing-addon2" value="<?php echo $dataPelanggan->keterangan; ?>"></input>
					</div>
				</div>
  </div>
  <div class="form-group">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>
    </div>
    <div class="col-sm-4"></div>
  </div>
  </form>
  <hr>
  <!-- menampilkan pesan -->
  <div></div>
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

</div>

<script type="text/javascript">
$(function () {
    $(".select2").select2();

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    $("#input_mask_tanggal_mulai_update").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    separator: "-"
    });

    $("#input_mask_tanggal_akhir_update").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    separator: "-"
    });

    $("#input_mask_tanggal_update").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    separator: "-"
    });

    $("#input_mask_rupiah").inputmask({
    prefix : 'Rp ',
    radixPoint: ',',
    groupSeparator: ".",
    alias: "numeric",
    autoGroup: true,
    digits: 0
});
});
</script>
