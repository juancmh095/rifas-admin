<?php

    $collector->get("/", function(){
        return './views/dashboard.php';
    });

    $collector->get("/home", function(){
        return './views/dashboard.php';
    });
    
    $collector->get("/usuarios", function(){
        return './views/usuarios/usuarios_add.php';
    });

    $collector->get("/sorteos", function(){
        return './views/sorteos/sorteo_list.php';
    });

    $collector->get("/sorteos_{id}", function($id){
        echo $id;
        return './views/sorteos/sorteo_detalle.php';
    });

    /* a-------------------- */
    
    
    
?>