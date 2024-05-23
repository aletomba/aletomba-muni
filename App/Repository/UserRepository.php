<?php
include_once 'Model/Usuario.php';
include_once __DIR__ . '/../../Bd/config.php';

class UsuarioRepository {
    private $conn;

    public function __construct() {
        $this->conn = getDbConnection();
    }

    public function getAllUsuarios() {
        $productos = [];
        $sql = "SELECT * FROM usuarios";
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productos[] = new Usuario($row['nombre'], $row['email']);
            }
        }
        return $productos;
    }
    public function create(Usuario $user) {
        $stmt = $this->conn->prepare("INSERT INTO usuarios (nombre, email) VALUES (?, ?)");
        $nombre = $user->getNombre(); 
        $email = $user->getEmail();
        $stmt->bind_param("ss",$nombre, $email);
        $stmt->execute();
    }

    public function findByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function __destruct() {
        $this->conn->close();
    }
}
?>

