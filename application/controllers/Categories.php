<?php

class Categories extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("controle_acesso");
        $this->controle_acesso->controlar();
        $this->load->model("Category_model", "category");
    }

    public function index() {
        $data['categories'] = $this->category->listAll();
        $this->template->load("template/template_admin", "contents_admin/categories", $data);
    }

    public function create() {
        $this->template->load("template/template_admin", "contents_admin/categories-create");
    }

    public function save() {
        $this->category->salvar();
        redirect("categories/index");
    }

    public function delete($idcateory) {
        $this->category->deletar($idcateory);
        redirect("categories/index");
    }

    public function update($descategories) {
        $data['descategory'] = $descategories;
        $this->template->load("template/template_admin", "contents_admin/categories-update", $data);
    }

    public function atualize($descategory) {
        $this->category->atualizar($descategory);
        redirect("categories/index");
    }

}
