<?php

spl_autoload_register(function ($class_name) {
    include __DIR__."../inc/classes/$class_name.php";
});
?>