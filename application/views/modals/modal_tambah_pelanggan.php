<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Data pelanggan</h3>

  <form id="form-tambah-pelanggan" method="POST">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="text" class="form-control" placeholder="Nama Desa" name="nama" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-phone-alt"></i>
      </span>
      <input type="text" class="form-control" placeholder="Kecamatan" name="kecamatan" aria-describedby="sizing-addon2">
    </div>

    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-phone-alt"></i>
      </span>
      <input type="text" class="form-control" placeholder="Kabupaten" name="kabupaten" aria-describedby="sizing-addon2">
    </div>

    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-phone-alt"></i>
      </span>
      <input type="text" class="form-control" placeholder="Provinsi" name="provinsi" aria-describedby="sizing-addon2">
    </div>

    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-phone-alt"></i>
      </span>
      <input type="text" class="form-control" placeholder="Nama Kontak" name="namakontak" aria-describedby="sizing-addon2">
    </div>

    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-phone-alt"></i>
      </span>
      <input type="number" class="form-control" placeholder="Nomor Kontak" name="nomorkontak" aria-describedby="sizing-addon2">
    </div>

    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-phone-alt"></i>
      </span>
      <input type="url" class="form-control" placeholder="Alamat Domain" name="domain" aria-describedby="sizing-addon2">
    </div>

    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-phone-alt"></i>
      </span>
      <input type="url" class="form-control" placeholder="Alamat cPanel" name="alamat_cpanel" aria-describedby="sizing-addon2">
    </div>

    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-phone-alt"></i>
      </span>
      <input type="text" class="form-control" placeholder="UserName cPanel" name="uname_cpanel" aria-describedby="sizing-addon2">
    </div>

    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-phone-alt"></i>
      </span>
      <input type="text" class="form-control" placeholder="Password cPanel" name="pwd_cpanel" aria-describedby="sizing-addon2">
    </div>

    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-phone-alt"></i>
      </span>
      <input type="url" class="form-control" placeholder="Password Admin" name="pwd_admin" aria-describedby="sizing-addon2">
    </div>

    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-home"></i>
      </span>
      <select name="jasa" class="form-control select2" aria-describedby="sizing-addon2" style="width: 100%">
        <?php
        foreach ($dataJasa as $jasa) {
          ?>
          <option value="<?php echo $jasa->id; ?>">
            <?php echo $jasa->nama; ?>
          </option>
          <?php
        }
        ?>
      </select>
    </div>

    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-phone-alt"></i>
      </span>
      <input type="number" class="form-control" placeholder="Nominal Pembayaran" name="rupiah" aria-describedby="sizing-addon2">
    </div>

    <div class="input-group form-group">
    <!-- <label>Date masks:</label> -->
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <!-- <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask> -->
          <input type="text" class="form-control" id="input_mask_tanggal">
        </div>
    <!-- /.input group -->
    </div>

    <!-- <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-phone-alt"></i>
      </span>
      <input type="date" class="form-control" placeholder="Tanggal Mulai" name="tgl_mulai" aria-describedby="sizing-addon2">
    </div> -->
   
<!--     <div class="input-group form-group" style="display: inline-block;">
      <span class="input-group-addon" id="sizing-addon2">
      <i class="glyphicon glyphicon-tag"></i>
      </span>
      <span class="input-group-addon">
          <input type="radio" name="jk" value="1" id="laki" class="minimal">
      <label for="laki">Laki-laki</label>
        </span>
        <span class="input-group-addon">
          <input type="radio" name="jk" value="2" id="perempuan" class="minimal"> 
      <label for="perempuan">Perempuan</label>
        </span>
    </div>
 -->    
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-briefcase"></i>
      </span>
      <select name="pelanggan" class="form-control select2"  aria-describedby="sizing-addon2" style="width: 100%">
        <?php
        foreach ($dataPelaksana as $pelaksana) {
          ?>
          <option value="<?php echo $pelaksana->id; ?>">
            <?php echo $pelaksana->nama; ?>
          </option>
          <?php
        }
        ?>
      </select>
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>
      </div>
    </div>
  </form>
</div>

<script type="text/javascript">
$(function () {
    $(".select2").select2();

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    $("#input_mask_tanggal").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    separator: "-"
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

$("#input_mask_currency").inputmask({
    prefix : 'Rp ',
    radixPoint: ',',
    groupSeparator: ".",
    alias: "numeric",
    autoGroup: true,
    digits: 0
});
</script> -->