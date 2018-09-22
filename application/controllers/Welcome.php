<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
class Welcome extends CI_Controller {

	
	public function __construct() {
		parent::__construct();
		$this->load->model('Miniprojek_model');
		$this->load->model('Dashboard_model');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function daftar_kota()
	{
		//$data['contents']= $this->Get_contents->all();
		$this->load->view('v_daftarkota');
	}

	public function add_kota(){
		$data = array(
				'name' => $this->input->post('name'),
				'kode_woeid' => $this->input->post('kode_woeid')
			);
		$insert = $this->Miniprojek_model->save($data);
		if($insert){
			echo json_encode(array("status" => TRUE));
		}
	}

	public function list_kota()
	{
		$list = $this->Miniprojek_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $val) {
			$no++;
			$row = array();
			$row[] = $val->name;
			$row[] = $val->kode_woeid;
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_kota('."'".$val->id."'".')">Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_kota('."'".$val->id."'".')">Delete</i></a>';
		
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Miniprojek_model->count_all(),
						"recordsFiltered" => $this->Miniprojek_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output);
	}

	public function edit_kota($id)
	{
		$data = $this->Miniprojek_model->get_by_id($id);
		if(!empty($data)){
			echo json_encode($data);
		}
	}
	
	public function update_kota()
	{
		$this->load->helper('form');
		$id=$this->input->post('id');
		$data = array(
				'name' => $this->input->post('name'),
				'kode_woeid' => $this->input->post('kode_woeid')
			);
		$status = $this->Miniprojek_model->update($id,$data);
		if($status){
			echo json_encode(array("status" => TRUE));
		}
	}

	public function delete_kota($id)
	{
		$delete = $this->Miniprojek_model->delete_by_id($id);
		if($delete){
			echo json_encode(array("status" => TRUE));
		}
	}

	public function find($target)
	{
		$data = array();
		$find=$this->Miniprojek_model->get_datatables($target);
		foreach($find as $val){
			$row = array();
			$row[]=$val;
			$data[] = $row;
		}
		if(!empty($find)){
			echo json_encode($find);
		}
	}

	public function save_search(){
		date_default_timezone_set('Asia/Jakarta');
		foreach($_POST as $key => $value){
		     $data[$key] = $this->input->post($key);
		}
		$record_parent= json_decode($data['parent'],true);
		$record_cw = json_decode($data['consolidated_weather'],true);
		$result_rp='';
		foreach ($record_parent as $key => $val) {
			$result_rp .= $key.':'.$val.' and ';
		}
		$record= array();
		$record['user_agent'] = $this->agent();
		$record['search'] = $data['title'];
		$record['deskripsi'] = $result_rp .' time :'.$data['time'].' and sunrise:'.$data['sun_rise'].' and sunset :'.$data['sun_set'];
		$record['created_datetime'] = date('Y-m-d H:i:s');
		$insert = $this->Miniprojek_model->save_log_search($record);
		$insert_counter = $this->counter($data['title']);	
		if($insert){
			$last_id= $insert;
			$result_rcw=array();
			foreach ($record_cw as $row) {
				$_insertDetail= array(
					'id_header'=>$last_id,
					'weather_state_name'=>$row['weather_state_name'],
					'weather_state_abbr'=>$row['weather_state_abbr'],
					'wind_direction_compass'=>$row['wind_direction_compass'],
					'created'=>$row['created'],
					'applicable_date'=>$row['applicable_date'],
					'min_temp'=>$row['min_temp'],
					'max_temp'=>$row['max_temp'],
					'the_temp'=>$row['the_temp'],
					'wind_speed'=>$row['wind_speed'],
					'wind_direction'=>$row['wind_direction'],
					'air_pressure'=>$row['air_pressure'],
					'humidity'=>$row['humidity'],
					'visibility'=>$row['visibility'],
					'predictability'=>$row['predictability'],
					'id_consolidated_weather'=>$row['id']
				);
				$this->db->insert('search_log_detail',$_insertDetail);
			}
			echo json_encode(array('status'=>TRUE));
		}
	}

	public function agent(){
		$this->load->library('user_agent');
		if ($this->agent->is_browser())
		{
		        $agent = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
		        $agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
		        $agent = $this->agent->mobile();
		}
		else
		{
		        $agent = 'Unidentified User Agent';
		}
		$result = 'Platform '.$this->agent->platform().'; Browser '.$agent.'; IP:'. $this->input->ip_address();
		return $result;
	}

	public function kota()
	{
		$this->load->view('v_dashboardkota');
	}

	public function dashboard_kota()
	{
		$list = $this->Miniprojek_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $val) {
			$row = array();
			$row[] = $no++;
			$row[] = $val->name;
			$row[] = $val->kode_woeid;
			$row[] = $val->counter;
		
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Miniprojek_model->count_all(),
						"recordsFiltered" => $this->Miniprojek_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output);
	}

	public function counter($title)
	{
		$status=FALSE;
		$data= $this->Miniprojek_model->get_by_title($title);
		if($data){
			$this->db->update('md_kota',array('counter'=>$data->counter+1),array('name'=>$title));
			$status = TRUE;
		}
		return $status;

		
	}

	public function dashboard()
	{
		$this->load->view('v_dashboard');
	}

	public function get_dashboard()
	{
		$list = $this->Dashboard_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$a=1;
		$det='';
		foreach ($list as $val) {
			$no++;
			$det= $val->id.'|'.$val->created_datetime.'|'.$val->search;
			$row = array();
			$row[] = $a++;
			$row[] = $val->search;
			$row[] = $val->user_agent;
			$row[] = $val->deskripsi;
			$row[] = $val->created_datetime;
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Detail" onclick="detail('."'".$det."'".')">Detail</a>';
		
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Dashboard_model->count_all(),
						"recordsFiltered" => $this->Dashboard_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output);
	}

	public function detail_log($id)
	{
		$data=$this->Dashboard_model->get_detail($id);
		echo json_encode($data);
	}

	public function reverse(){
		$this->load->view('v_reverse_geocoding'); 
	}
}
