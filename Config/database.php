 <?php
     class Database {
        private $conn;
    
        public function __construct() {
            // Datos de conexión a la base de datos
            $servername = "127.0.0.1"; // Nombre del servidor (usualmente "localhost")
            $username = "root"; // Nombre de usuario de la base de datos
            $password = "313227743"; // Contraseña de la base de datos
            $dbname = "tienda_online"; // Nombre de la base de datos
            $port = "3306";
    
            // Crear conexión
            $this->conn = new mysqli($servername, $username, $password, $dbname, $port);
            
    
            // Verificar la conexión
            if ($this->conn->connect_error) {
                die("Conexión fallida: " . $this->conn->connect_error);
            }
    
          //  echo "<h1>Conexión exitosa a la base de datos Master</h1>";
        }
    
        public function conectar() {
            // Devolver la conexión para que pueda ser utilizada en otras partes del código
            return $this->conn;
        }
    } 
 ?>