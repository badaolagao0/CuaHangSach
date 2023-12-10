<?php
    function formatData($prefix, $number) {
        // Sử dụng sprintf để định dạng số theo định dạng mong muốn
        $formattedNumber = sprintf('%02d', $number);
    
        // Kết hợp tiền tố và số đã được định dạng
        $result = $prefix . $formattedNumber;
    
        return $result;
    }
?>