<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends MY_Controller { public function index(){ $this->view('public/home',array('title'=>'Grand Chase | Digital banking')); } public function about(){ $this->view('public/about',array('title'=>'About Grand Chase')); } public function contact(){ $this->view('public/contact',array('title'=>'Contact Grand Chase')); } }
