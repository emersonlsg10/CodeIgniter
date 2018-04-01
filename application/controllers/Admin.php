<?php

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("user_model", "user");
        $this->load->library("controle_acesso");
        $this->controle_acesso->controlar();
    }

    public function index() {
        $this->template->load("template/template_admin", "contents_admin/index");
    }

    public function users() {
        $result['users'] = $this->user->listAll();
        $this->template->load("template/template_admin", "contents_admin/users", $result);
    }

    public function usersCreate() {
        $this->template->load("template/template_admin", "contents_admin/users-create");
    }

    public function usersUpdate($iduser) {
        $result = $this->user->get($iduser);
        $dados = array('desperson' => $result[0]['desperson'],
            'iduser' => $result[0]['iduser'],
            'deslogin' => $result[0]['deslogin'],
            'despassword' => $result[0]['despassword'],
            'inadmin' => $result[0]['inadmin'],
            'desemail' => $result[0]['desemail'],
            'nrphone' => $result[0]['nrphone']);

        $this->template->load("template/template_admin", "contents_admin/users-update", $dados);
    }

    public function delete($iduser) {
        $this->user->deletar($iduser);
        redirect("admin/users");
    }
    
    public function update($iduser) {
        $this->user->update($iduser);
        $_POST["inadmin"] = (isset($_POST["inadmin"]) ? 1 : 0);
        redirect("admin/users");
    }

    public function usersSave() {
        $_POST["inadmin"] = (isset($_POST["inadmin"]) ? 1 : 0);
        $this->user->save();
        redirect("admin/users");
    }

}
