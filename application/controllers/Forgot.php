<?php

class Forgot extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("user_model", "user");
    }

    public function index() {
        $this->load->view("contents_forgot/forgot");
    }
    
    public function sent() {
        $this->view->load("contents_forgot/forgot-sent"); 
    }

    public function verificaEmail() {
        $this->user->getEmail();
        redirect("forgot/sent");
    }

}
