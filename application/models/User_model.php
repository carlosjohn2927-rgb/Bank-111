<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model {
 public function find_by_email($email){return $this->db->get_where('users',array('email'=>strtolower(trim($email))))->row_array();}
 public function create($data){$data['created_at']=date('Y-m-d H:i:s');$data['password_hash']=password_hash($data['password'],PASSWORD_DEFAULT);unset($data['password']);$this->db->insert('users',$data);return $this->db->insert_id();}
 public function all_customers(){return $this->db->select('id,first_name,last_name,email,phone,country,status,created_at')->where('role','customer')->order_by('id','DESC')->get('users')->result_array();}
 public function count_role($role){return $this->db->where('role',$role)->count_all_results('users');}
}
