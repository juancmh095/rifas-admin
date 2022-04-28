<?php 

class UsuariosController {

	public function index() {
		return '<h1>Lista de usuarios</h1>';
	}

	public function show($name) {
		return '<h1>Detalles del producto: ' . $name . '</h1>';
	}

}

?>