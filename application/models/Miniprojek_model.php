<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Miniprojek_model extends CI_Model {

	var $table = 'md_kota';
	var $column_order = array('name','kode_woeid','counter',null); 
	var $column_search = array('name','kode_woeid','counter'); 
	var $order = array('name' => 'asc');  

	public function __construct()
	{
		parent::__construct();
		
	}

	public function save($data)
	{
		$status = FALSE;
		if(!empty($data))
		{
			$this->db->insert($this->table,$data);
			$status = TRUE;
		}
		return $status;
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

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			return $query->row();
		}
	}

	public function get_by_title($title)
	{
		$this->db->from($this->table);
		$this->db->where('name',$title);
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			return $query->row();
		}
	}

	public function update($id, $data)
	{
		$status = FALSE;
		$update =$this->db->update($this->table,$data,array('id'=>$id));
		if($update)
		{
			$status = TRUE;
		}
		return $status;
	}

	public function delete_by_id($id)
	{
		$status= FALSE;
		$cek=$this->get_by_id($id);
		if($cek)
		{
			$this->db->where('id', $id);
			$ret=$this->db->delete($this->table);
			if($ret)
			{
				$status=TRUE;
			}
		}
		return $status;
	}

	public function save_log_search($data){
		$status = FALSE;
		$insert= $this->db->insert('search_log_header',$data);
		if($insert){
			$status = TRUE;
			$ret= $this->db->insert_id();
		}
		return $ret;
	}
}
