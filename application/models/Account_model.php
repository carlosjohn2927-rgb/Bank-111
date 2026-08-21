<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Account_model extends CI_Model {
 public function for_user($user_id){return $this->db->get_where('accounts',array('user_id'=>$user_id))->result_array();}
 public function total_balance($user_id){$row=$this->db->select_sum('balance')->get_where('accounts',array('user_id'=>$user_id))->row();return (float)($row->balance ?: 0);}
 public function recent_transactions($user_id){return $this->db->select('transactions.*')->from('transactions')->join('accounts','accounts.id=transactions.account_id')->where('accounts.user_id',$user_id)->order_by('transactions.created_at','DESC')->limit(8)->get()->result_array();}
 public function admin_count($table,$status=NULL){if($status)$this->db->where('status',$status);return $this->db->count_all_results($table);}
 public function list_with_user($table){return $this->db->select("$table.*, users.first_name, users.last_name, users.email")->from($table)->join('users','users.id='.$table.'.user_id')->order_by($table.'.id','DESC')->get()->result_array();}
}
