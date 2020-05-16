<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jasa extends AUTH_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_jasa', 'jasa');
	}

	public function index()
	{
		$data['userdata'] = $this->userdata;
		$data['dataJasa'] = $this->jasa->select_all();

		$data['page'] = 'jasa';
		$data['judul'] = 'Data Jasa';
		$data['deskripsi'] = 'Manage Data Jasa';

		$data['modal_tambah_jasa'] = show_my_modal(
			'modals/modal_tambah_jasa',
			'tambah-jasa',
			$data
		);

		$this->template->views('jasa/home', $data);
	}

	public function tampil()
	{
		$data['dataJasa'] = $this->jasa->select_all();
		$this->load->view('jasa/list_data', $data);
	}

	public function prosesTambah()
	{
		$this->form_validation->set_rules('jasa', 'Jasa', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == true) {
			$result = $this->jasa->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Jasa Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Jasa Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update()
	{
		$data['userdata'] = $this->userdata;

		$id = trim($_POST['id']);
		$data['dataJasa'] = $this->jasa->select_by_id($id);

		echo show_my_modal('modals/modal_update_jasa', 'update-jasa', $data);
	}

	public function prosesUpdate()
	{
		$this->form_validation->set_rules('jasa', 'Jasa', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == true) {
			$result = $this->jasa->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Jasa Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Jasa Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete()
	{
		$id = $_POST['id'];
		$result = $this->jasa->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Data Jasa Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Jasa Gagal dihapus', '20px');
		}
	}

	public function detail()
	{
		$data['userdata'] = $this->userdata;

		$id = trim($_POST['id']);
		$data['jasa'] = $this->jasa->select_by_id($id);
		$data['jumlahJasa'] = $this->jasa->total_rows();
		$data['dataJasa'] = $this->jasa->select_by_pegawai($id);

		echo show_my_modal('modals/modal_detail_jasa', 'detail-jasa', $data, 'lg');
	}

	public function export()
	{
		error_reporting(E_ALL);

		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->jasa->select_all();

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nama Jasa');

		$rowCount = 2;
		foreach ($data as $value) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $value->id);
			$objPHPExcel
				->getActiveSheet()
				->SetCellValue('B' . $rowCount, $value->nama);
			$rowCount++;
		}

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save('./assets/excel/Data Jasa.xlsx');

		$this->load->helper('download');
		force_download('./assets/excel/Data Jasa.xlsx', null);
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
						$check = $this->jasa->check_nama($value['B']);

						if ($check != 1) {
							$resultData[$index]['nama'] = ucwords($value['B']);
						}
					}
					$index++;
				}

				unlink('./assets/excel/' . $data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->jasa->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata(
							'msg',
							show_succ_msg('Data Jasa Berhasil diimport ke database')
						);
						redirect('Jasa');
					}
				} else {
					$this->session->set_flashdata(
						'msg',
						show_msg(
							'Data Jasa Gagal diimport ke database (Data Sudah terupdate)',
							'warning',
							'fa-warning'
						)
					);
					redirect('Jasa');
				}
			}
		}
	}
}

/* End of file Jasa.php */
/* Location: ./application/controllers/Jasa.php */
