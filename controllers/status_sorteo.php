<?php

    require('../models/config.php');
    include_once('../models/sorteos.model.php');

    $sorteoModel = new sorteos();

    header("Content-Type: application/json");

    $data = json_decode(file_get_contents('php://input'), true);

    echo $sorteoModel->update_status($data['id'],$data['status']);
?>