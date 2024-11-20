<?php 

    class Login {

        public function Restaurar_Password($usuario, $contrasena) {
            $loginModel = new LoginModel();
            $cmd = $loginModel->Restaurar_Password($usuario, $contrasena);
        }

        public function Login_Usuario($usuario, $contrasena) {
            $loginModel = new LoginModel();
            $cmd = $loginModel->Login_Usuario($usuario, $contrasena);
        }

    }
?>
