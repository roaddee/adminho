<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelanggan extends CI_Model {
	
	private static $table = 'pelanggan';
	
	public function select_all_pelanggan() {
		$sql = "SELECT * FROM pelanggan";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all() {
		$sql = "SELECT pelanggan.id AS id, pelanggan.nama AS pelanggan, pelanggan.kecamatan AS kecamatan, ";
		$sql = $sql . "pelanggan.kabupaten AS kabupaten, pelanggan.provinsi AS provinsi, ";
		$sql = $sql . "namakontak, nomorkontak, domain, alamat_cpanel, uname_cpanel, pwd_cpanel, pwd_admin, ";
		$sql = $sql . "jasa.nama AS jasa, rupiah, tgl_mulai, tgl_akhir, ";
		$sql = $sql . "pelaksana.nama AS pelaksana, tempat_hosting, keterangan ";
		$sql = $sql . "FROM pelanggan, jasa, pelaksana WHERE pelanggan.id_pelaksana = pelaksana.id AND pelanggan.id_jasa = jasa.id";

		$data = $this->db->query($sql);

		return $data->result();

		/* $this->db
      		 ->select('pelanggan.*')
      		 ->select('jasa.nama as jasa')
      		 ->select('pelaksana.nama as pelaksana')
      		 ->from(self::$table)
      		 ->join('jasa', 'pelanggan.id_jasa = jasa.id', 'left')
      		 ->join('pelaksana', 'pelanggan.id_pelaksana = pelaksana.id', 'left')
      		 ->get()
      		 ->result(); */
	}

	public function select_by_id($id) {
		$sql = "SELECT pelanggan.id, pelanggan.nama, pelanggan.kecamatan, pelanggan.kabupaten, pelanggan.provinsi, pelanggan.namakontak, ";
		$sql = $sql . "pelanggan.nomorkontak, pelanggan.domain, pelanggan.alamat_cpanel, pelanggan.uname_cpanel, pelanggan.pwd_cpanel, ";
		$sql = $sql . "pelanggan.pwd_admin, pelanggan.id_jasa, pelanggan.rupiah, pelanggan.id_pelaksana, pelanggan.tgl_mulai, pelanggan.tgl_akhir, pelanggan.keterangan, ";
		$sql = $sql . "jasa.nama AS jasa, pelaksana.nama AS pelaksana FROM pelanggan, jasa, pelaksana ";
		$sql = $sql . "WHERE pelanggan.id_jasa = jasa.id AND pelanggan.id_pelaksana = pelaksana.id AND pelanggan.id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_pelaksana($id) {
		$sql = "SELECT COUNT(*) AS jml FROM pelanggan WHERE id_pelaksana = {$id}";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_jasa($id) {
		$sql = "SELECT COUNT(*) AS jml FROM pelanggan WHERE id_jasa = {$id}";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data) {
		$sql = "UPDATE pelanggan SET nama='" .$data['nama'] ."', telp='" .$data['telp'] ."', id_jasa=" .$data['jasa'] .", id_kelamin=" .$data['jk'] .", id_pelaksana=" .$data['pelaksana'] ." WHERE id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM pelanggan WHERE id='" .$id ."'";

		$this->db->query($sql);

		//$this->db->delete('pelanggan', array('id' => $id));
		return $this->db->affected_rows();
	}

	public function insert($data) {
		$id = md5(DATE('ymdhms').rand());
		$data['id'] = $id;
		$tgl_mulai = date_create_from_format('d-m-Y', $data['tgl_mulai']);
		$tgl_akhir = date_create_from_format('d-m-Y', $data['tgl_akhir']);
		$data['tgl_mulai'] = date_format($tgl_mulai, 'Y-m-d');
		$data['tgl_akhir'] = date_format($tgl_akhir, 'Y-m-d');

		return $this->db->insert(self::$table, $data);
	}

	public function insert_batch($data) {
		$this->db->insert_batch('pelanggan', $data);
		
		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('pelanggan');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('pelanggan');

		return $data->num_rows();
	}
}

/* End of file M_pelanggan.php */
/* Location: ./application/models/M_pelanggan.php */