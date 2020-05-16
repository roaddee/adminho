<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pelanggan extends CI_Model
{
	private static $table = 'pelanggan';

	public function select_all_pelanggan()
	{
		return $this->db->get(self::$table);
	}

	public function select_all()
	{
		return $this->db
			->select('pelanggan.nama as pelanggan, pelanggan.*')
			->select('jasa.nama as jasa')
			->select('pelaksana.nama as pelaksana')
			->from(self::$table)
			->join('jasa', 'pelanggan.id_jasa = jasa.id', 'left')
			->join('pelaksana', 'pelanggan.id_pelaksana = pelaksana.id', 'left')
			->get()
			->result();
	}

	public function select_by_id($id)
	{
		return $this->db
			->select('pelanggan.nama as pelanggan, pelanggan.*')
			->select('jasa.nama as jasa')
			->select('pelaksana.nama as pelaksana')
			->where('pelanggan.id', $id)
			->from(self::$table)
			->join('jasa', 'pelanggan.id_jasa = jasa.id', 'left')
			->join('pelaksana', 'pelanggan.id_pelaksana = pelaksana.id', 'left')
			->get()
			->row();
	}

	public function select_all_by_jasa($id)
	{
		return $this->db
			->select('pelanggan.nama as pelanggan, pelanggan.*')
			->select('jasa.nama as jasa')
			->select('pelaksana.nama as pelaksana')
			->where('pelanggan.id_jasa', $id)
			->from(self::$table)
			->join('jasa', 'pelanggan.id_jasa = jasa.id', 'left')
			->join('pelaksana', 'pelanggan.id_pelaksana = pelaksana.id', 'left')
			->get()
			->result();
	}

	public function select_all_by_pelaksana($id)
	{
		return $this->db
			->select('pelanggan.nama as pelanggan, pelanggan.*')
			->select('jasa.nama as jasa')
			->select('pelaksana.nama as pelaksana')
			->where('pelanggan.id_pelaksana', $id)
			->from(self::$table)
			->join('jasa', 'pelanggan.id_jasa = jasa.id', 'left')
			->join('pelaksana', 'pelanggan.id_pelaksana = pelaksana.id', 'left')
			->get()
			->result();
	}

	public function select_by_pelaksana($id)
	{
		return $this->db
			->select('count(id) as jml')
			->where('id_pelaksana', $id)
			->get(self::$table)
			->row();
	}

	public function select_by_jasa($id)
	{
		return $this->db
			->select('count(id) as jml')
			->where('id_jasa', $id)
			->get(self::$table)
			->row();
	}

	public function update($data)
	{
		$tgl_mulai = date_create_from_format('d-m-Y', $data['tgl_mulai']);
		$tgl_akhir = date_create_from_format('d-m-Y', $data['tgl_akhir']);
		$data['tgl_mulai'] = date_format($tgl_mulai, 'Y-m-d');
		$data['tgl_akhir'] = date_format($tgl_akhir, 'Y-m-d');
		
		return $this->db->update(self::$table, $data, ['id' => $data['id']]);
	}

	public function delete($id)
	{
		return $this->db->delete(self::$table, ['id' => $id]);
	}

	public function insert($data)
	{
		$id = md5(DATE('ymdhms') . rand());
		$data['id'] = $id;
		$tgl_mulai = date_create_from_format('d-m-Y', $data['tgl_mulai']);
		$tgl_akhir = date_create_from_format('d-m-Y', $data['tgl_akhir']);
		$data['tgl_mulai'] = date_format($tgl_mulai, 'Y-m-d');
		$data['tgl_akhir'] = date_format($tgl_akhir, 'Y-m-d');

		return $this->db->insert(self::$table, $data);
	}

	public function insert_batch($data)
	{
		$this->db->insert_batch(self::$table, $data);
	}

	public function check_nama($nama)
	{
		$this->db->where('nama', $nama);
		$data = $this->db->get(self::$table);

		return $data->num_rows();
	}

	public function total_rows()
	{
		$data = $this->db->get(self::$table);

		return $data->num_rows();
	}
}

/* End of file M_pelanggan.php */
/* Location: ./application/models/M_pelanggan.php */
