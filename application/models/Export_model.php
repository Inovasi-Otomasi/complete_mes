<?php

use phpDocumentor\Reflection\PseudoTypes\True_;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Nick\SecureSpreadsheet\Encrypt;

class Export_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function Export($json_arr)
	{
		// var_dump($json_arr['sku_code']);
		$spreadsheet = new Spreadsheet();
		$spreadsheet->getSecurity()->setLockWindows(true);
		$spreadsheet->getSecurity()->setLockStructure(true);
		$spreadsheet->getSecurity()->setWorkbookPassword("adminiot");
		// $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('./assets/excell/TemplateProduktivitas_r8_1.xlsx');
		$sheet = $spreadsheet->getActiveSheet();
		$spreadsheet->getActiveSheet()->getProtection()->setPassword('adminiot');
		$spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
		$spreadsheet->getActiveSheet()->getProtection()->setSort(true);
		$spreadsheet->getActiveSheet()->getProtection()->setInsertRows(true);
		$spreadsheet->getActiveSheet()->getProtection()->setFormatCells(true);
		// $sheet = $spreadsheet->getSheetByName('Report');

		$style_col = [
			'font' => ['bold' => true], // Set font nya jadi bold
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
			]
		];
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = [
			'alignment' => [
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
			]
		];

		$datetimeexplode = explode(' to ', $json_arr['datetimerange']);
		// echo $datetimeexplode[0];
		$datetimestart = $datetimeexplode[0];
		$datetimeend = $datetimeexplode[1];

		$this->db->select('*');

		// $this->db->select('*');
		if ($json_arr['line_name'] != 'All') {
			$this->db->where('line_name', $json_arr['line_name']);
		}
		if ($json_arr['sku_code'] != 'All') {
			$this->db->where('sku_code', $json_arr['sku_code']);
		}
		$this->db->where('timestamp >=', $datetimestart);
		$this->db->where('timestamp <=', $datetimeend);
		$this->db->from('log_oee');
		$query = $this->db->get();
		$sheet->setCellValue('A' . 3, 'Timestamp');
		$sheet->setCellValue('B' . 3, 'Line Name');
		$sheet->setCellValue('C' . 3, 'SKU Code');
		$sheet->setCellValue('D' . 3, 'Item Counter');
		$sheet->setCellValue('E' . 3, 'NG Count');
		$sheet->setCellValue('F' . 3, 'Status');
		$sheet->setCellValue('G' . 3, 'Performance');
		$sheet->setCellValue('H' . 3, 'Availability');
		$sheet->setCellValue('I' . 3, 'Quality');
		$sheet->setCellValue('J' . 3, 'Run Time');
		$sheet->setCellValue('K' . 3, 'Down Time');
		$sheet->getStyle('A3')->applyFromArray($style_col);
		$sheet->getStyle('B3')->applyFromArray($style_col);
		$sheet->getStyle('C3')->applyFromArray($style_col);
		$sheet->getStyle('D3')->applyFromArray($style_col);
		$sheet->getStyle('E3')->applyFromArray($style_col);
		$sheet->getStyle('F3')->applyFromArray($style_col);
		$sheet->getStyle('G3')->applyFromArray($style_col);
		$sheet->getStyle('H3')->applyFromArray($style_col);
		$sheet->getStyle('I3')->applyFromArray($style_col);
		$sheet->getStyle('J3')->applyFromArray($style_col);
		$sheet->getStyle('K3')->applyFromArray($style_col);
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach ($query->result_array() as $data) { // Lakukan looping pada variabel siswa
			$sheet->setCellValue('A' . $numrow, $data['timestamp']);
			$sheet->setCellValue('B' . $numrow, $data['line_name']);
			$sheet->setCellValue('C' . $numrow, $data['sku_code']);
			$sheet->setCellValue('D' . $numrow, $data['item_counter']);
			$sheet->setCellValue('E' . $numrow, $data['NG_count']);
			$sheet->setCellValue('F' . $numrow, $data['status']);
			$sheet->setCellValue('G' . $numrow, $data['performance']);
			$sheet->setCellValue('H' . $numrow, $data['availability']);
			$sheet->setCellValue('I' . $numrow, $data['quality']);
			$sheet->setCellValue('J' . $numrow, $data['run_time']);
			$sheet->setCellValue('K' . $numrow, $data['down_time']);
			$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('K' . $numrow)->applyFromArray($style_row);

			$numrow++; // Tambah 1 setiap kali looping
		}

		$sheet->getColumnDimension('A')->setAutoSize(true); // Set width kolom A
		$sheet->getColumnDimension('B')->setAutoSize(true); // Set width kolom B
		$sheet->getColumnDimension('C')->setAutoSize(true); // Set width kolom C
		$sheet->getColumnDimension('D')->setAutoSize(true); // Set width kolom D
		$sheet->getColumnDimension('E')->setAutoSize(true); // Set width kolom E
		$sheet->getColumnDimension('F')->setAutoSize(true); // Set width kolom E
		$sheet->getColumnDimension('G')->setAutoSize(true); // Set width kolom E
		$sheet->getColumnDimension('H')->setAutoSize(true); // Set width kolom E
		$sheet->getColumnDimension('I')->setAutoSize(true); // Set width kolom E
		$sheet->getColumnDimension('J')->setAutoSize(true); // Set width kolom E
		$sheet->getColumnDimension('K')->setAutoSize(true); // Set width kolom E
		$writer = new Xlsx($spreadsheet);
		$filename = $json_arr['line_name'] . ' ' . $json_arr['datetimerange'];

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output'); // download file
	}
}
