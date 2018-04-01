<?php

class Category_model extends CI_Model {

    public function listAll() {
        $this->db->select('*');
        $this->db->from('tb_categories');
        $this->db->order_by('descategory', 'ASC');
        return $query = $this->db->get()->result();
    }
    public function getCategory($idcategory) {
        $this->db->select('*');
        $this->db->from('tb_categories');
        $this->db->where('idcategory', $idcategory);
        return $query = $this->db->get()->result();        
    }

    public function salvar() {
        $descategory = $this->input->post("descategory");
        $idcategory;

        $this->db->query("CALL sp_categories_save('$idcategory', '$descategory')");
    }

    public function deletar($idcategory) {
        $this->db->where('idcategory', $idcategory);
        $this->db->delete('tb_categories');
    }
    
    public function atualizar($descategory) {
        $this->descategory = $this->input->post("descategory");

        $this->db->set("descategory", $this->descategory);
        $this->db->where("descategory", $descategory);
        $this->db->update("tb_categories");
    }

}
