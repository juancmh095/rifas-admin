<?php 

    require('./models/config.php');
    require('./models/sorteos.model.php');

    $sorteosModel = new sorteos();

    $data = $sorteosModel->get_sorteos(null,null);
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
        Nuevo Sorteo
    </button>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="card">
<div class="card-header">
<h3 class="card-title">Tabla de sorteos</h3>
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
        <th>Costo</th>
        <th>Status</th>
        <th>Fecha</th>
        <th>Vendidos</th>
        <th>Apartados</th>
        <th>Apagar</th>
        <th></th>
    </tr>
</thead>
<tbody>
    <?php
        foreach($data as $item){
    ?>
    <tr>
        <td><?php echo $item['sorteo'] ?></td>
        <td><?php echo $item['name'] ?></td>
        <td><?php echo $item['costo'] ?></td>
        <td><?php 
            if($item['status'] == 1){
                ?>
                <span class="badge bg-success">Activo</span>
                <?php
            }else{
                ?>
                <span class="badge bg-danger">Deshabilitado</span>
                <?php
            }
            
        ?></td>
        <td><?php echo $item['inicio'].' - '.$item['final'] ?></td>
        <td><?php echo $item['vendidos'] ?></td>
        <td><?php echo $item['apartados'] ?></td>
        <td><?php 
            if($item['status'] == 1){
                ?>
                <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" onchange="uStatus(event,'status_sorteo',<?php echo $item['id'] ?>,0)">
                <?php
            }else{
                ?>
                <input type="checkbox" name="my-checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success" onchange="uStatus(event,'status_sorteo',<?php echo $item['id'] ?>,1)">
                <?php
            }
            
        ?></td>
        <td>
            <a href="./sorteos_<?php echo $item['id']; ?>" class="btn btn-sm btn-info m-1">
                <i class="fas fa-bars"></i>
            </a>
            <button class="btn btn-sm btn-danger m-1" onclick="deleteItem(event,<?php echo $item['id'] ?>,'sorteo')">
                <i class="fas fa-times"></i>
            </button>
            <button class="btn btn-sm btn-success m-1"  onclick='insertValueTable(event,<?php echo json_encode($item); ?>)'>
                <i class="fas fa-edit"></i>
            </button>
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
        <h5 class="modal-title" id="staticBackdropLabel">Agregar Sorteo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
        </button>
      </div>
      <form onsubmit="submitForm(event,'sorteos')" id="mi_formulario">
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
                        <label for="input2">Costo de boleto</label>
                        <input type="text" class="form-control" id="costo" placeholder="$ 0.00" name="costo" require>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label for="input2">Numero de boletos</label>
                        <input type="text" class="form-control" id="num" placeholder="0" name="num" require>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label for="input2">Cantidad de adicionales</label>
                        <input type="text" class="form-control" id="adicional" placeholder="1,2,3,4..." name="adi" require>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label for="input2">numero de Sorteo</label>
                        <input type="text" class="form-control" id="sorteo" placeholder="xxxx" name="sorteo" require>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label for="input2">Portada</label>
                        <input type="input" class="form-control" id="img" placeholder="" name="img" require>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label for="input2">Fecha Inicio</label>
                        <input type="date" class="form-control" id="inicio" placeholder="$ 0.00" name="inicio" require>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label for="input2">Fecha Fin</label>
                        <input type="date" class="form-control" id="final" placeholder="$ 0.00" name="final">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                        <label for="input2">Descripcion</label>
                        <textarea class="form-control" id="description" cols="30" rows="10" name="desp" require></textarea>
                    </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar Sorteo</button>
            </div>
        </form>        
    </div>
  </div>
</div>


