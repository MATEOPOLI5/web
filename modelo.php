<?php
	class OperacionesBd{
		private $servidor="localhost";
		private $usuario="root";
		private $bd="hector";
		private $password="";

public function conexion(){
			$conexion=mysqli_connect($this->servidor,
									 $this->usuario,
									 $this->password,
									 $this->bd);
			return $conexion;
		}
		
public function guardardatos($sql){
$obj=new OperacionesBd;
$conexion=$obj->conexion();
mysqli_query($conexion,$sql);
}

public function mostrardatos($sql){
$obj = new OperacionesBd;
$conexion = $obj->conexion();
$resultado = mysqli_query($conexion, $sql);
return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

public function eliminardatos($sql){
$obj=new OperacionesBd;
$conexion=$obj->conexion();
mysqli_query($conexion,$sql);
	}

public function actualizadatos($sql){
$obj=new OperacionesBd;
$conexion=$obj->conexion();
mysqli_query($conexion,$sql);
}}
?>



