
var url = '../rifas/';

async function submitForm(e,controller) {
    e.preventDefault();
    console.log('se envia formulario');
    var onForm = $('#mi_formulario').serializeArray();
    var model = {};
  
    onForm.forEach(element => {
      model[element.name] = element.value;
    });
    console.log(model);
    await httpRequestPost(model,controller);
    
  }

  function httpRequestPost(data,controller){
    axios({
        method: 'post',
        url: './controllers/'+controller + '.php',
        data: data
      }).then(function (response) {
        console.log(response);
     
      /*   $.notify(response.data); */
        var resp = JSON.parse(response.data);
        console.log(resp);
        if(resp == true || resp == 1){
          toastr.success("Registrado con exito!!");
          document.getElementById('mi_formulario').reset(); 
          $('#staticBackdrop').modal('hide');
          
        setTimeout(() => {
            window.location.reload();            
          }, 1000); 
        }else if(resp == false){
          toastr.warning("Error al guardar!!");
        }else{

          toastr.warning("El producto ya esta agregado!!");
        }

      });
}

function loadBoletos(e,sorteo){
  e.preventDefault();
  var data = {
    sorteo: sorteo
  };

  console.log(data);
  axios({
    method: 'post',
    url: './controllers/get_tickets.php',
    data: data
  }).then(function (response) {
    console.log(response);
 
    var tickets = response.data.tickets;

    var tabla = '';
    var tr = '';

    tickets.forEach(element => {
      tr = tr + '<tr><td>'+element.ticket+'</td><td>'+element.adicionales.toString()+'</td></tr>'    
    });

    var tabla  = tabla + tr + '';

    $('#tdisponible').empty();
    $('#tdisponible').append(tabla);

  });
}

function modifyTicket(e,id, type, sorteo){
  e.preventDefault();
  var data = {
    id: id,
    type: type,
    sorteo: sorteo
  };
  axios({
    method: 'post',
    url: './controllers/modifyTicket.php',
    data: data
  }).then(function (response) {
    console.log(response);
     
      /*   $.notify(response.data); */
        var resp = JSON.parse(response.data);
        console.log(resp);
        if(resp == true || resp == 1){
          toastr.success("Actualizado con exito!!");
          
        setTimeout(() => {
            window.location.reload();            
          }, 1000); 
        }else if(resp == false){
          toastr.warning("Error al guardar!!");
        }else{

          toastr.warning("Error al actualizar!!");
        }

  });

}

function uStatus(e,controller,id,status){
    e.preventDefault();
    console.log('actualizar status');
    var data = {
        id: id,
        status: status,
    };
    console.log(data);
    axios({
        method: 'post',
        url: './controllers/'+controller + '.php',
        data: data
      }).then(function (response) {
        console.log(response);
     
      /*   $.notify(response.data); */
        var resp = JSON.parse(response.data);
        console.log(resp);
        if(resp == true || resp == 1){
          toastr.success("Actualizado con exito!!");
          
        setTimeout(() => {
            window.location.reload();            
          }, 1000); 
        }else if(resp == false){
          toastr.warning("Error al guardar!!");
        }else{

          toastr.warning("Error al actualizar!!");
        }

      });
}

function insertValueTable(e,data){
    e.preventDefault();
    console.log(data);
    var form = data;
    for(var key in form){
        var id = '#'+key;
        console.log(id,form[key]);
        $(id).val(form[key]);            
    };
    $('#staticBackdrop').modal('show');
}

function deleteItem(e,id,tipo){
    var confirm = window.confirm('Confirmar para eliminar registro');
}

async function login(e,controller) {
  e.preventDefault();

  var onForm = $('#mi_formulario').serializeArray();
  var model = {};

  onForm.forEach(element => {
    model[element.name] = element.value;
  });
  console.log(model);

  axios({
    method: 'post',
    url: './controllers/'+controller+'.php',
    data: model
  }).then(function (response) {
    console.log(response);
    var resp = JSON.parse(response.data);
    console.log(resp)
    if(resp.response == 'login' && resp.token){
      console.log(resp);
      var notification = new Notification("Registrado con exito!!");
      document.getElementById('mi_formulario').reset();
      
      setTimeout(() => {
        window.location.href = "./home";            
      }, 1000);
    }else{
      var notification = new Notification(resp.msg);
      toastr.warning("Error de usuario!!");
      alert(resp.msg);
    }
  });
}