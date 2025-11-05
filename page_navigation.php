        <?php
        $product = isset($product) ? $product : '';
        // Tính toán các trang để hiển thị
        $start_page = max(1, $page - 1); // Trang bắt đầu
        $end_page = min($totalPages, $start_page + 2); // Trang kết thúc (tối đa 3 trang)

        // Điều chỉnh lại $start_page nếu gần cuối
        if ($end_page - $start_page < 2 && $start_page > 1) {
            $start_page = max(1, $end_page - 2);
        }

        // Nút "<<" (về trang đầu)
        if ($page > 1) {
            echo '<a href="' . $current_page . '?page=1' . (isset($product)? '&product=' . $product : '') . (!empty($_GET['keyword']) ? '&keyword=' . urlencode($_GET['keyword']) : '') . (!empty($_GET['brand']) ? '&brand[]=' . implode('&brand[]=', array_map('urlencode', $_GET['brand'])) : '') . (!empty($_GET['min_price']) ? '&min_price=' . urlencode($_GET['min_price']) : '') . (!empty($_GET['max_price']) ? '&max_price=' . urlencode($_GET['max_price']) : '') . '"> << </a>';
        }

        // Hiển thị các số trang (tối đa 3 trang)
        for ($i = $start_page; $i <= $end_page; $i++) {
            if ($i == $page) {
                echo '<a class="active" href="#">' . $i . '</a>';
            } else {
                echo '<a href="' . $current_page . '?page=' . $i . (isset($product)?'&product=' . $product : '') . (!empty($_GET['keyword']) ? '&keyword=' . urlencode($_GET['keyword']) : '') . (!empty($_GET['brand']) ? '&brand[]=' . implode('&brand[]=', array_map('urlencode', $_GET['brand'])) : '') . (!empty($_GET['min_price']) ? '&min_price=' . urlencode($_GET['min_price']) : '') . (!empty($_GET['max_price']) ? '&max_price=' . urlencode($_GET['max_price']) : '') . '">' . $i . '</a>';
            }
        }
        // Nút ">>" (tới trang cuối)
        if ($page < $totalPages) {
            echo '<a href="' . $current_page . '?page=' . $totalPages . (isset($product)? '&product=' . $product : '') . (!empty($_GET['keyword']) ? '&keyword=' . urlencode($_GET['keyword']) : '') . (!empty($_GET['brand']) ? '&brand[]=' . implode('&brand[]=', array_map('urlencode', $_GET['brand'])) : '') . (!empty($_GET['min_price']) ? '&min_price=' . urlencode($_GET['min_price']) : '') . (!empty($_GET['max_price']) ? '&max_price=' . urlencode($_GET['max_price']) : '') . '"> >> </a>';
        }
        ?>
