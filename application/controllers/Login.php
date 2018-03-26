<?php
require_once 'Admin.php';

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("user_model", "user");
    }

    public function index() {
        $this->verificarSessao();
        $this->template->load("template/template_admin","contents_admin/index");
//        $l = new Admin();
//        $l->index();
//        $this->load->view("login");
    }

    public function verificarSessao() {
        if ($this->session->userdata('logado') == false) {
            redirect("login/login");
        }
    }

    public function login() {
        $this->load->view("login");
    }

    public function logar() {
        $login = $this->input->post("login");
        $password = $this->input->post("password");

        $this->db->where("deslogin", $login);
        $this->db->from("tb_users");
//        $this->db->where("despassword", $password);

        $results = $this->db->get()->row();

        if (count($results) === 0) {
            throw new Exception("Usuário/Senha inválidos");
        }

        if (password_verify($password, $results->despassword) === true) {

            $dados['iduser'] = $results->iduser;
            $dados['idperson'] = $results->idperson;
            $dados['login'] = $results->deslogin;
            $dados['logado'] = true;

            $this->session->set_userdata($dados);
            redirect('login/index');
        } else {
            redirect('login/login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

}
