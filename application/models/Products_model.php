<?php

class Products_model extends CI_Model {

    public function listAll() {
        $this->db->select('*');
        $this->db->from('tb_products');
        $this->db->order_by('desproduct', 'ASC');
        return $query = $this->db->get()->result();
    }

    public function salvar() {
        $idproduct = $this->input->post("idproduct");
        $desproduct = $this->input->post("desproduct");
        $vlprice = $this->input->post("vlprice");
        $vlwidth = $this->input->post("vlwidth");
        $vlheight = $this->input->post("vlheight");
        $vllength = $this->input->post("vllength");
        $vlwight = $this->input->post("vlwight");
        $desurl = $this->input->post("desurl");

        $this->db->query("CALL sp_products_save('$idproduct', '$desproduct','$vlprice','$vlwidth','$vlheight','$vllength','$vlwight','$desurl')");

        $desphoto = $_FILES['desphoto'];
        $this->setPhoto($desphoto, $idproduct);
    }

    public function getProduct($idproduct) {
        $this->db->select('*');
        $this->db->from('tb_products');
        $this->db->where('idproduct', $idproduct);
        return $query = $this->db->get()->result();
    }

    public function deletar($idproduct) {
        $this->db->where('idproduct', $idproduct);
        $this->db->delete('tb_products');
    }

    public function atualizar($idproduct) {
        //$idproduct = $this->input->post("idproduct");
        $desproduct = $this->input->post("desproduct");
        $vlprice = $this->input->post("vlprice");
        $vlwidth = $this->input->post("vlwidth");
        $vlheight = $this->input->post("vlheight");
        $vllength = $this->input->post("vllength");
        $vlweight = $this->input->post("vlweight");
        $desurl = $this->input->post("desurl");

        $this->db->set("desproduct", $desproduct);
        $this->db->set("vlprice", $vlprice);
        $this->db->set("vlwidth", $vlwidth);
        $this->db->set("vlheight", $vlheight);
        $this->db->set("vllength", $vllength);
        $this->db->set("vlweight", $vlweight);
        $this->db->set("desurl", $desurl);

        $this->db->where("idproduct", $idproduct);
        $this->db->update("tb_products");

        $desphoto = $_FILES['desphoto'];

        $this->setPhoto($desphoto, $idproduct);
    }

    public function checkPhoto($idproduct) {
        if (file_exists(
                        "./resources" . DIRECTORY_SEPARATOR .
                        "site" . DIRECTORY_SEPARATOR .
                        "img" . DIRECTORY_SEPARATOR .
                        "products" . DIRECTORY_SEPARATOR .
                        $idproduct . ".jpg")) {

            $url = "./resources/site/img/products/" . $idproduct . ".jpg";
        } else {
            $url = "./resources/site/img/product.jpg";
        }
        return $url;
    }

    public function setPhoto($file, $idproduct) {
        $extension = explode('.', $file['name']);
        $extension = end($extension);

        switch ($extension) {
            case "jpg":
            case "jpeg":
                $image = imagecreatefromjpeg($file["tmp_name"]);
                break;
            case "gif":
                $image = imagecreatefromgif($file["tmp_name"]);
                break;
            case "png":
                $image = imagecreatefrompng($file["tmp_name"]);
                break;
        }

        $dist = "./resources" . DIRECTORY_SEPARATOR .
                "site" . DIRECTORY_SEPARATOR .
                "img" . DIRECTORY_SEPARATOR .
                "products" . DIRECTORY_SEPARATOR .
                $desproduct . ".jpg";
        $dist = "./resources/site/img/products/$idproduct.jpg";

        imagejpeg($image, $dist);
        imagedestroy($image);
    }
    public function getFromUrl($desurl) {
        $this->db->select("*");
        $this->db->from("tb_products");
        $this->db->where("desurl", $desurl);
        return $this->db->get()->result_array();
    }
    public function getCategoriesProducts($id) {
        $this->db->select("*");
        $this->db->from("tb_categories a");
        $this->db->join('tb_productscategories as b', 'a.idcategory = b.idcategory', 'inner');
        $this->db->where("b.idproduct", $id);
        return $this->db->get()->result_array();
    }
}
