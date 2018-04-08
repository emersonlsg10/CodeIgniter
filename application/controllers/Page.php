<?php

class Page extends CI_Controller {

    private $data;

    function __construct() {
        parent::__construct();
        $this->load->model("Category_model", "category");
        $this->load->model("Products_model", "products");
        $this->data['products'] = $this->products->listAll();
    }

    public function index() {
        $this->template->load("template/template_site", "contents_site/index", $this->data);
    }

    public function category($id) {
        $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
        $dados = $this->category->getProductsPage($id, $page);
        $dados['descategory'] = $this->category->getCategory($id);
        $dados['categories'] = $this->category->listAll();
        $page = [];
        
        for ($i = 1; $i <= $dados['pages']; $i++) {
            array_push($page, ['link' => $id . '?page=' . $i,
                'page' => $i]);
        }
        $dados['page'] = $page;
//       var_dump($dados);
//        exit;
        $this->template->load("template/template_site", "contents_site/category", $dados);
    }

}
