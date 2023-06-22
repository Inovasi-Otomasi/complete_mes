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
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('./assets/excel/TemplateReportv4Exp_3.xlsx', \PhpOffice\PhpSpreadsheet\Reader\IReader::LOAD_WITH_CHARTS);
		// $sheet = $spreadsheet->getActiveSheet();
		// $spreadsheet->getActiveSheet()->getProtection()->setPassword('adminiot');
		// $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
		// $spreadsheet->getActiveSheet()->getProtection()->setSort(true);
		// $spreadsheet->getActiveSheet()->getProtection()->setInsertRows(true);
		// $spreadsheet->getActiveSheet()->getProtection()->setFormatCells(true);
		$sheet = $spreadsheet->getSheetByName('Report OEE');
		$sheet->setCellValue('I8',  $datetimeexplode[0]);
		$sheet->getColumnDimension('H')->setAutoSize(true);
		$sheet->setCellValue('J8',  $datetimeexplode[1]);
		$sheet->getColumnDimension('I')->setAutoSize(true);
		//input line summary
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
			$this->db->select('avg(performance),avg(availability),avg(quality),avg(delta_down_time),max(delta_down_time)');
			$this->db->where('line_name', $data['line_name']);
			if ($json_arr['sku_code'] != 'All') {
				$this->db->where('sku_code', $json_arr['sku_code']);
			}
			$this->db->where('timestamp >=', $datetimestart);
			$this->db->where('timestamp <=', $datetimeend);
			$this->db->from('log_oee');
			$query2 = $this->db->get();
			$row = $query2->row_array();

			$sheet->setCellValue('B' . $numrow, $data['line_name']);
			$sheet->setCellValue('C' . $numrow, $row['avg(availability)']);
			$sheet->setCellValue('D' . $numrow, $row['avg(performance)']);
			$sheet->setCellValue('E' . $numrow, $row['avg(quality)']);
			$sheet->setCellValue('G' . $numrow, $row['avg(delta_down_time)']);
			$sheet->setCellValue('H' . $numrow, $row['max(delta_down_time)']);
			$numrow++;
		}


		//input remark setup
		$this->db->select('*');
		$this->db->from('remark_list');
		$this->db->where('status', 'SETUP');
		$query = $this->db->get();
		$numrow = 11;
		foreach ($query->result_array() as $data) {
			$this->db->select('count(*)');
			$this->db->where('remark', $data['detail']);
			$this->db->where('status', $data['status']);
			$this->db->where('status != prev_status');
			if ($json_arr['line_name'] != 'All') {
				$this->db->where('line_name', $json_arr['line_name']);
			}
			if ($json_arr['sku_code'] != 'All') {
				$this->db->where('sku_code', $json_arr['sku_code']);
			}
			$this->db->where('timestamp >=', $datetimestart);
			$this->db->where('timestamp <=', $datetimeend);
			$this->db->from('log_oee');
			$query2 = $this->db->get();
			$row = $query2->row_array();
			$sheet->setCellValue('J' . $numrow, $data['detail']);
			$sheet->setCellValue('K' . $numrow, $row['count(*)']);
			$numrow++;
		}



		//input remark standby
		$this->db->select('*');
		$this->db->from('remark_list');
		$this->db->where('status', 'STANDBY');
		$query = $this->db->get();
		$numrow = 11;
		foreach ($query->result_array() as $data) {
			$this->db->select('count(*)');
			$this->db->where('remark', $data['detail']);
			$this->db->where('status', $data['status']);
			$this->db->where('status != prev_status');
			if ($json_arr['line_name'] != 'All') {
				$this->db->where('line_name', $json_arr['line_name']);
			}
			if ($json_arr['sku_code'] != 'All') {
				$this->db->where('sku_code', $json_arr['sku_code']);
			}
			$this->db->where('timestamp >=', $datetimestart);
			$this->db->where('timestamp <=', $datetimeend);
			$this->db->from('log_oee');
			$query2 = $this->db->get();
			$row = $query2->row_array();

			$sheet->setCellValue('L' . $numrow, $data['detail']);
			$sheet->setCellValue('M' . $numrow, $row['count(*)']);
			$numrow++;
		}


		//input remark downtime
		$this->db->select('*');
		$this->db->from('remark_list');
		$this->db->where('status', 'DOWN TIME');
		$query = $this->db->get();
		$numrow = 11;
		foreach ($query->result_array() as $data) {
			$this->db->select('count(*)');
			$this->db->where('remark', $data['detail']);
			if ($json_arr['line_name'] != 'All') {
				$this->db->where('line_name', $json_arr['line_name']);
			}
			if ($json_arr['sku_code'] != 'All') {
				$this->db->where('sku_code', $json_arr['sku_code']);
			}
			$this->db->where('timestamp >=', $datetimestart);
			$this->db->where('timestamp <=', $datetimeend);
			$this->db->from('log_oee');
			$query2 = $this->db->get();
			$row = $query2->row_array();

			$sheet->setCellValue('N' . $numrow, $data['detail']);
			$sheet->setCellValue('O' . $numrow, $row['count(*)']);

			$this->db->select('count(*)');
			$this->db->where('remark_2', $data['detail']);
			$this->db->where('status', $data['status']);
			if ($json_arr['line_name'] != 'All') {
				$this->db->where('line_name', $json_arr['line_name']);
			}
			if ($json_arr['sku_code'] != 'All') {
				$this->db->where('sku_code', $json_arr['sku_code']);
			}
			$this->db->where('timestamp >=', $datetimestart);
			$this->db->where('timestamp <=', $datetimeend);
			$this->db->from('log_oee');
			$query2 = $this->db->get();
			$row = $query2->row_array();
			$sheet->setCellValue('P' . $numrow, $data['detail']);
			$sheet->setCellValue('Q' . $numrow, $row['count(*)']);
			$numrow++;
		}


		// $sheet = $spreadsheet->getSheetByName('Sheet3');
		$this->db->select('*');
		if ($json_arr['line_name'] != 'All') {
			$this->db->where('line_name', $json_arr['line_name']);
		}
		if ($json_arr['sku_code'] != 'All') {
			$this->db->where('sku_code', $json_arr['sku_code']);
		}
		$this->db->from('manufacturing_line');
		$query = $this->db->get();
		$numrow = 20;
		foreach ($query->result_array() as $data) {
			$acc_item_counter = 0;
			$acc_ng_count = 0;
			$acc_down_time = 0;
			$acc_run_time = 0;
			$this->db->select("max(acc_item_counter),max(acc_NG_count),max(acc_down_time),max(acc_run_time)");
			$this->db->where('line_name', $data['line_name']);
			if ($json_arr['sku_code'] != 'All') {
				$this->db->where('sku_code', $json_arr['sku_code']);
			}
			$this->db->where('timestamp >=', $datetimestart);
			$this->db->where('timestamp <=', $datetimeend);
			$this->db->group_by('date(timestamp)');
			$this->db->order_by("acc_down_time", "desc");
			$this->db->from('log_oee');
			$query2 = $this->db->get();
			$result2 = $query2->result_array();
			foreach ($result2 as $row) {
				$acc_item_counter += $row['max(acc_item_counter)'];
				$acc_ng_count += $row['max(acc_NG_count)'];
				$acc_down_time += $row['max(acc_down_time)'];
				$acc_run_time += $row['max(acc_run_time)'];
			}

			$sheet->setCellValue('B' . $numrow, $data['line_name']);
			$sheet->setCellValue('C' . $numrow, $acc_item_counter);
			$sheet->setCellValue('D' . $numrow, $acc_ng_count);
			$sheet->setCellValue('E' . $numrow, $acc_down_time);
			$sheet->setCellValue('G' . $numrow, $acc_run_time);
			$numrow++;
		}


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
