<?php 
/*class Conexion{   
    public  function conectar() {        
        define('servidor', 'localhost');
        define('nombre_bd', 'curso');
        define('usuario', 'root');
        define('password', '');                         
        $opciones=array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');          
        try{
            $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_bd, usuario, password,$opciones);            
            return $conexion;
        }catch (Exception $e){
            die("El error de Conexión es: ". $e->getMessage());
        }
    }
}*/

class Conexion{
        private $servidor;
        private $usuario;
        private $contrasena;
        private $basedatos;
        public $conexion;
        public function __construct(){
            $this->servidor = "localhost";
            $this->usuario = "root";
            $this->contrasena = "";
            $this->basedatos = "curso";
        }
        function conectar(){
            $this->conexion = new mysqli($this->servidor,$this->usuario,$this->contrasena,$this->basedatos);
            $this->conexion->set_charset("utf8");
        }
        function cerrar(){
            $this->conexion->close();   
        }
    }

/*     class Conexion {
    private $DB_HOST = 'localhost';
    private $DB_USER = 'root';
    private $DB_PASS = '';
    private $DB_NAME = 'curso';
    private $conexion;

    public function __construct()
    {
        $conecting= "mysql:host=$this->DB_HOST;dbname=$this->DB_NAME; charset = utf8";
        try {
            $this->conexion = new PDO($conecting,$this->DB_USER,$this->DB_PASS);
            $this->conexion ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            // echo "COnexion exitosa";
        }catch(PDOException $e) {
            $this->conexion ="Error de conexion";
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }  */  

?>