<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_jasa extends CI_Model
{
	public function select_all()
	{
		$this->db->select('*');
		$this->db->from('jasa');

		$data = $this->db->get();

		return $data->result();
	}

	public function select_by_id($id)
	{
		$sql = "SELECT * FROM jasa WHERE id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_pelanggan($id)
	{
		$sql = " SELECT pelanggan.id AS id, pelanggan.nama AS pelanggan, pelanggan.telp AS telp, jasa.nama AS jasa, kelamin.nama AS kelamin, pelaksana.nama AS pelaksana FROM pelanggan, jasa, kelamin, pelaksana WHERE pelanggan.id_kelamin = kelamin.id AND pelanggan.id_pelaksana = pelaksana.id AND pelanggan.id_jasa = jasa.id AND pelanggan.id_jasa={$id}";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data)
	{
		$sql = "INSERT INTO jasa VALUES('','" . $data['jasa'] . "')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data)
	{
		$this->db->insert_batch('jasa', $data);

		return $this->db->affected_rows();
	}

	public function update($data)
	{
		$sql =
			"UPDATE jasa SET nama='" .
			$data['jasa'] .
			"' WHERE id='" .
			$data['id'] .
			"'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id)
	{
		$sql = "DELETE FROM jasa WHERE id='" . $id . "'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama)
	{
		$this->db->where('nama', $nama);
		$data = $this->db->get('jasa');

		return $data->num_rows();
	}

	public function total_rows()
	{
		$data = $this->db->get('jasa');

		return $data->num_rows();
	}
}

/* End of file M_jasa.php */
/* Location: ./application/models/M_jasa.php */
