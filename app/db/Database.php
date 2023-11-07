<?php
/**
 *
 */
class Database
{
	private $conexion;
	private $resultado;
	// conectar a la BD
	function __construct()
	{
		try {
			$this->conexion=new PDO('mysql: host=localhost; dbname=documents; charset=utf8','root',null);	            		
            
		} catch (PDOException $e) {
			echo $e->getMessage();
			die();
		}
	}
	// declarar los tipos de las variables
	public function bindP($posicion, $valor, $tipo = null)
	{
		if (is_null($tipo)) {
			switch (true) {
				case is_int($valor):
					$tipo=PDO::PARAM_INT;
					break;
				case is_bool($valor):
					$tipo=PDO::PARAM_BOOL;
					break;
				case is_null($valor):
					$tipo=PDO::PARAM_NULL;
					break;

				default:
					$tipo=PDO::PARAM_STR;
					break;
			}
		}
		$this->resultado->bindValue($posicion, $valor, $tipo);
	}
	// colocar la consulta
	public function query($sql='')
	{
		$this->resultado=$this->conexion->prepare($sql);
	}
	// ejecutar la sentencia
	public function execute()
	{
		$this->resultado->execute();
	}
	// mostrar un resultado
	public function show()
	{
		return $this->resultado->fetch(PDO::FETCH_OBJ);
	}
	// mostrar varios resultados
	public function showAll()
	{
		return $this->resultado->fetchAll(PDO::FETCH_OBJ);
	}
	// mostrar cantidad de filas
	public function rowCount()
	{
		return $this->resultado->rowCount();
	}
}

 ?>