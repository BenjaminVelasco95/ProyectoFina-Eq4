<?php
header('Content-Type: application/json');
include_once("../class/class_Buzon.php");
include 'conn.php';
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input'), true);
        $buzon = new Buzon($_POST["idBuzon"], $_POST["queja"], $_POST["fecha"], $_POST["idColonia"], $_POST["idQueja"]);
        $buzon->GuardarBuzon();
        $resultado["mensaje"] = "Guardar el reporte, informacion: " . json_encode($_POST);
        echo json_encode($resultado);

        $conexion=new Conexion();
        $consulta=$conexion->prepare("INSERT INTO buzon (queja, fecha, idcolonia, idqueja)
        VALUES(:queja, :fecha, :idcolonia, :idqueja)");
        $consulta->bindParam(":queja",$_GET['queja'],PDO::PARAM_STR);
        $consulta->bindParam(":fecha",$_GET['fecha'],PDO::PARAM_STR);
        $consulta->bindParam(":idcolonia",$_GET['idColonia'],PDO::PARAM_STR);
        $consulta->bindParam(":idqueja",$_GET['idQueja'],PDO::PARAM_STR);
        $consulta->execute();
        break;

    case 'GET': //metodo get: el link obtiene el valor del usuario que se esta solicitando en postman = http://localhost/proyecto/backend/api/usuarios.php?parametro=este_es_el_valor_del_parametro
        if (isset($_GET['idBuzon'])) {
            $resultado["mensaje"] = "Retornar el Buzon con el id: " . $_GET['idBuzon'];
            Buzon::obtenerBuzon($_GET['idBuzon']);
            
        } else {
            Buzon::obtenerBuzones();
        }
        break;

    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input'), true);
        $buzon = new Buzon($_PUT['idBuzon'], $_PUT['queja'], $_PUT['fecha'], $_PUT['idColonia'], $_PUT['idQueja']);
        $buzon ->actualizarBuzon($_GET['idBuzon']);
        $resultado["mensaje"] = "Actualizar un buzon con el id: " . $_GET['idBuzon'] .
                                             ", informacion a actualizar: " . json_encode($_PUT);
        echo json_encode($resultado);

        $conexion=new Conexion();
        $consulta=$conexion->prepare("UPDATE buzon SET queja = :queja, fecha = :fecha, id_colonia = :idColonia, idqueja = :idQueja WHERE  id = :idBuzon");
        $consulta->bindParam(":queja",$_GET['queja'],PDO::PARAM_STR);
        $consulta->bindParam(":fecha",$_GET['fecha'],PDO::PARAM_STR);
        $consulta->bindParam(":idColonia",$_GET['idColonia'],PDO::PARAM_STR);
        $consulta->bindParam(":idQueja",$_GET['idQueja'],PDO::PARAM_STR);
        $consulta->bindParam(":idBuzon",$_GET['idBuzon'],PDO::PARAM_STR);
        $consulta->execute();
        break;

    case 'DELETE':
        Buzon::eliminarBuzon($_GET['idBuzon']);
        $resultado["mensaje"] = "Eliminar un buzon con el id: " . $_GET['idBuzon'];
        echo json_encode($resultado);

        $conexion=new Conexion();
        $consulta=$conexion->prepare("DELETE FROM buzon WHERE id =:idBuzon");
        $consulta->bindParam(":id",$_GET['idBuzon'],PDO::PARAM_STR);
        $consulta->execute();
        break;
}
?>