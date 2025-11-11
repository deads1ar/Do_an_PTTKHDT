<?php
if($current_page == "ketquatimkiem.php")
    echo'<h3 style="text-align:center; margin-bottom: 10px;">KẾT QUẢ TÌM KIẾM</h3>';
else {
    $header = "";
    if($product == "Nike")
        $header = "NIKE";
    else if($product == "Jordan")
        $header = "JORDAN";
    else if($product == "Adidas")
        $header = "ADIDAS";
    else if($product == "New Balance")
        $header = "NEW BALANCE";
    else if($product == "")
        $header = "SẢN PHẨM";
    echo'<h3 style="text-align:center; margin-bottom: 10px;">' . $header . '</h3>';
}
?>