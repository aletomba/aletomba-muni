<?php
include_once 'Model/Usuario.php';
include_once __DIR__ . '/../../Bd/config.php';

class UsuarioRepository {
    private $conn;

    public function __construct() {
        $this->conn = getDbConnection();
    }

    public function getAllUsuarios() {
        $usuarios = [];
        $sql = "SELECT * FROM usuarios";
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = new Usuario($row ['id'],$row['nombre'], $row['email']);
            }
        }
        return $usuarios;
    }
    public function create(Usuario $user) {
        $stmt = $this->conn->prepare("INSERT INTO usuarios (id,nombre, email) VALUES (?,?, ?)");
        $id = $user->getId();
        $nombre = $user->getNombre(); 
        $email = $user->getEmail();        
        $stmt->bind_param("sss",$id,$nombre, $email);
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

    public function update(Usuario $user) {
        $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $id = $user->getId();
        $nombre = $user->getNombre();
        $email = $user->getEmail();
        $stmt->bind_param("sss", $nombre, $email, $id);
        return $stmt->execute();
    }
    

    public function getUsuarioById($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return new Usuario($row['id'], $row['nombre'], $row['email']);
    }

    public function delete($id) {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }
    
    
}
?>

