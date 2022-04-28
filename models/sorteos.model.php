<?php 


class sorteos
{

    public function add_sorteos ($name,$costo,$desp,$num,$inicio,$final,$adi,$sorteo,$img)
    {
        try{
            $model = new conectar();
            $conexion = $model->conection();
            $sql = "INSERT INTO sorteos(name,costo,description,num,inicio,final,adicional,sorteo,img)VALUES(:name,:costo,:desp,:num,:inicio,:final,:adi,:sorteo,:img);";
            $check = $conexion->prepare($sql);
            $check->bindParam(":name", $name);
            $check->bindParam(":costo", $costo);
            $check->bindParam(":desp", $desp);
            $check->bindParam(":num", $num);
            $check->bindParam(":inicio", $inicio);
            $check->bindParam(":final", $final);
            $check->bindParam(":adi", $adi);
            $check->bindParam(":sorteo", $sorteo);
            $check->bindParam(":img", $img);
            if (!$check) {
                return false;
            } else {
                return $check->execute();
            }
        }catch (\Throwable $th) {
                return false;
                //throw $th;
        }
    }

    public function add_pre_sorteos ($name,$sorteo,$desp,$finaldate,$finaltime)
    {
        try{
            $model = new conectar();
            $conexion = $model->conection();
            $sql = "INSERT INTO sorteos_pre(name,sorteo,description,fin,hora)VALUES(:name,:sorteo,:desp,:final,:finaltime);";
            $check = $conexion->prepare($sql);
            $check->bindParam(":name", $name);
            $check->bindParam(":desp", $desp);
            $check->bindParam(":final", $finaldate);
            $check->bindParam(":finaltime", $finaltime);
            $check->bindParam(":sorteo", $sorteo);
            if (!$check) {
                return false;
            } else {
                return $check->execute();
            }
        }catch (\Throwable $th) {
                return false;
                //throw $th;
        }
    }

    public function update_sorteos ($id,$name,$costo,$desp,$num,$inicio,$final,$adi,$sorteo,$img)
    {
        try{
            $model = new conectar();
            $conexion = $model->conection();
            $sql = "UPDATE sorteos SET name = :name, costo=:costo, description=:desp, num=:num, inicio=:inicio, final=:final, adicional=:adi,sorteo=:sorteo,img=:img WHERE id=:id;";
            $check = $conexion->prepare($sql);
            $check->bindParam(":name", $name);
            $check->bindParam(":id", $id);
            $check->bindParam(":costo", $costo);
            $check->bindParam(":desp", $desp);
            $check->bindParam(":num", $num);
            $check->bindParam(":inicio", $inicio);
            $check->bindParam(":final", $final);
            $check->bindParam(":adi", $adi);
            $check->bindParam(":sorteo", $sorteo);
            $check->bindParam(":img", $img);
            if (!$check) {
                return false;
            } else {
                return $check->execute();
            }
        }catch (\Throwable $th) {
                return false;
                //throw $th;
        }
    }

    public function update_status($id,$status)
    {
        try{
            $model = new conectar();
            $conexion = $model->conection();
            $sql = "UPDATE sorteos SET status=:status WHERE id=:id;";
            $check = $conexion->prepare($sql);
            $check->bindParam(":id", $id);
            $check->bindParam(":status", $status);
            if (!$check) {
                return false;
            } else {
                return $check->execute();
            }
        }catch (\Throwable $th) {
                return false;
                //throw $th;
        }
    }

    public function update_vendidos($id,$vendidos)
    {
        try{
            $model = new conectar();
            $conexion = $model->conection();
            $sql = "UPDATE sorteos SET vendidos=:vendidos WHERE id=:id;";
            $check = $conexion->prepare($sql);
            $check->bindParam(":id", $id);
            $check->bindParam(":vendidos", $vendidos);
            if (!$check) {
                return false;
            } else {
                return $check->execute();
            }
        }catch (\Throwable $th) {
                return false;
                //throw $th;
        }
    }

    public function update_apartados($id,$apartados)
    {
        try{
            $model = new conectar();
            $conexion = $model->conection();
            $sql = "UPDATE sorteos SET apartados=:apartados WHERE id=:id;";
            $check = $conexion->prepare($sql);
            $check->bindParam(":id", $id);
            $check->bindParam(":apartados", $apartados);
            if (!$check) {
                return false;
            } else {
                return $check->execute();
            }
        }catch (\Throwable $th) {
                return false;
                //throw $th;
        }
    }

