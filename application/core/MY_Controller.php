<?php defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
 protected function view($template, $data=array(), $layout='public') { $data['content']=$template; $this->load->view('layouts/'.$layout,$data); }
 protected function require_login($role=NULL) { $user=$this->session->userdata('user'); if(!$user || ($role && $user['role']!==$role)) { redirect($role==='manager'?'admin/login':'login'); } if($user['role']==='customer'){ $record=$this->db->select('status')->get_where('users',array('id'=>$user['id']))->row_array(); if(!$record || $record['status']!=='active'){ $this->session->sess_destroy(); redirect('login'); }} return $user; }
}
