 

<?php 

class conexion{	
	
  public $base_datos;
  public $servidor;
  public $usuario;
  public $contrasena;
  public $DB_CHARSET;
  public $conect;
	
  protected $_db;

   public function __construct() 
	{ 
		 $base_datos = 'hindudb';
  		 $servidor = 'localhost';
		 $usuario = 'root'; 
		 $contrasena = '';
		 $DB_CHARSET = "utf8";
		/*$base_datos = 'u407191127_hindu';
  		 $servidor = 'mysql.hostinger.co';
		 $usuario = 'u407191127_root'; 
		 $contrasena = 'palacio2018';
		 $DB_CHARSET = "utf8";*/
		
		$this->_db = mysqli_connect($servidor, $usuario, $contrasena, $base_datos); 

		if ( $this->_db->connect_errno ) 
		{ 
			echo "Fallo al conectar a MySQL: ". $this->_db->connect_error; 
			return;     
		} 

		$this->_db->set_charset($DB_CHARSET); 
		
	}
	
  public function consulta($consulta){ 
      //echo $consulta;
      $resultado = mysqli_query($this->_db, $consulta);
	  
      if(!$resultado){ 
      	echo 'MySQL Error consulta ' . $consulta;
      	exit;
      }
	 
      return $resultado;
	  
  }
	
  public function fetch_array($consulta){
	  return mysqli_fetch_array($consulta);
  }
	
  public function cantFilas($consulta){
	  $resultado = $this->consulta($consulta);
	  return mysqli_num_rows($resultado);
  }
	
  
}

?>
