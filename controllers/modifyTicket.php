<?php

    require('../models/config.php');
    include_once('../models/sorteos.model.php');

    $sorteoModel = new sorteos();

    header("Content-Type: application/json");

    $data = json_decode(file_get_contents('php://input'), true);

    $sorteo = $sorteoModel->get_sorteos($data['sorteo'],null);

    if($data['type'] == 'cancelar'){
        echo $sorteoModel->delete_tikets_compra($data['id']);
        /* borrar el registro de la compra */
        $tApartados = intval($sorteo[0]['apartados']) - 1;
        $sorteoModel->update_apartados($sorteo[0]['id'],$tApartados);
    }
    if($data['type'] == 'pagar'){
        echo $sorteoModel->update_ticket_status($data['id'],1);
        /* modificar los apartados */
        $tApartados = intval($sorteo[0]['apartados']) - 1;
        $sorteoModel->update_apartados($sorteo[0]['id'],$tApartados);
        /* modificar comprados */
        $tPagados = intval($sorteo[0]['vendidos']) + 1;
        $sorteoModel->update_vendidos($sorteo[0]['id'],$tPagados);
    }

?>