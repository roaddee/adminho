<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends AUTH_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_pelanggan', 'pelanggan');
		$this->load->model('m_pelaksana', 'pelaksana');
		$this->load->model('m_jasa', 'jasa');
	}

	public function index()
	{
		$data['userdata'] = $this->userdata;
		$data['dataPelanggan'] = $this->pelanggan->select_all();
		$data['dataPelaksana'] = $this->pelaksana->select_all();
		$data['dataJasa'] = $this->jasa->select_all();

		$data['page'] = 'pelanggan';
		$data['judul'] = 'Data Pelanggan';
		$data['deskripsi'] = 'Atur Data Pelanggan';

		$data['modal_tambah_pelanggan'] = show_my_modal(
			'modals/modal_tambah_pelanggan',
			'tambah-pelanggan',
			$data
		);

		$this->template->views('pelanggan/home', $data);
	}

	public function tampil()
	{
		$data['dataPelanggan'] = $this->pelanggan->select_all();
		$this->load->view('pelanggan/list_data', $data);
	}

	public function prosesTambah()
	{
		$data = $this->input->post();

		if ($this->isValidated()) {
			$result = $this->pelanggan->insert($data);
			if ($result) {
				$out['type'] = 'success';
				$out['message'] = 'Data Pelanggan Berhasil ditambahkan';
			} else {
				$out['type'] = 'error';
				$out['message'] = 'Data Pelanggan Gagal ditambahkan';
			}
		} else {
			$out['type'] = 'warning';
			$out['message'] = validation_errors();
		}

		$this->printJson($out);
	}

	public function update()
	{
		$id = trim($this->input->post('id'));

		$data['dataPelanggan'] = $this->pelanggan->select_by_id($id);
		$data['dataPelaksana'] = $this->pelaksana->select_all();
		$data['dataJasa'] = $this->jasa->select_all();
		$data['userdata'] = $this->userdata;

		echo show_my_modal(
			'modals/modal_update_pelanggan',
			'update-pelanggan',
			$data
		);
	}

	public function perpanjangan()
	{
		$id = trim($this->input->post('id'));

		$data['dataPelanggan'] = $this->pelanggan->select_by_id($id);
		$data['dataPelaksana'] = $this->pelaksana->select_all();
		$data['dataJasa'] = $this->jasa->select_all();
		$data['userdata'] = $this->userdata;

		echo show_my_modal(
			'modals/modal_perpanjangan',
			'update-perpanjangan',
			$data
		);
	}

	public function prosesUpdate()
	{
		$data = $this->input->post();
		if ($this->isValidated()) {
			$result = $this->pelanggan->update($data);
			if ($result) {
				$out['type'] = 'success';
				$out['message'] = 'Data Pelanggan Berhasil diperbarui';
			} else {
				$out['type'] = 'error';
				$out['message'] = 'Data Pelanggan Gagal diperbarui';
			}
		} else {
			$out['type'] = 'warning';
			$out['message'] = validation_errors();
		}

		$this->printJson($out);
	}

	public function prosesPerpanjangan()
	{
		$data = $this->input->post();
		if ($this->isValidated()) {
			$result = $this->pelanggan->update($data);
			if ($result) {
				$out['type'] = 'success';
				$out['message'] = 'Data Pelanggan Berhasil diperbarui';
			} else {
				$out['type'] = 'error';
				$out['message'] = 'Data Pelanggan Gagal diperbarui';
			}
		} else {
			$out['type'] = 'warning';
			$out['message'] = validation_errors();
		}

		$this->printJson($out);
	}

	public function delete()
	{
		$id = trim($this->input->post('id'));
		$result = $this->pelanggan->delete($id);

		if ($result) {
			$out['type'] = 'success';
			$out['message'] = 'Data Pelanggan berhasil dihapus';
		} else {
			$out['type'] = 'error';
			$out['message'] = 'Data Pelanggan gagal dihapus';
		}

		$this->printJson($out);
	}

	public function export()
	{
		error_reporting(E_ALL);

		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->pelanggan->select_all_pelanggan();

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$rowCount = 1;

		$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'ID');
		$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, 'Nama');
		$objPHPExcel
			->getActiveSheet()
			->SetCellValue('C' . $rowCount, 'Nomor Telepon');
		$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, 'ID Jasa');
		$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, 'ID Kelamin');
		$objPHPExcel
			->getActiveSheet()
			->SetCellValue('F' . $rowCount, 'ID Pelaksana');
		$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, 'Status');
		$rowCount++;

		foreach ($data as $value) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $value->id);
			$objPHPExcel
				->getActiveSheet()
				->SetCellValue('B' . $rowCount, $value->nama);
			$objPHPExcel
				->getActiveSheet()
				->setCellValueExplicit(
					'C' . $rowCount,
					$value->telp,
					PHPExcel_Cell_DataType::TYPE_STRING
				);
			$objPHPExcel
				->getActiveSheet()
				->SetCellValue('D' . $rowCount, $value->id_jasa);
			$objPHPExcel
				->getActiveSheet()
				->SetCellValue('E' . $rowCount, $value->id_kelamin);
			$objPHPExcel
				->getActiveSheet()
				->SetCellValue('F' . $rowCount, $value->id_pelaksana);
			$objPHPExcel
				->getActiveSheet()
				->SetCellValue('G' . $rowCount, $value->status);
			$rowCount++;
		}

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save('./assets/excel/Data Pelanggan Hosting.xlsx');

		$this->load->helper('download');
		force_download('./assets/excel/Data Pelanggan Hosting.xlsx', null);
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
						$id = md5(DATE('ymdhms') . rand());
						$check = $this->pelanggan->check_nama($value['B']);

						if ($check != 1) {
							$resultData[$index]['id'] = $id;
							$resultData[$index]['nama'] = ucwords($value['B']);
							$resultData[$index]['telp'] = $value['C'];
							$resultData[$index]['id_jasa'] = $value['D'];
							$resultData[$index]['id_kelamin'] = $value['E'];
							$resultData[$index]['id_pelaksana'] = $value['F'];
							$resultData[$index]['status'] = $value['G'];
						}
					}
					$index++;
				}

				unlink('./assets/excel/' . $data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->pelanggan->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata(
							'msg',
							show_succ_msg('Data Pelanggan Berhasil diimport ke database')
						);
						redirect('Pelanggan');
					}
				} else {
					$this->session->set_flashdata(
						'msg',
						show_msg(
							'Data Pelanggan Gagal diimport ke database (Data Sudah terupdate)',
							'warning',
							'fa-warning'
						)
					);
					redirect('Pelanggan');
				}
			}
		}
	}

	private function isValidated()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules(
			'kecamatan',
			'Kecamatan',
			'trim|required'
		);
		$this->form_validation->set_rules(
			'kabupaten',
			'Kabupaten',
			'trim|required'
		);
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
		$this->form_validation->set_rules(
			'namakontak',
			'Nama Kontak',
			'trim|required'
		);
		$this->form_validation->set_rules(
			'nomorkontak',
			'Nomor HP',
			'trim|required'
		);
		$this->form_validation->set_rules('domain', 'Nama Domain', 'trim|required');
		$this->form_validation->set_rules(
			'alamat_cpanel',
			'Alamat cPanel',
			'trim|valid_url'
		);
		$this->form_validation->set_rules(
			'uname_cpanel',
			'User Name cPanel',
			'trim|required'
		);
		$this->form_validation->set_rules(
			'pwd_cpanel',
			'Password cPanel',
			'trim|required'
		);
		$this->form_validation->set_rules(
			'pwd_admin',
			'Password Admin',
			'trim|required'
		);
		$this->form_validation->set_rules('id_jasa', 'Jasa', 'trim|required');
		$this->form_validation->set_rules('rupiah', 'Biaya', 'trim|required');
		$this->form_validation->set_rules(
			'id_pelaksana',
			'Pelaksana',
			'trim|required'
		);
		$this->form_validation->set_rules(
			'tgl_mulai',
			'Tanggal Mulai',
			'trim|required'
		);
		$this->form_validation->set_rules(
			'tgl_akhir',
			'Tanggal Akhir',
			'trim|required'
		);
		/* 
		$this->form_validation->set_rules('tgl_update', 'Tanggal Update', 'trim|required');
		$this->form_validation->set_rules('update_ke', 'Update Ke', 'trim|required');
		$this->form_validation->set_rules('sisa_update', 'Sisa Update', 'trim|required'); 
		$this->form_validation->set_rules('tempat_hosting', 'Tempat Hosting', 'trim|required');
		*/
		$this->form_validation->set_rules(
			'keterangan',
			'Keterangan',
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

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */
