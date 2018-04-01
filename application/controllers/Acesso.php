<?php

class Acesso extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("user_model", "user");
    }

    public function index() {
        $this->load->view("login");
    }

    public function entrar() {

        $login = $this->input->post("login");
        $password = $this->input->post("password");

        $query = $this->user->buscarDados($login);

        if (sizeof($query) == 1 && password_verify($password, $query->despassword) === true) {
            $this->session->set_userdata("usuario", $query);
            redirect("admin/index");
        } else {
            redirect("acesso/index");
        }
    }

    public function sair() {
        $this->session->set_userdata("usuario", "");
        $this->session->sess_destroy();
        redirect("acesso/index");
    }
    
    public function forgot() {
        $this->load->view("contents_forgot/forgot");
    }

}
