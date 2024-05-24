
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <form action="index.php?accion=<?php echo isset($usuario) ? 'updateUsuario&id=' . $usuario->getId() : 'register'; ?>" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo isset($usuario) ? $usuario->getNombre() : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo isset($usuario) ? $usuario->getEmail() : ''; ?>" required>
                </div>
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6Lf_kOUpAAAAAMtxXcQAwzORRgrFlY5OI2q62pmh"></div> <!-- reCAPTCHA -->
                </div>
                <?php if (isset($usuario)) { ?>
                    <input type="hidden" name="id" value="<?php echo $usuario->getId(); ?>">
                <?php } ?>
                <button name="btnreg" type="submit" class="btn btn-primary"><?php echo isset($usuario) ? 'Actualizar' : 'Crear'; ?></button>
            </form>
        </div>
    </div>
</div>




    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            
            if (name.trim() === '' || email.trim() === '') {
                alert('Todos los campos son obligatorios.');
                event.preventDefault();
                return false;
            }

            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                alert('Formato de correo electrónico no válido.');
                event.preventDefault();
                return false;
            }
        });
    </script>
</body>

