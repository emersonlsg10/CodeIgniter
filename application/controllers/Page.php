<?php

class Page extends CI_Controller {

    private $data;

    function __construct() {
        parent::__construct();
        $this->load->model("Category_model", "category");
        $this->load->model("Products_model", "products");
        $this->data['categories'] = $this->category->listAll();
        $this->data['products'] = $this->products->listAll();
    }

    public function index() {
        $this->template->load("template/template_site", "contents_site/index", $this->data);
    }
    public function category($id) {
        $result = $this->category->getCategory($id);
        $this->data['descategory'] = $result[0]->descategory;
        
       $this->template->load("template/template_site", "contents_site/category", $this->data);
    }

}
