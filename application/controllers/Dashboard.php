<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends MY_Controller {
 public function index(){ $user=$this->require_login();$this->view('customer/dashboard',array('title'=>'Account overview','accounts'=>$this->Account_model->for_user($user['id']),'balance'=>$this->Account_model->total_balance($user['id']),'transactions'=>$this->Account_model->recent_transactions($user['id'])),'customer'); }
 public function transfers(){ $user=$this->require_login(); $data=array('title'=>'Send money','accounts'=>$this->Account_model->for_user($user['id'])); if($this->input->method()==='post'){$this->session->set_flashdata('notice','Transfer request received and is pending review.');redirect('transfers');}$this->view('customer/transfers',$data,'customer');}
 public function cards(){ $user=$this->require_login();$this->view('customer/cards',array('title'=>'My cards','cards'=>$this->db->get_where('cards',array('user_id'=>$user['id']))->result_array()),'customer');}
 public function profile(){ $this->require_login();$this->view('customer/profile',array('title'=>'My profile'),'customer');}
}
