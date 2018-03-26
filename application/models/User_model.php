<?php

class User_model extends CI_Model {

    var $login;
    var $password;

    public function autenticar() {

        $this->login = $this->input->post("login");
        $this->password = $this->input->post("password");

        $this->db->select("*");
        $this->db->where("deslogin", $this->login);
        $this->db->from("tb_users");

        $results = $this->db->get()->results();

        if (count($results) === 0) {
            throw new Exception("Usuário inexistente ou senha inválida!");
        }

        $data = $results[0];

        if (password_verify($this->password, $data["despassword"]) === true) {

            $this->session->set_userdata("logado", 1);
            redirect(base_url("admin/index"));
        } else {
            //caso a senha/usuário estejam incorretos, então mando o usuário novamente para a tela de login com uma mensagem de erro.
            $dados['erro'] = "Usuário/Senha incorretos";
            $this->load->view("template/login", $dados);
        }
    }
    	public function logout(){
		$this->session->unset_userdata("logado");
		redirect(base_url("login/index"));
		
	}

}
