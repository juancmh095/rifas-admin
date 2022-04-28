<?php 

    $url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $url = explode("_",$url);
    echo $url[1];

    require('./models/config.php');
    require('./models/sorteos.model.php');

    $sorteosModel = new sorteos();

    $presorteos = $sorteosModel->get_pre_sorteos($url[1],null);
    $sorteoInfo = $sorteosModel->get_sorteos($url[1],null);
    $boletosApartados = $sorteosModel->get_compra_boleto($url[1],null);
    


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="assets/img/sorteo.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $sorteoInfo[0]['name'] ?></h3>

                <p class="text-muted text-center"><?php echo $sorteoInfo[0]['description'] ?></p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Información del sorteo</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-money-bill"></i> Costo del Boleto</strong>

                <p class="text-muted">
                    <?php echo $sorteoInfo[0]['costo'] ?>
                </p>

                <hr>

                <strong><i class="fas fa-list mr-1"></i> Numero de boletos</strong>

                <p class="text-muted"><?php echo $sorteoInfo[0]['num'] ?></p>
                <p class="text-muted"><strong>Adicional: </strong><?php echo $sorteoInfo[0]['adicional'] ?></p>

                <hr>

                <strong><i class="fas fa-edit mr-1"></i> Numero de sorteo</strong>

                <p class="text-muted"><?php echo $sorteoInfo[0]['sorteo'] ?></p>

                <hr>

                <strong><i class="far fa-calendar mr-1"></i> Fecha</strong>

                <p class="text-muted"><?php echo $sorteoInfo[0]['inicio'].' - '.$sorteoInfo[0]['final']; ?></p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Pre Sorteos</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Boletos Vendidos</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab" onclick="loadBoletos(event, <?php echo $url[1]; ?>)">Boletos Disponibles</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <button type="button" class="btn btn-success m-1" data-toggle="modal" data-target="#staticBackdrop">
                    Nuevo Pre Sorteo
                </button>
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                      <table class="table table-hover text-nowrap">
                        <thead>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Estatus</th>
                            <th>Fin de presorteo</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php
                                foreach($presorteos as $item){
                            ?>
                                <tr>
                                    <td><?php echo $item['name'] ?></td>
                                    <td><?php echo $item['description'] ?></td>
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
                                    <td><?php echo $item['fin'].' ' .$item['hora'] ?></td>
                                    
                                </tr>
                            <?php
                                }
                            ?>

                        </tbody>
                      </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <th>#</th>
                            <th>Adicionales</th>
                            <th>Estatus</th>
                            <th>Usuario</th>
                            <th>Whatsapp</th>
                            <th>Precio</th>
                            <th>Fecha de venta</th>
                            <th></th>
                        </thead>
                        <tbody>
                        <?php
                            foreach($boletosApartados as $item){
                        ?>
                          <tr>
                            <td><?php echo $item['boleto'] ?></td>
                            <td><?php echo $item['adicional'] ?></td>
                            <td><?php 
                                if($item['status'] == 1){
                                  ?>
                                    <span class="badge bg-success">Pagado</span>
                                    <?php
                                }else{
                                  ?>
                                    <span class="badge bg-danger">Apartado</span>
                                    <?php
                                }
                                
                                ?></td>
                                <td><?php echo $item['user'] ?></td>
                                <td><?php echo $item['whatsapp'] ?></td>
                                <td><?php echo $sorteoInfo[0]['costo'] ?></td>
                                <td><?php echo $item['creacion'] ?></td>
                                <td>
                                  <button type="button" class="btn btn-block bg-gradient-warning btn-sm" onclick="modifyTicket(event, <?php echo $item['id'] ?>,'cancelar',  <?php echo $item['sorteo'] ?>)">Cancelar</button>
                                  <button type="button" class="btn btn-block bg-gradient-success btn-sm" onclick="modifyTicket(event, <?php echo $item['id'] ?>,'pagar',  <?php echo $item['sorteo'] ?>)">Pagado</button>
                                </td>
                          </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>

                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <th>#</th>
                            <th>Adicionales</th>
                        </thead>
                        <tbody id="tdisponible"></tbody>
                    </table>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


  <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar Pre Sorteo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
        </button>
      </div>
      <form onsubmit="submitForm(event,'presorteos')" id="mi_formulario">
            <div class="modal-body"> 
              <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                        <label for="input1">Nombre</label>
                        <input type="text" class="form-control" id="name" placeholder="Nombre del sorteo" name="name" require>
                        <input type="hidden" class="form-control" id="id"  name="id">
                        <input type="hidden" class="form-control" id="sorteo"  name="sorteo" value="<?php echo $url[1] ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label for="input2">Fecha Fin</label>
                        <input type="date" class="form-control" id="fin" placeholder="$ 0.00" name="final">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label for="input2">Hora Fin</label>
                        <input type="time" class="form-control" id="hora" placeholder="$ 0.00" name="hora">
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
                <button type="submit" class="btn btn-primary">Guardar Pre Sorteo</button>
            </div>
        </form>        
    </div>
  </div>
</div>