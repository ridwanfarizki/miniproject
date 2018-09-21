<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	var $table = 'search_log_header';
	var $column_order = array('user_agent','search','deskripsi','created_datetime',null); 
	var $column_search = array('user_agent','search','deskripsi','created_datetime',); 
	var $order = array('created_datetime' => 'desc');  

	public function __construct()
	{
		parent::__construct();
		
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);
		$i = 0;
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables($target='')
	{
		if(!empty($target)){
			$query = $this->db->select('name,kode_woeid')
			->from($this->table)
			->like('name',$target,'after');
		}else{
			$this->_get_datatables_query();
			if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_detail($id)
	{
		$data= array();
		$sql =$this->db->select('*')
		->from('search_log_detail')
		->where('id_header',$id)
		->get();
		if($sql->num_rows() > 1){
			foreach($sql->result() as $val){
				$data[] = $val;
			}
		}
		return $data;
	}
}