    public function update_ticket_status($id,$status)
    {
        try{
            $model = new conectar();
            $conexion = $model->conection();
            $sql = "UPDATE compra_boleto SET status=:status WHERE id=:id;";
            $check = $conexion->prepare($sql);
            $check->bindParam(":id", $id);
            $check->bindParam(":status", $status);
            if (!$check) {
                return false;
            } else {
                return $check->execute();
            }
        }catch (\Throwable $th) {
                return false;
                //throw $th;
        }
    }

    public function get_sorteos($id,$status)
        {
            $rows = array();
            $model = new conectar();
            $conexion = $model->conection();
            if($id == null){
                if($status == null){
                    $sql = "SELECT * FROM sorteos;";
                    $check = $conexion->prepare($sql);
                }else{
                    $sql = "SELECT * FROM sorteos WHERE status=:st;";
                    $check = $conexion->prepare($sql);
                    $check->bindParam(':st', $status);
                }
            }else{
                $sql = "SELECT * FROM sorteos WHERE id = :id;";
                $check = $conexion->prepare($sql);
                $check->bindParam(':id', $id);
            }
            $check->execute();
            while ($result = $check->fetch()) {
                $rows[] = $result;
            }
            return $rows;
        }

        public function get_tikets_compra($id)
        {
            $rows = array();
            $model = new conectar();
            $conexion = $model->conection();
            $sql = "SELECT * FROM compra_boleto WHERE sorteo = :id;";
            $check = $conexion->prepare($sql);
            $check->bindParam(':id', $id);
            $check->execute();
            while ($result = $check->fetch()) {
                $rows[] = $result;
            }
            return $rows;
        }

        public function delete_tikets_compra($id)
        {
            $rows = array();
            $model = new conectar();
            $conexion = $model->conection();
            $sql = "DELETE FROM compra_boleto WHERE id = :id;";
            $check = $conexion->prepare($sql);
            $check->bindParam(':id', $id);
            $check->execute();
            if (!$check) {
                return false;
            } else {
                return $check->execute();
            }
        }

        public function get_compra($id,$status)
        {
            $rows = array();
            $model = new conectar();
            $conexion = $model->conection();
            if($id == null){
                if($status == null){
                    $sql = "SELECT * FROM compra;";
                    $check = $conexion->prepare($sql);
                }else{
                    $sql = "SELECT * FROM compra WHERE status=:st;";
                    $check = $conexion->prepare($sql);
                    $check->bindParam(':st', $status);
                }
            }else{
                $sql = "SELECT * FROM compra WHERE sorteo = :id;";
                $check = $conexion->prepare($sql);
                $check->bindParam(':id', $id);
            }
            $check->execute();
            while ($result = $check->fetch()) {
                $rows[] = $result;
            }
            return $rows;
        }

        public function get_compra_boleto($id,$status)
        {
            $rows = array();
            $model = new conectar();
            $conexion = $model->conection();
            if($id == null){
                if($status == null){
                    $sql = "SELECT * FROM compra_boleto;";
                    $check = $conexion->prepare($sql);
                }else{
                    $sql = "SELECT * FROM compra_boleto WHERE status=:st;";
                    $check = $conexion->prepare($sql);
                    $check->bindParam(':st', $status);
                }
            }else{
                $sql = "SELECT cb.*, c.cliente AS user, c.dateCreate AS creacion, c.whatsapp AS whatsapp FROM compra_boleto AS cb, compra AS c WHERE cb.referencia = c.id AND cb.sorteo = :id;";
                $check = $conexion->prepare($sql);
                $check->bindParam(':id', $id);
            }
            $check->execute();
            while ($result = $check->fetch()) {
                $rows[] = $result;
            }
            return $rows;
        }

        public function get_pre_sorteos($id,$status)
        {
            $rows = array();
            $model = new conectar();
            $conexion = $model->conection();
            if($id == null){
                if($status == null){
                    $sql = "SELECT * FROM sorteos_pre;";
                    $check = $conexion->prepare($sql);
                }else{
                    $sql = "SELECT * FROM sorteos_pre WHERE status=:st;";
                    $check = $conexion->prepare($sql);
                    $check->bindParam(':st', $status);
                }
            }else{
                $sql = "SELECT * FROM sorteos_pre WHERE sorteo = :id;";
                $check = $conexion->prepare($sql);
                $check->bindParam(':id', $id);
            }
            $check->execute();
            while ($result = $check->fetch()) {
                $rows[] = $result;
            }
            return $rows;
        }
}

?>