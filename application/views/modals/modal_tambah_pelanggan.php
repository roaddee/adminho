<!-- <meta name="csrf-token" content="{{ csrf_token() }}" /> -->
<div class="col-md-offset-1 col-md-12 col-md-offset-1 well">
  <!-- <h3 style="display:block; text-align:center;">Tambah Data pelanggan</h3> -->
  <form id="form-tambah-pelanggan" method="POST">
    <!-- baris pertama -->
    <div class="row">
      <div class='col-sm-6'>
        <div class='form-group'>
          <label for="nama">Nama Desa </label>
          <input type="text" class="form-control input-sm" placeholder="Nama Desa" name="nama" aria-describedby="sizing-addon2"></input>
        </div>
      </div>
      <div class='col-sm-6'>
        <div class='form-group'>
          <label for="kecamatan">Nama Kecamatan</label>
          <input type="text" class="form-control input-sm" placeholder="Kecamatan" name="kecamatan" aria-describedby="sizing-addon2"></input>
        </div>
      </div>
    </div>

    <!-- baris kedua -->
    <div class="row">
      <div class='col-sm-6'>
        <div class='form-group'>
          <label for="kabupaten">Nama Kabupaten </label>
          <input type="text" class="form-control input-sm" placeholder="Nama Kabupaten" name="kabupaten" aria-describedby="sizing-addon2"></input>
        </div>
      </div>
      <div class='col-sm-6'>
        <div class='form-group'>
          <label for="provinsi">Nama Provinsi</label>
          <input type="text" class="form-control input-sm" placeholder="Kecamatan" name="provinsi" aria-describedby="sizing-addon2"></input>
        </div>
      </div>
    </div>

    <!-- baris ketiga -->
    <div class="row">
      <div class='col-sm-6'>
        <div class='form-group'>
          <label for="namakontak">Nama Kontak </label>
          <input type="text" class="form-control input-sm" placeholder="Nama Kontak" name="namakontak" aria-describedby="sizing-addon2"></input>
        </div>
      </div>
      <div class='col-sm-6'>
        <div class='form-group'>
          <label for="nomorkontak">Nomor Kontak</label>
          <input type="text" class="form-control input-sm" placeholder="Nomor Kontak" name="nomorkontak" aria-describedby="sizing-addon2"></input>
        </div>
      </div>
    </div>

    <!-- baris keempat -->
    <div class="row">
      <div class='col-sm-6'>
        <div class='form-group'>
          <label for="domain">Alamat Domain</label>
          <input type="url" class="form-control input-sm" placeholder="Alamat Domain" name="domain" aria-describedby="sizing-addon2"></input>
        </div>
      </div>
      <div class='col-sm-6'>
        <div class='form-group'>
          <label for="alamat_cpanel">Alamat cPanel</label>
          <input type="url" class="form-control input-sm" placeholder="Alamat cPanel" name="alamat_cpanel" aria-describedby="sizing-addon2"></input>
        </div>
      </div>
    </div>

    <!-- baris kelima -->
    <div class="row">
      <div class='col-sm-4'>
        <div class='form-group'>
          <label for="uname_cpanel">Username cPanel</label>
          <input type="text" class="form-control input-sm" placeholder="User Name cPanel" name="uname_cpanel" aria-describedby="sizing-addon2"></input>
        </div>
      </div>
      <div class='col-sm-4'>
        <div class='form-group'>
          <label for="pwd_cpanel">Password cPanel</label>
          <input type="text" class="form-control input-sm" placeholder="Password cPanel" name="pwd_cpanel" aria-describedby="sizing-addon2"></input>
        </div>
      </div>
      <div class='col-sm-4'>
        <div class='form-group'>
          <label for="pwd_admin">Password Admin</label>
          <input type="text" class="form-control input-sm" placeholder="Password Admin" name="pwd_admin" aria-describedby="sizing-addon2"></input>
        </div>
      </div>
    </div>

    <!-- baris keenam -->
    <div class="row">
      <div class='col-sm-4'>
        <div class='form-group'>
          <label for="jasa">Jenis Jasa</label>
          <select name="id_jasa" class="form-control input-sm" aria-describedby="sizing-addon2" style="width: 100%">
            <?php foreach ($dataJasa as $jasa) : ?>
              <option value="<?= $jasa->id ?>"><?= $jasa->nama ?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>

      <div class='col-sm-4'>
        <div class='form-group'>
          <label for="rupiah">Biaya</label>
          <input type="text" id="input_mask_rupiah" class="form-control input-sm" name="rupiah" aria-describedby="sizing-addon2"></input>
        </div>
      </div>

      <div class='col-sm-4'>
        <div class='form-group'>
          <label for="pelaksana">Pelaksana</label>
          <select name="id_pelaksana" class="form-control input-sm" aria-describedby="sizing-addon2" style="width: 100%">
            <?php foreach ($dataPelaksana as $pelaksana) : ?>
              <option value="<?= $pelaksana->id ?>"><?= $pelaksana->nama ?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
    </div>

    <!-- baris ketujuh -->
    <div class="row">
      <div class='col-sm-4'>
        <div class='form-group'>
          <label for="tgl_mulai">Tanggal Mulai</label>
          <input id="input_mask_tanggal_mulai" type="text" class="form-control input-sm" placeholder="Tanggal Mulai" name="tgl_mulai" aria-describedby="sizing-addon2"></input>
        </div>
      </div>
      <div class='col-sm-4'>
        <div class='form-group'>
          <label for="tgl_akhir">Tanggal Akhir</label>
          <input id="input_mask_tanggal_akhir" type="text" class="form-control input-sm" placeholder="Tanggal Akhir" name="tgl_akhir" aria-describedby="sizing-addon2"></input>
        </div>
      </div>
      <div class='col-sm-4'>
        <div class='form-group'>
          <label for="keterangan">Keterangan</label>
          <input type="text" class="form-control input-sm" placeholder="Keterangan" name="keterangan" aria-describedby="sizing-addon2"></input>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-4"></div>
      <div class="col-sm-4">
        <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah
          Data</button>
      </div>
      <div class="col-sm-4"></div>
    </div>
  </form>
</div>

<script type="text/javascript">
  $(function() {
    $(".select2").select2();

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    $("#input_mask_tanggal_mulai").inputmask("datetime", {
      mask: "1-2-y",
      placeholder: "dd-mm-yyyy",
      separator: "-"
    });

    $("#input_mask_tanggal_akhir").inputmask("datetime", {
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
      prefix: 'Rp ',
      radixPoint: ',',
      groupSeparator: ".",
      alias: "numeric",
      autoGroup: true,
      digits: 0
    });
  });
</script>

<!-- <script>
$('#input_mask').inputmask({
    mask: 'SJ-AAA-****-99999',
    definitions: {
        A: {
            validator: "[A-Za-z0-9 ]"
        },
    },            
});

$("#input_mask_date_time").inputmask("datetime", {
    mask: "y-1-2 h:s:s",
    placeholder: "yyyy-mm-dd hh:mm:ss",
    separator: "-",
    hourFormat : 12
});
</script> -->