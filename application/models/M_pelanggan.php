<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelanggan extends CI_Model {
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
	}

	public function select_by_id($id) {
		$sql = "SELECT pelanggan.id AS id_pelanggan, pelanggan.nama AS nama_pelanggan, pelanggan.id_jasa, pelanggan.id_kelamin, pelanggan.id_pelaksana, pelanggan.telp AS telp, jasa.nama AS jasa, kelamin.nama AS kelamin, pelaksana.nama AS pelaksana FROM pelanggan, jasa, kelamin, pelaksana WHERE pelanggan.id_jasa = jasa.id AND pelanggan.id_kelamin = kelamin.id AND pelanggan.id_pelaksana = pelaksana.id AND pelanggan.id = '{$id}'";

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
		$sql = "INSERT INTO pelanggan VALUES('{$id}'" . ",'" . $data['nama'] . "','" . $data['kecamatan'] . "','"; 
		$sql = $sql . $data['kabupaten'] . "','" . $data['provinsi'] . "','" . $data['namakontak'] . "','";
		$sql = $sql . $data['nomorkontak'] . "','" . $data['alamat_domain'] . "','" . $data['alamat_cpanel'] . "','";
		$sql = $sql . $data['uname_cpanel'] . "','" . $data['pwd_cpanel'] . "','" . $data['pwd_admin'] . "',"; 
		$sql = $sql . $data['id_jasa'] . ",'" . $data['rupiah'] . "','" . $data['id_pelaksana'] . "','";
		$sql = $sql . date('Y-m-d', strtotime($data['tgl_mulai'])) . "," . date('Y-m-d', strtotime($data['tgl_akhir'])) . ",'" . $data['keterangan'] . "')";
		//$sql = $sql . "'2020-04-10'" . "," . "'2020-04-12'" . ",'" . $data['keterangan'] . "')";

		//$sql2 = "INSERT INTO pelanggan (id) VALUES('{$id}'" . ")";

		$this->db->query($sq);

		return $this->db->affected_rows();
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