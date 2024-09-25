<?php
// app/views/View.php

class View {
    public static function render($data) {
        header("Content-Type: application/json; charset=UTF-8");
        echo $data;
    }
}
?>