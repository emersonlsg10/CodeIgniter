<?php
class Page extends CI_Controller{
    public function index() {
        $this->template->load("template/template_site","contents/index"); 
    }
}

