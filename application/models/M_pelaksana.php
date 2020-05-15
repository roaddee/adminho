<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pelaksana extends CI_Model
{
	private static $table = 'pelaksana';

	public function select_all()
	{
		return $this->db->get(self::$table)->result();
	}

	public function select_by_id($id)
	{
		return $this->db
			->select()
			->where('id', $id)
			->get(self::$table)
			->row();
	}

	public function select_by_pelanggan($id)
	{
		$sql = " SELECT pelanggan.id AS id, pelanggan.nama AS pelanggan, pelanggan.telp AS telp, jasa.nama AS jasa, kelamin.nama AS kelamin, pelaksana.nama AS pelaksana FROM pelanggan, jasa, kelamin, pelaksana WHERE pelanggan.id_kelamin = kelamin.id AND pelanggan.id_pelaksana = pelaksana.id AND pelanggan.id_jasa = jasa.id AND pelanggan.id_pelaksana={$id}";

		// $this->db
		// 	->select('pelanggan.nama as pelanggan, pelanggan.*')
		// 	->select('jasa.nama as jasa')
		// 	->select('pelaksana.nama as pelaksana')
		// 	->from('pelanggan')
		// 	->join()

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data)
	{
		return $this->db->insert(self::$table, $data);
	}

	public function insert_batch($data)
	{
		return $this->db->insert_batch(self::$table, $data);
	}

	public function update($data)
	{
		return $this->db->update(self::$table, $data, ['id' => $data['id']]);
	}

	public function delete($id)
	{
		return $this->db->delete(self::$table, ['id' => $id]);
	}

	public function check_nama($nama)
	{
		$this->db->where('nama', $nama);
		$data = $this->db->get('pelaksana');

		return $data->num_rows();
	}

	public function total_rows()
	{
		$data = $this->db->get('pelaksana');

		return $data->num_rows();
	}
}

/* End of file M_pelaksana.php */
/* Location: ./application/models/M_pelaksana.php */
