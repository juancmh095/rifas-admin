<?php 


class usuarios
{

    public function add_users($name,$email,$pass,$rol)
    {
        $model = new conectar();
        $conexion = $model->conection();
        $sql = "INSERT INTO users(name,email,password,rol)VALUES(:name,:email,:pass,:rol);";
        $check = $conexion->prepare($sql);
        $check->bindParam(":name", $name);
        $check->bindParam(":email", $email);
        $check->bindParam(":pass", $pass);
        $check->bindParam(":rol", $rol);
        if (!$check) {
            return false;
        } else {
            return $check->execute();
            
        }
    }

    public function get_usuarios($id,$status)
        {
            $rows = array();
            $model = new conectar();
            $conexion = $model->conection();
            if($id == null){
                if($status == null){
                    $sql = "SELECT * FROM users;";
                    $check = $conexion->prepare($sql);
                }else{
                    $sql = "SELECT * FROM users WHERE status=:st;";
                    $check = $conexion->prepare($sql);
                    $check->bindParam(':st', $status);
                }
            }else{
                $sql = "SELECT * FROM usuarios WHERE id = :id;";
                $check = $conexion->prepare($sql);
                $check->bindParam(':id', $id);
            }
            $check->execute();
            while ($result = $check->fetch()) {
                $rows[] = $result;
            }
            return $rows;
        }

        public function login($email,$passwd)
        {
            try {
                //code...
                $rows = array();
                $model = new conectar();
                $conexion = $model->conection();
                $sql = "SELECT * FROM users  WHERE email = :email AND password = :passwd";
                $check = $conexion->prepare($sql);
                $check->bindParam(':email', $email);
                $check->bindParam(':passwd', $passwd);
                $check->execute();
                while ($result = $check->fetch()) {
                    $rows[] = $result;
                }
                return $rows;
            } catch (\Throwable $th) {
                //throw $th;

                return 'false';
            }
        }
}

?>