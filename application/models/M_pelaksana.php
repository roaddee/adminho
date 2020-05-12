<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelaksana extends CI_Model {
	public function select_all() {
		$data = $this->db->get('pelaksana');

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM pelaksana WHERE id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_pelanggan($id) {
		$sql = " SELECT pelanggan.id AS id, pelanggan.nama AS pelanggan, pelanggan.telp AS telp, jasa.nama AS jasa, kelamin.nama AS kelamin, pelaksana.nama AS pelaksana FROM pelanggan, jasa, kelamin, pelaksana WHERE pelanggan.id_kelamin = kelamin.id AND pelanggan.id_pelaksana = pelaksana.id AND pelanggan.id_jasa = jasa.id AND pelanggan.id_pelaksana={$id}";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data) {
		$sql = "INSERT INTO pelaksana VALUES('','" .$data['pelaksana'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('pelaksana', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE pelaksana SET nama='" .$data['pelaksana'] ."' WHERE id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM pelaksana WHERE id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('pelaksana');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('pelaksana');

		return $data->num_rows();
	}
}

/* End of file M_pelaksana.php */
/* Location: ./application/models/M_pelaksana.php */