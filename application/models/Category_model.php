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

    public function getProducts($idcategory, $related = true) {
        if ($related === true) {
            $this->db->select("idproduct");
            $this->db->from("tb_productscategories");
            $this->db->where("idcategory", $idcategory);
            $query = $this->db->get()->result_array();

            $result = [];
            $aux = [];
            $a = count($query);
            if ($a === 0) {
                $aux[0] = 0;
            } else {
                for ($i = 0; $i < $a; $i++) {
                    $aux[$i] = (int) $query[$i]['idproduct'];
                }
            }
            $this->db->select("*");
            $this->db->from("tb_products");
            $this->db->where_in("idproduct", $aux);
            array_push($result, $this->db->get()->result());

            return $result;
        } else {
            $query = [];
            $this->db->select("idproduct");
            $this->db->from("tb_productscategories");
            $this->db->where("idcategory", $idcategory);
            $query = $this->db->get()->result_array();

            $result2 = [];
            $aux = [];
            $a = count($query);
            if ($a === 0) {
                $aux[0] = 0;
            } else {
                for ($i = 0; $i < $a; $i++) {
                    $aux[$i] = (int) $query[$i]['idproduct'];
                }
            }
            $this->db->select("*");
            $this->db->from("tb_products");
            $this->db->where_not_in("idproduct", $aux);
            array_push($result2, $this->db->get()->result());
            return $result2;
        }
    }

    public function addProduct() {
        $data = array(
            'idcategory' => $this->input->get("b"),
            'idproduct' => $this->input->get("a")
        );
        $this->db->insert('tb_productscategories', $data);
        return $data['idcategory'];
    }

    public function removeProduct() {
        $data = array(
            'idcategory' => $this->input->get("b"),
            'idproduct' => $this->input->get("a")
        );
        $this->db->where($data);
        $this->db->delete("tb_productscategories");
        return $data['idcategory'];
    }

    public function getProductsPage($idcategory, $page = 1, $itemsPerPage = 4) {
        $start = ($page - 1) * $itemsPerPage;
         //pega os produtos
        $this->db->select("*");
        $this->db->from("tb_products as a");
        $this->db->join('tb_productscategories as b', 'a.idproduct = b.idproduct', 'inner');
        $this->db->join('tb_categories as c', 'c.idcategory = b.idcategory', 'inner');
        $this->db->where('c.idcategory', $idcategory);
        $this->db->limit($itemsPerPage, $start);
        $results = $this->db->get()->result_array();
        
        
        //conta a quantidade de itens
        $this->db->select("COUNT(*)");
        $this->db->from("tb_products as a");
        $this->db->join('tb_productscategories as b', 'a.idproduct = b.idproduct', 'inner');
        $this->db->join('tb_categories as c', 'c.idcategory = b.idcategory', 'inner');
        $this->db->where('c.idcategory', $idcategory);
        $resultsTotal = $this->db->get()->result_array();

        return [
            'data' => $results,
            'total' => (int) $resultsTotal[0]['COUNT(*)'],
            'pages' => ceil((int)$resultsTotal[0]['COUNT(*)'] / $itemsPerPage)
        ];
    }

}
