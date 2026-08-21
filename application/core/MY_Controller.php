<?php defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
 protected function view($template, $data=array(), $layout='public') { $data['content']=$template; $this->load->view('layouts/'.$layout,$data); }
 protected function require_login($role=NULL) { $user=$this->session->userdata('user'); if(!$user || ($role && $user['role']!==$role)) { redirect($role==='manager'?'admin/login':'login'); } return $user; }
}
