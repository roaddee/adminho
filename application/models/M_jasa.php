<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_jasa extends CI_Model
{
	private static $table = 'jasa';

	public function select_all()
	{
		return $this->db->get(self::$table)->result();
	}

	public function select_by_id($id)
	{
		return $this->db
			->where('id', $id)
			->get(self::$table)
			->row();
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
