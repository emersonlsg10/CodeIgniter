<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2><?php echo $descategory[0]->descategory?></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
    <div class='row'>    
        <?php
        //echo count($data);    var_dump($data);        echo "</br>";      var_dump($pages);      echo "</br>";     var_dump($total);exit;
    for($i = 0; $i < count($data); $i++){    
        echo " <div class='col-md-3 col-sm-6'>";
        echo "<div class='single-shop-product'>";
        echo "<div class='product-upper'>";
        echo "<img src='".base_url("resources/site/img/products/").$data[$i]['idproduct'].".jpg"."' alt=''>";
        echo "</div>";
        echo "<h2><a href='".base_url("index.php/page/product/").$data[$i]['desurl']."'>".$data[$i]['desproduct']."</a></h2>";
        echo "<div class='product-carousel-price>'";
        echo "<ins>".$data[$i]['vlprice']."</ins> <del></del>";
        echo "</div>";
        echo "<div class='product-option-shop'>";
        echo "<a class='add_to_cart_button' data-quantity='1' data-product_sku='' data-product_id='70' rel='nofollow' href='/canvas/shop/?add-to-cart=70'>Comprar</a>";
        echo "</div>"                      
        ."</div>"
        ."</div>";}
        ?>
    </div>

        <div class="row">
            <div class="col-md-12">
                <div class="product-pagination text-center">
                    <nav>
                        <ul class="pagination">
                            <?php
//                                echo count($page);    var_dump($page); exit;
                            for($i = 0; $i< count($page); $i++){
                                echo " <li><a href='". base_url("index.php/page/category/").$page[$i]['link']."'>".$page[$i]['page']."</a></li>";
                            }?>
                          </ul>
                    </nav>                        
                </div>
            </div>
        </div>
    </div>
</div>
