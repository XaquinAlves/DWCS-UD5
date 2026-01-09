<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Libraries\Permisos;
use Com\Daw2\Models\UsuarioSistemaModel;

class UsuariosSistemaController extends BaseController
{
    public function showChangeUsername(array $input = [], array $errors = []): void
    {
        if ($input === []) {
            $input['usuario'] = $_SESSION['usuario']['nombre'] ?? '';
        }

        $data = array(
            'titulo' => isset($_SESSION['usuario']) ? 'Ajustes de la cuenta ' . $_SESSION['usuario']['nombre'] :
                'Login',
            'breadcrumb' => ['Panel', 'Username'],
            'seccion' => '/login',
            'tituloCard' => 'Campos básicos',
            'errors' => $errors,
            'input' => $input
        );

        $this->
        view->showViews(array('templates/header.view.php', 'cuenta.view.php', 'templates/footer.view.php'), $data);
    }

    public function doChangeUsername(): void
    {
        $errors = [];

        if (isset($_POST['usuario']) && $_POST['usuario'] !== '') {
            if (preg_match('/^[\p{L}0-9]{3,20}$/', $_POST['usuario']) === 0) {
                $errors['usuario'] = 'El nombre de usuario debe contener solo letras y números, 
                                        y tener entre 3 y 20 caracteres';
            } else {
                $model = new UsuarioSistemaModel();
                if ($model->changeName($_SESSION['usuario']['nombre'], $_POST['usuario'])) {
                    $_SESSION['usuario']['nombre'] = $_POST['usuario'];
                } else {
                    $errors['usuario'] = 'Error con la base de datos';
                }
            }
        } else {
            $errors['usuario'] = 'El nombre de usuario es obligatorio';
        }

        if ($errors !== []) {
            $this->showChangeUsername(filter_input_array(INPUT_POST), $errors);
        } else {
            header('location: ' . $_ENV['host.folder']);
        }
    }

    public function showLogin(array $errors = []): void
    {
        $data = [
            'errors' => $errors
        ];

        $this->view->show('login.view.php', $data);
    }

    public function showLoginGoogle(array $errors = []): void
    {
        $data = [
            'errors' => $errors
        ];

        $this->view->showGoogle('login.php', $data);
    }


    public function doLogin(): void
    {
        $errors = [];
        $model = new UsuarioSistemaModel();

        if (isset($_POST['email']) && isset($_POST['pass'])) {
            $user = $model->findUsuario($_POST['email']);
            if ($user && password_verify($_POST['pass'], $user['pass'])) {
                if ($user['baja'] == 0) {
                    session_regenerate_id();
                    $model->updateLastLogin($user['email']);
                    $_SESSION['usuario'] = $user;
                } else {
                    $errors['login'] = "Usuario inactivo";
                }
            } else {
                $errors['login'] = "Datos incorrectos";
            }
        } else {
            $errors['login'] = 'Campo vacío';
        }

        if ($errors !== []) {
            $this->showLogin($errors);
        } else {
            header('location: ' . $_ENV['host.folder']);
        }
    }

    public function getPermisos(int $id_rol): array
    {
        $permisos = [
            'trabajadores' => new Permisos(''),
            'csv' => new Permisos(''),
            'productos' => new Permisos(''),
            'proveedores' => new Permisos(''),
            'categorias' => new Permisos('')
        ];

        return $permisos;
    }

    public function logOut(): void
    {
        session_destroy();
        header('location: ' . $_ENV['host.folder'] . 'login');
    }

    public function doCambiarPass(): void
    {
        $errors = [];
        $model = new UsuarioSistemaModel();

        if (isset($_POST['pass']) && $_POST['pass'] !== '') {
            $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $model->updatePassword($_SESSION['usuario']['email'], $pass);
        } else {
            $errors['pass'] = 'Campo contraseña vacío';
        }

        $this->showChangeUsername([], $errors);
    }

    public function googleLogin(): void
    {
        // Update the following variables
        $google_oauth_client_id = $_ENV['google.client.id'];
        $google_oauth_client_secret = $_ENV['google.client.secret'];
        $google_oauth_redirect_uri = 'http://localhost:8085/login/google-oauth.php';
        $google_oauth_version = 'v3';
        // If the captured code param exists and is valid
        if (isset($_GET['code']) && !empty($_GET['code'])) {
            // Execute cURL request to retrieve the access token
            $params = [
                'code' => $_GET['code'],
                'client_id' => $google_oauth_client_id,
                'client_secret' => $google_oauth_client_secret,
                'redirect_uri' => $google_oauth_redirect_uri,
                'grant_type' => 'authorization_code'
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response, true);
            // Code goes here...
        } else {
            // Define params and redirect to Google Authentication page
            $params = [
                'response_type' => 'code',
                'client_id' => $google_oauth_client_id,
                'redirect_uri' => $google_oauth_redirect_uri,
                'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
                'access_type' => 'offline',
                'prompt' => 'consent'
            ];
            header('Location: https://accounts.google.com/o/oauth2/auth?' . http_build_query($params));
            exit;
        }
        // Make sure access token is valid
        if (isset($response['access_token']) && !empty($response['access_token'])) {
            // Execute cURL request to retrieve the user info associated with the Google account
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/oauth2/' . $google_oauth_version . '/userinfo');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $response['access_token']]);
            $response = curl_exec($ch);
            curl_close($ch);
            $profile = json_decode($response, true);
            // Make sure the profile data exists
            if (isset($profile['email'])) {
                $google_name_parts = [];
                $google_name_parts[] = isset($profile['given_name']) ? preg_replace('/[^\p{L}]/su', '', $profile['given_name']) : '';
                $google_name_parts[] = isset($profile['family_name']) ? preg_replace('/[^\p{L}]/su', '', $profile['family_name']) : '';
                // Code goes here...
            } else {
                exit('Could not retrieve profile information! Please try again later!');
            }
        } else {
            exit('Invalid access token! Please try again later!');
        }
        // Authenticate the user
        session_regenerate_id();
        $_SESSION['google_loggedin'] = true;
        $_SESSION['usuario']['email'] = $profile['email'];
        $_SESSION['usuario']['nombre'] = implode(' ', $google_name_parts);
        $_SESSION['usuario']['id_rol'] = 4;
        $_SESSION['google_picture'] = isset($profile['picture']) ? $profile['picture'] : '';
        header('Location: ' . $_ENV['host.folder']);
    }
}
