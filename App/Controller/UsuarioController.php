<?php
require_once 'Repository/UserRepository.php';

class UsuarioController
{
    private $usuarioRepository;
    private $recaptchaSecret = "6Lf_kOUpAAAAAAotUDOOoOv2K8XRYncTZ55Muu67";

    public function __construct()
    {
        $this->usuarioRepository = new UsuarioRepository();
    }

    public function index()
    {       
        require_once "View/Template.php";
    }

    public function obtenerPagina()
    {
        if (isset($_GET['accion'])) {
            $accion = $_GET['accion'];
            return $this->$accion();
        }
    }

    public function mostrarDatos()
    {
        $usuarios = $this->usuarioRepository->getAllUsuarios();
              
        require_once "View/UserView/UserView.php";
    }
    
    public function reg(){
        require_once "View/UserView/UserCreate.php";
    }

    public function register()
    {    
        $id = 0;
        $name = $_POST['nombre'];       
        $email = $_POST['email'];
        $recaptchaResponse = $_POST['g-recaptcha-response'];

        try {
            $this->validate($name, $email, $recaptchaResponse);
            $user = new Usuario($id, $name, $email);
            $this->usuarioRepository->create($user);
            echo "¡Usuario registrado con éxito!";
            } 
        catch (Exception $e) {
            echo "Error: " . $e->getMessage();       
        }

        return include_once "View/UserView/UserCreate.php";
    }

   
    public function updateUsuario() {
        $id = $_GET['id'];
        $usuario = $this->usuarioRepository->getUsuarioById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $recaptchaResponse = $_POST['g-recaptcha-response'];
            $usuario->setNombre($nombre);
            $usuario->setEmail($email);

            try {
                $this->validateRecaptcha($recaptchaResponse);                           
                $user = new Usuario($id,$nombre, $email);
                if ($this->usuarioRepository->update($user)) {
                    echo "¡Usuario actualizado con éxito!";
                    exit();
                }             
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }

           
        }

       return include "View/UserView/UserCreate.php";
    }

    public function deleteUsuario() {
        $id = $_GET['id'];
        if ($this->usuarioRepository->delete($id)) {
            echo "¡Usuario eliminado con éxito!";
            exit();
        }
    }

    private function validate($name, $email,$recaptchaResponse) {
        if (empty($name) || empty($email)) {
            throw new Exception("Todos los campos son obligatorios.");
        }
        
        if (!preg_match("/^[a-zA-Z]+$/", $name)) {
            throw new Exception("El nombre solo puede contener letras.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Formato de correo electrónico no válido.");
        }

        if ($this->usuarioRepository->findByEmail($email)) {
            throw new Exception("El correo electrónico ya está en uso.");
        }
        $this-> validateRecaptcha($recaptchaResponse);
      
    }

    private function validateRecaptcha($recaptchaResponse)
    {
        if(empty($recaptchaResponse)){
            throw new Exception("Todos los campos son obligatorios.");
        }
        $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $response = file_get_contents($recaptchaUrl . '?secret=' . $this->recaptchaSecret . '&response=' . $recaptchaResponse);
        $responseKeys = json_decode($response, true);
        if (intval($responseKeys["success"]) !== 1) {
            throw new Exception("La validación de reCAPTCHA falló. Por favor, inténtelo de nuevo.");
        }
    }
}
?>


