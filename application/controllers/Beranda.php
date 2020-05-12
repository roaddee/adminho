<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_pelanggan');
		$this->load->model('M_pelaksana');
		$this->load->model('M_jasa');
	}

	public function index() {
		$data['jml_pelanggan'] 	= $this->M_pelanggan->total_rows();
		$data['jml_pelaksana'] 	= $this->M_pelaksana->total_rows();
		$data['jml_jasa'] 		= $this->M_jasa->total_rows();
		$data['userdata'] 		= $this->userdata;

		$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
		
		$pelaksana 				= $this->M_pelaksana->select_all();
		$index = 0;
		foreach ($pelaksana as $value) {
		    $color = '#' .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)];

			$pelanggan_by_pelaksana = $this->M_pelanggan->select_by_pelaksana($value->id);

			$data_pelaksana[$index]['value'] = $pelanggan_by_pelaksana->jml;
			$data_pelakksana[$index]['color'] = $color;
			$data_pelakksana[$index]['highlight'] = $color;
			$data_pelaksana[$index]['label'] = $value->nama;
			
			$index++;
		}

		$jasa 				= $this->M_jasa->select_all();
		$index = 0;
		foreach ($jasa as $value) {
		    $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];

			$pelanggan_by_jasa = $this->M_pelanggan->select_by_jasa($value->id);

			$data_jasa[$index]['value'] = $pelanggan_by_jasa->jml;
			$data_jasa[$index]['color'] = $color;
			$data_jasa[$index]['highlight'] = $color;
			$data_jasa[$index]['label'] = $value->nama;
			
			$index++;
		}

		$data['data_pelaksana'] = json_encode($data_pelaksana);
		$data['data_jasa'] = json_encode($data_jasa);

		$data['page'] 			= "beranda";
		$data['judul'] 			= "Beranda";
		$data['deskripsi'] 		= "Data Hosting OpenDESA";
		$this->template->views('home', $data);
	}
}

/* End of file Beranda.php */
/* Location: ./application/controllers/Beranda.php */