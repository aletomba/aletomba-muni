
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="registerForm" method="POST" action="">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="email" name="email" required>    
                </div>
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6Lf_kOUpAAAAAMtxXcQAwzORRgrFlY5OI2q62pmh"></div> <!-- reCAPTCHA -->
                </div>
                <button type="submit" class="btn btn-primary" value="register" name="btnreg">Registrar</button>
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

