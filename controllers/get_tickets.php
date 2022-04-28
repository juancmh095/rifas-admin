<?php

    require('../models/config.php');
    include_once('../models/sorteos.model.php');

    $sorteoModel = new sorteos();

    header("Content-Type: application/json");

    $data = json_decode(file_get_contents('php://input'), true);

    $sorteo = $sorteoModel->get_sorteos($data['sorteo'],null);

    $ticketsCompra = $sorteoModel->get_tikets_compra($sorteo[0]['id']);

    $comprados = array();

    foreach($ticketsCompra as $item){
        array_push($comprados,intval($item['boleto']));
    };

    $numTickets = intval($sorteo[0]['num']);
    $numAdicional = intval($sorteo[0]['adicional']);
    $tickets = array();
    
    for ($i=0; $i < $numTickets; $i++) { 
        $adicionales = array();
        if(!in_array($i,$comprados)){
            /* crear adicionales */
            for ($x=1; $x <= intval($sorteo[0]['adicional']); $x++) { 
                # code...
                $b = ($x * $numTickets) + 1 + $i;

                array_push($adicionales,$b);
            }

            $ticket = array('ticket'=>$i,'adicionales'=>$adicionales);

            array_push($tickets, $ticket);
        }

    }

    $response = array('tickets'=>$tickets);

    echo json_encode($response);

?>