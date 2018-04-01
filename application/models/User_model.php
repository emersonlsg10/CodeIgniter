<?php

class User_model extends CI_Model {

    const SECRET = "HcodePhp7_Secret";

    public function buscarDados($login) {
        $this->db->where("deslogin", $login);
        $this->db->from("tb_users");
        return $results = $this->db->get()->row();
    }

    public function listAll() {
        $this->db->select('*');
        $this->db->from('tb_users');
        $this->db->join('tb_persons', 'idperson', 'inner');
        return $query = $this->db->get()->result();
    }

    public function save() {
        $this->desperson = $this->input->post("desperson");
        $this->deslogin = $this->input->post("deslogin");
        $this->despassword = $this->input->post("despassword");
        $this->desemail = $this->input->post("desemail");
        $this->nrphone = $this->input->post("nrphone");
        $this->inadmin = $this->input->post("inadmin");

        $this->db->query("CALL sp_users_save('$this->desperson', '$this->deslogin', '$this->despassword', '$this->desemail', '$this->nrphone', '$this->inadmin')");
    }

    public function get($iduser) {
        $this->db->select('*');
        $this->db->from('tb_users');
        $this->db->join('tb_persons', 'idperson', 'inner');
        $this->db->where("iduser", $iduser);
        return $this->db->get()->result_array();
    }

    public function getPassword($iduser) {
        $this->db->select("despassword");
        $this->db->from('tb_users');
        $this->db->where("iduser", $iduser);
        return $this->db->get()->row();
    }

    public function update($iduser) {
        $this->desperson = $this->input->post("desperson");
        $this->deslogin = $this->input->post("deslogin");
        $this->despassword = $this->getPassword($iduser);
        $this->desemail = $this->input->post("desemail");
        $this->nrphone = $this->input->post("nrphone");
        $this->inadmin = $this->input->post("inadmin");

        $this->db->query("CALL sp_usersupdate_save('$iduser', '$this->desperson', '$this->deslogin', '$this->despassword', '$this->desemail', '$this->nrphone', '$this->inadmin')");
    }

    public function deletar($iduser) {
        $this->db->query("CALL sp_users_delete('$iduser')");
    }

    public function getEmail() {
        $this->email = $this->input->post("email");

        $this->db->select('*');
        $this->db->from('tb_persons');
        $this->db->join('tb_users', 'idperson', 'inner');
        $this->db->where("desemail", $this->email);
        $results = $this->db->get()->result_array();

        if (count($results) === 0) {
            throw new Exception("Não foi possível recuperar a senha!");
        } else {
            $data = $results[0];
            $iduser = $data['iduser'];
            $desip = $_SERVER["REMOTE_ADDR"];

            $results2 = $this->db->query("CALL sp_userspasswordsrecoveries_create('$iduser' , '$desip')");
        }

        if (count($results2) === 0) {
            throw new Exception("Não foi possível recuperar a senha!");
        } else {
            //$dataRecovery = $results2[0];

            $code = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, User_model::SECRET, /*$dataRecovery['idrecovery']*/ 14, MCRYPT_MODE_ECB));

            $link = base_url("forgot/reset/?code=$code");

            $mailer = new PHPMailer($data["desemail"], $data["desperson"], "Redefinir Senha da HCode Store", "forgot", array(
                "name" => $data["desperson"],
                "link" => $link
            ));

            $mailer->send();

            return $data;
        }
    }

}
