<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelaksana extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_pelaksana');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['dataPelaksana'] = $this->M_pelaksana->select_all();

		$data['page'] 		= "pelaksana";
		$data['judul'] 		= "Data Pelaksana";
		$data['deskripsi'] 	= "Manage Data Pelaksana";

		$data['modal_tambah_pelaksana'] = show_my_modal('modals/modal_tambah_pelaksana', 'tambah-pelaksana', $data);

		$this->template->views('pelaksana/home', $data);
	}

	public function tampil() {
		$data['dataPelaksana'] = $this->M_pelaksana->select_all();
		$this->load->view('pelaksana/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('pelaksana', 'pelaksana', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_pelaksana->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Pelaksana Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Pelaksana Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['dataPelaksana'] = $this->M_pelaksana->select_by_id($id);

		echo show_my_modal('modals/modal_update_pelaksana', 'update-pelaksana', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('pelaksana', 'pelaksana', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_pelaksana->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Pelaksana Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Pelaksana Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_pelaksana->delete($id);
		
		if ($result > 0) {
			echo show_succ_msg('Data Pelaksana Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Pelaksana Gagal dihapus', '20px');
		}
	}

	public function detail() {
		$data['userdata'] 		= $this->userdata;

		$id 					= trim($_POST['id']);
		$data['pelaksana'] 		= $this->M_pelaksana->select_by_id($id);
		$data['dataPelaksana'] 	= $this->M_pelaksana->select_by_pelanggan($id);

		echo show_my_modal('modals/modal_detail_pelaksana', 'detail-pelaksana', $data, 'lg');
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_pelaksana->select_all();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "ID"); 
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Nama Pelaksana");
		$rowCount++;

		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->nama); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data Pelaksana.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data Pelaksana.xlsx', NULL);
	}

	public function import() {
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {
			$this->session->set_flashdata('msg', 'File harus diisi');
		} else {
			$config['upload_path'] = './assets/excel/';
			$config['allowed_types'] = 'xls|xlsx';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('excel')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$data = $this->upload->data();
				
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Jakarta');

				include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';

				$inputFileName = './assets/excel/' .$data['file_name'];
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

				$index = 0;
				foreach ($sheetData as $key => $value) {
					if ($key != 1) {
						$check = $this->M_pelaksana->check_nama($value['B']);

						if ($check != 1) {
							$resultData[$index]['nama'] = ucwords($value['B']);
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_jasa->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Pelaksana Berhasil diimport ke database'));
						redirect('Pelaksana');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Pelaksana Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('Pelaksana');
				}

			}
		}
	}
}

/* End of file Pelaksana.php */
/* Location: ./application/controllers/Pelaksana.php */