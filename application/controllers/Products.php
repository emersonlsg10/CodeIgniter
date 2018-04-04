<?php

class Products extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("controle_acesso");
        $this->controle_acesso->controlar();
        $this->load->model("Products_model", "products");
    }

    public function index() {
        $data['products'] = $this->products->listAll();
        $this->template->load("template/template_admin", "contents_admin/products", $data);
    }

    public function create() {
        $this->template->load("template/template_admin", "contents_admin/products-create");
    }

    public function save() {
        $this->products->salvar();
        redirect("products/index");
    }

    public function update($idproduct) {
        $result = $this->products->getProduct((int) $idproduct);
        $data['idproduct'] = $result[0]->idproduct;
        $data['desproduct'] = $result[0]->desproduct;
        $data['vlprice'] = $result[0]->vlprice;
        $data['vlwidth'] = $result[0]->vlwidth;
        $data['vlheight'] = $result[0]->vlheight;
        $data['vllength'] = $result[0]->vllength;
        $data['vlweight'] = $result[0]->vlweight;
        $data['desurl'] = $result[0]->desurl;
        $data['desphoto'] = $this->products->checkPhoto($data["idproduct"]);

        $this->template->load("template/template_admin", "contents_admin/products-update", $data);
    }

    public function atualize($idproduct) {
        $this->products->atualizar((int) $idproduct);
        redirect("products/index");
    }

    public function delete($idproduct) {
        $this->products->deletar($idproduct);
        redirect("products/index");
    }

}
