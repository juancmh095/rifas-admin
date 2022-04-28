<?php 

    require('./models/config.php');
    require('./models/usuarios.model.php');

    $usuariosModel = new usuarios();

    $data = $usuariosModel->get_usuarios(null,null);
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Listado de sorteos</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <button type="button" class="btn btn-success m-3" data-toggle="modal" data-target="#staticBackdrop">
        Nuevo Usuario
    </button>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="card">
<div class="card-header">
<h3 class="card-title">Tabla de usuarios</h3>
<div class="card-tools">
<div class="input-group input-group-sm" style="width: 150px;">
<input type="text" name="table_search" class="form-control float-right" placeholder="Search">
<div class="input-group-append">
<button type="submit" class="btn btn-default">
<i class="fas fa-search"></i>
</button>
</div>
</div>
</div>
</div>


<div class="card-body table-responsive p-0">
 <table class="table table-hover text-nowrap">
<thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Fecha</th>
        <th></th>
    </tr>
</thead>
<tbody>
    <?php
        foreach($data as $item){
    ?>
    <tr>
        <td><?php echo $item['id'] ?></td>
        <td><?php echo $item['name'] ?></td>
        <td><?php echo $item['email'] ?></td>
        <td><?php echo $item['rol'] ?></td>
        <td><?php echo $item['dateCreacion'] ?></td>
        <td>
        </td>
    </tr>
    <?php 
        }
    ?>
</tbody>
</table>
</div>

</div>
      </div>
    </section>
  </div>

  

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
        </button>
      </div>
      <form onsubmit="submitForm(event,'usuarios')" id="mi_formulario">
            <div class="modal-body"> 
              <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                        <label for="input1">Nombre</label>
                        <input type="text" class="form-control" id="name" placeholder="Nombre del sorteo" name="name" require>
                        <input type="hidden" class="form-control" id="id"  name="id">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label for="input2">Email</label>
                        <input type="text" class="form-control" id="costo" placeholder="@" name="email" require>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label for="input2">Password</label>
                        <input type="password" class="form-control" id="num" placeholder="0" name="password" require>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label for="input2">Rol</label>
                        <select name="rol" id="rol" class="form-control">
                          <option value="admin">Admin</option>
                          <option value="capt">Capturista</option>
                        </select>
                    </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar Usuario</button>
            </div>
        </form>        
    </div>
  </div>
</div>


