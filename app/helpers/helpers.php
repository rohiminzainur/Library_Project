<?php


    function conver_date1($value) {
        return date('d-M-Y', strtotime($value));
    }

    function convert_date($value) {
        return date('H:i:s - D M Y', strtotime($value));
    }

    function date_diff1($value1, $value2) {
        $value1 = date_create('date_start');

        $value2 = date_create('date_end');

        $diff = date_diff( $value1, $value2);

        return $diff->format("%a");

    }
?>