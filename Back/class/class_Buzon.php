<?php

class Buzon{
    private $idBuzon;
    private $queja;
    private $fecha;
    private $idColonia;
    private $idQueja;

    public function __construct($idBuzon, $queja, $fecha, $idColonia, $idQueja){
        $this->idBuzon=$idBuzon;
        $this->queja=$queja;
        $this->fecha=$fecha;
        $this->idColonia=$idColonia;
        $this->idQueja=$idQueja;
    }

    public function getIdBuzon(){
        return $this->idBuzon;
    }

    public function setIdBuzon($idBuzon){
        $this->idBuzon=$idBuzon;
        return $this;
    }

    public function getQueja(){
        return $this->queja;
    }

    public function setQueja($queja){
        $this->queja=$queja;
        return $this;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha($fecha){
        $this->fecha=$fecha;
        return $this;
    }

    public function getIdColonia(){
        return $this->idColonia;
    }

    public function setIdColonia($idColonia){
        $this->idColonia=$idColonia;
        return $this;
    }

    public function GetIdQueja(){
        return $this->idQueja;
    }

    public function SetIdQueja($idQueja){
        $this->idQueja=$idQueja;
        return $this;
    }

    public function __toString(){
        return $this->idBuzon." ".$this->queja." ".$this->fecha." ".$this->idColonia." ".$this->idQueja;
    }

    public function GuardarBuzon(){
        $contenidoArchivo = file_get_contents("../data/reportes.json");
        $buzones = json_decode($contenidoArchivo, true);
        $buzones[] = array( 
            "idBuzon" => $this->idBuzon,
            "queja" => $this->queja,
            "fecha" => $this-> fecha,
            "idColonia" => $this->idColonia,
            "idQueja" => $this->idQueja
        );
        $archivo = fopen("../data/reportes.json","w");
        fwrite($archivo, json_encode($buzones));
        fclose($archivo);
    }

    public static function obtenerBuzones(){
        $contenidoArchivo = file_get_contents("../data/reportes.json");
        echo $contenidoArchivo;
    }

    public static function obtenerBuzon($indice){
        $contenidoArchivo = file_get_contents("../data/reportes.json");
        $buzones = json_decode($contenidoArchivo,true);
        echo json_encode($buzones[$indice]);
    }

    public function actualizarBuzon($indice)
    {
        $contenidoArchivo = file_get_contents("../data/reportes.json");
        $buzones = json_decode($contenidoArchivo,true);
        // $usuario = $usuarios[$indice];
        $buzon =  array(
            'idBuzon' => $this->idBuzon,
            'queja' => $this->queja,
            'fecha' => $this-> fecha,
            'idColonia' => $this->idColonia,
            'idQueja' => $this->idQueja
        );
        $buzones[$indice] = $buzon; //sustituye con la nueva informacion en el indice indicado
        $archivo = fopen('../data/reportes.json','w');
        fwrite($archivo, json_encode($buzones));
        fclose($archivo);
    }

    public static function eliminarBuzon($indice){
        $contenidoArchivo = file_get_contents("../data/reportes.json");
        $buzones = json_decode($contenidoArchivo,true);
        array_splice($buzones, $indice, 1);

        $archivo = fopen('../data/reportes.json','w');
        fwrite($archivo, json_encode($buzones));
        fclose($archivo);
    }
}

?>