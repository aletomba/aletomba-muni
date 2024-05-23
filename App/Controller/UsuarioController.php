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
        $usuariosView = $usuarios;
        require_once "View/UserView/UserView.php";
    }
    
    public function reg(){
        require_once "View/UserView/UserCreate.php";
    }

    public function register() {
        if (!empty($_POST['btnreg'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $recaptchaResponse = $_POST['g-recaptcha-response'];

            try {
                $this->validate($name, $email, $recaptchaResponse);                
                $user = new Usuario($name, $email);
                $this->usuarioRepository->create($user);
                echo "¡Usuario registrado con éxito!";
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        return include_once "View/UserView/UserCreate.php";
    }

    private function validate($name, $email, $recaptchaResponse) {
        if (empty($name) || empty($email) || empty($recaptchaResponse)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Formato de correo electrónico no válido.");
        }

        if ($this->usuarioRepository->findByEmail($email)) {
            throw new Exception("El correo electrónico ya está en uso.");
        }

        // Validar reCAPTCHA
        $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $response = file_get_contents($recaptchaUrl . '?secret=' . $this->recaptchaSecret . '&response=' . $recaptchaResponse);
        $responseKeys = json_decode($response, true);
        if (intval($responseKeys["success"]) !== 1) {
            throw new Exception("La validación de reCAPTCHA falló. Por favor, inténtelo de nuevo.");
        }
    }
}
?>


