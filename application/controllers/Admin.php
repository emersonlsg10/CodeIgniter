<?php
class Admin extends CI_Controller{
    public function index() {
        $this->template->load("template/template_admin","contents_admin/index"); 
    }
}
