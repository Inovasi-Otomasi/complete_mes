<?php

use phpDocumentor\Reflection\PseudoTypes\True_;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Nick\SecureSpreadsheet\Encrypt;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Export_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function Export($json_arr)
	{

		$datetimeexplode = explode(' to ', $json_arr['datetimerange']);
		// echo $datetimeexplode[0];
		$datetimestart = $datetimeexplode[0];
		$datetimeend = $datetimeexplode[1];

		// var_dump($json_arr['sku_code']);
		// $spreadsheet = new Spreadsheet();
		// $spreadsheet->getSecurity()->setLockWindows(true);
		// $spreadsheet->getSecurity()->setLockStructure(true);
		// $spreadsheet->getSecurity()->setWorkbookPassword("adminiot");
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('./assets/excel/TemplateReportv3.xlsx', \PhpOffice\PhpSpreadsheet\Reader\IReader::LOAD_WITH_CHARTS);
		// $sheet = $spreadsheet->getActiveSheet();
		// $spreadsheet->getActiveSheet()->getProtection()->setPassword('adminiot');
		// $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
		// $spreadsheet->getActiveSheet()->getProtection()->setSort(true);
		// $spreadsheet->getActiveSheet()->getProtection()->setInsertRows(true);
		// $spreadsheet->getActiveSheet()->getProtection()->setFormatCells(true);
		$sheet = $spreadsheet->getSheetByName('Report OEE');
		$sheet->setCellValue('H5',  $datetimeexplode[0]);
		$sheet->getColumnDimension('H')->setAutoSize(true);
		$sheet->setCellValue('I5',  $datetimeexplode[1]);
		$sheet->getColumnDimension('I')->setAutoSize(true);
		//input line name
		$this->db->select('*');
		if ($json_arr['line_name'] != 'All') {
			$this->db->where('line_name', $json_arr['line_name']);
		}
		if ($json_arr['sku_code'] != 'All') {
			$this->db->where('sku_code', $json_arr['sku_code']);
		}
		$this->db->from('manufacturing_line');
		$query = $this->db->get();
		$numrow = 11;
		foreach ($query->result_array() as $data) {
			$sheet->setCellValue('B' . $numrow, $data['line_name']);
			$numrow++;
		}
		//input remark setup
		$this->db->select('*');
		$this->db->from('remark_list');
		$this->db->where('status', 'SETUP');
		$query = $this->db->get();
		$numrow = 12;
		foreach ($query->result_array() as $data) {
			$sheet->setCellValue('N' . $numrow, $data['detail']);
			$sheet->setCellValue('U' . $numrow, $data['detail']);
			$numrow++;
		}
		//input remark standby
		$this->db->select('*');
		$this->db->from('remark_list');
		$this->db->where('status', 'STANDBY');
		$query = $this->db->get();
		$numrow = 12;
		foreach ($query->result_array() as $data) {
			$sheet->setCellValue('J' . $numrow, $data['detail']);
			$sheet->setCellValue('Q' . $numrow, $data['detail']);
			$numrow++;
		}
		//input remark downtime
		$this->db->select('*');
		$this->db->from('remark_list');
		// $this->db->where('status', 'DOWN TIME')->or_where('status', 'SMALL STOP');
		$this->db->where('status', 'DOWN TIME');
		$query = $this->db->get();
		$numrow = 12;
		foreach ($query->result_array() as $data) {
			$sheet->setCellValue('L' . $numrow, $data['detail']);
			$sheet->setCellValue('S' . $numrow, $data['detail']);
			$numrow++;
		}


		$sheet = $spreadsheet->getSheetByName('Worksheet');

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



		$this->db->select('*');
		// $this->db->select('avg(performance),avg(availability),avg(quality)');
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
		$sheet->setCellValue('C' . 3, 'Batch Number');
		$sheet->setCellValue('D' . 3, 'Lot Number');
		$sheet->setCellValue('E' . 3, 'SKU Code');
		$sheet->setCellValue('F' . 3, 'Item Counter');
		$sheet->setCellValue('G' . 3, 'NG Count');
		$sheet->setCellValue('H' . 3, 'Status');
		$sheet->setCellValue('I' . 3, 'Performance');
		$sheet->setCellValue('J' . 3, 'Availability');
		$sheet->setCellValue('K' . 3, 'Quality');
		$sheet->setCellValue('L' . 3, 'Run Time');
		$sheet->setCellValue('M' . 3, 'Down Time');
		$sheet->setCellValue('N' . 3, 'Delta Down Time');
		$sheet->setCellValue('O' . 3, 'PIC Operator');
		$sheet->setCellValue('P' . 3, 'Remark Operator');
		$sheet->setCellValue('Q' . 3, 'Detail Operator');
		$sheet->setCellValue('R' . 3, 'PIC Engineer');
		$sheet->setCellValue('S' . 3, 'Remark Engineer');
		$sheet->setCellValue('T' . 3, 'Detail Engineer');
		$sheet->setCellValue('U' . 3, 'Location');
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
		$sheet->getStyle('L3')->applyFromArray($style_col);
		$sheet->getStyle('M3')->applyFromArray($style_col);
		$sheet->getStyle('N3')->applyFromArray($style_col);
		$sheet->getStyle('O3')->applyFromArray($style_col);
		$sheet->getStyle('P3')->applyFromArray($style_col);
		$sheet->getStyle('Q3')->applyFromArray($style_col);
		$sheet->getStyle('R3')->applyFromArray($style_col);
		$sheet->getStyle('S3')->applyFromArray($style_col);
		$sheet->getStyle('T3')->applyFromArray($style_col);
		$sheet->getStyle('u3')->applyFromArray($style_col);
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach ($query->result_array() as $data) { // Lakukan looping pada variabel siswa
			$sheet->setCellValue('A' . $numrow, $data['timestamp']);
			$sheet->setCellValue('B' . $numrow, $data['line_name']);
			$sheet->setCellValue('C' . $numrow, $data['batch_id']);
			$sheet->setCellValue('D' . $numrow, $data['lot_number']);
			$sheet->setCellValue('E' . $numrow, $data['sku_code']);
			$sheet->setCellValue('F' . $numrow, $data['item_counter']);
			$sheet->setCellValue('G' . $numrow, $data['NG_count']);
			$sheet->setCellValue('H' . $numrow, $data['status']);
			$sheet->setCellValue('I' . $numrow, $data['performance']);
			$sheet->setCellValue('J' . $numrow, $data['availability']);
			$sheet->setCellValue('K' . $numrow, $data['quality']);
			$sheet->setCellValue('L' . $numrow, $data['run_time']);
			$sheet->setCellValue('M' . $numrow, $data['down_time']);
			$sheet->setCellValue('N' . $numrow, $data['delta_down_time']);
			$sheet->setCellValue('O' . $numrow, $data['pic_name']);
			$sheet->setCellValue('P' . $numrow, $data['remark']);
			$sheet->setCellValue('Q' . $numrow, $data['detail']);
			$sheet->setCellValue('R' . $numrow, $data['pic_name_2']);
			$sheet->setCellValue('S' . $numrow, $data['remark_2']);
			$sheet->setCellValue('T' . $numrow, $data['detail_2']);
			$sheet->setCellValue('U' . $numrow, $data['location']);
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
			$sheet->getStyle('L' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('M' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('N' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('O' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('P' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('Q' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('R' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('S' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('T' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('U' . $numrow)->applyFromArray($style_row);

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
		$sheet->getColumnDimension('L')->setAutoSize(true); // Set width kolom E
		$sheet->getColumnDimension('M')->setAutoSize(true); // Set width kolom E
		$sheet->getColumnDimension('N')->setAutoSize(true); // Set width kolom E
		$sheet->getColumnDimension('O')->setAutoSize(true); // Set width kolom E
		$sheet->getColumnDimension('P')->setAutoSize(true); // Set width kolom E
		$sheet->getColumnDimension('Q')->setAutoSize(true); // Set width kolom E
		$sheet->getColumnDimension('R')->setAutoSize(true); // Set width kolom E
		$sheet->getColumnDimension('S')->setAutoSize(true); // Set width kolom E
		$sheet->getColumnDimension('T')->setAutoSize(true); // Set width kolom E
		$sheet->getColumnDimension('U')->setAutoSize(true); // Set width kolom E

		// $writer = new Xlsx($spreadsheet);
		// ob_end_clean();
		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->setIncludeCharts(true);
		$filename = $json_arr['line_name'] . ' ' . $json_arr['datetimerange'];

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output'); // download file
		exit;
	}
}
