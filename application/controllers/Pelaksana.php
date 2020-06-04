<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelaksana extends AUTH_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_pelaksana', 'pelaksana');
		$this->load->model('M_pelanggan', 'pelanggan');
	}

	public function index()
	{
		$data['userdata'] = $this->userdata;
		$data['dataPelaksana'] = $this->pelaksana->select_all();

		$data['page'] = 'pelaksana';
		$data['judul'] = 'Data Pelaksana';
		$data['deskripsi'] = 'Manage Data Pelaksana';

		$data['modal_tambah_pelaksana'] = show_my_modal(
			'modals/modal_tambah_pelaksana',
			'tambah-pelaksana',
			$data
		);

		$this->template->views('pelaksana/home', $data);
	}

	public function tampil()
	{
		$data['dataPelaksana'] = $this->pelaksana->select_all();
		$this->load->view('pelaksana/list_data', $data);
	}

	public function prosesTambah()
	{
		$data = $this->input->post();
		if ($this->isValidated()) {
			$result = $this->pelaksana->insert($data);

			if ($result) {
				$out['type'] = 'success';
				$out['message'] = 'Data Pelaksana Berhasil ditambahkan';
			} else {
				$out['type'] = 'error';
				$out['message'] = 'Data Pelaksana Gagal ditambahkan';
			}
		} else {
			$out['type'] = 'warning';
			$out['message'] = validation_errors();
		}

		$this->printJson($out);
	}

	public function update()
	{
		$data['userdata'] = $this->userdata;

		$id = trim($this->input->post('id'));
		$data['dataPelaksana'] = $this->pelaksana->select_by_id($id);

		echo show_my_modal(
			'modals/modal_update_pelaksana',
			'update-pelaksana',
			$data
		);
	}

	public function prosesUpdate()
	{
		$data = $this->input->post();
		if ($this->isValidated()) {
			$result = $this->pelaksana->update($data);

			if ($result) {
				$out['type'] = 'success';
				$out['message'] = 'Data Pelaksana Berhasil diupdate';
			} else {
				$out['type'] = 'error';
				$out['message'] = 'Data Pelaksana Gagal diupdate';
			}
		} else {
			$out['type'] = 'warning';
			$out['message'] = validation_errors();
		}

		$this->printJson($out);
	}

	public function delete()
	{
		$id = $_POST['id'];
		$result = $this->pelaksana->delete($id);

		if ($result) {
			echo 'Data Pelaksana Berhasil dihapus';
		} else {
			echo 'Data Pelaksana Gagal dihapus';
		}
	}

	public function detail()
	{
		/* $data['userdata'] = $this->userdata;

		$id = trim($this->input->post('id'));
		$data['pelaksana'] = $this->pelaksana->select_by_id($id);
		$data['dataPelaksana'] = $this->pelaksana->select_by_pelanggan($id);

		echo show_my_modal(
			'modals/modal_detail_pelaksana',
			'detail-pelaksana',
			$data,
			'lg'
		); */

		$data['userdata'] = $this->userdata;

		$id = $this->input->post('id');
		$data['pelaksana'] = $this->pelaksana->select_by_id($id);
		$data['jumlahPelaksana'] = $this->pelaksana->total_rows();
		$data['dataPelanggan'] = $this->pelanggan->select_all_by_pelaksana($id);

		echo show_my_modal('modals/modal_detail_pelaksana', 'detail-pelaksana', $data, 'lg');
	}

	public function export()
	{
		error_reporting(E_ALL);

		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->pelaksana->select_all();

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$rowCount = 1;

		$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'ID');
		$objPHPExcel
			->getActiveSheet()
			->SetCellValue('B' . $rowCount, 'Nama Pelaksana');
		$rowCount++;

		foreach ($data as $value) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $value->id);
			$objPHPExcel
				->getActiveSheet()
				->SetCellValue('B' . $rowCount, $value->nama);
			$rowCount++;
		}

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save('./assets/excel/Data Pelaksana.xlsx');

		$this->load->helper('download');
		force_download('./assets/excel/Data Pelaksana.xlsx', null);
	}

	public function import()
	{
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {
			$this->session->set_flashdata('msg', 'File harus diisi');
		} else {
			$config['upload_path'] = './assets/excel/';
			$config['allowed_types'] = 'xls|xlsx';

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('excel')) {
				$error = ['error' => $this->upload->display_errors()];
			} else {
				$data = $this->upload->data();

				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Jakarta');

				include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';

				$inputFileName = './assets/excel/' . $data['file_name'];
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$sheetData = $objPHPExcel
					->getActiveSheet()
					->toArray(null, true, true, true);

				$index = 0;
				foreach ($sheetData as $key => $value) {
					if ($key != 1) {
						$check = $this->pelaksana->check_nama($value['B']);

						if ($check != 1) {
							$resultData[$index]['nama'] = ucwords($value['B']);
						}
					}
					$index++;
				}

				unlink('./assets/excel/' . $data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_jasa->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata(
							'msg',
							'Data Pelaksana Berhasil diimport ke database'
						);
						redirect('Pelaksana');
					}
				} else {
					$this->session->set_flashdata(
						'msg',
						show_msg(
							'Data Pelaksana Gagal diimport ke database (Data Sudah terupdate)',
							'warning',
							'fa-warning'
						)
					);
					redirect('Pelaksana');
				}
			}
		}
	}

	private function isValidated()
	{
		$this->form_validation->set_rules(
			'nama',
			'Nama Pelaksana',
			'trim|required'
		);
		return $this->form_validation->run();
	}

	private function printJson($data)
	{
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data, JSON_PRETTY_PRINT))
			->_display();

		exit();
	}
}

/* End of file Pelaksana.php */
/* Location: ./application/controllers/Pelaksana.php */
