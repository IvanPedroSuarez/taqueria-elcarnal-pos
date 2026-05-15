<?php
/**
 * Página de Login - Taquería El Carnal
 */
require_once __DIR__ . '/includes/auth.php';

// Si ya está autenticado, redirigir al módulo correspondiente
if (estaAutenticado()) {
    header('Location: ' . obtenerUrlRol($_SESSION['usuario_rol']));
    exit;
}

$error = '';

// Procesar formulario de login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($usuario) || empty($password)) {
        $error = 'Por favor ingresa usuario y contraseña.';
    } else {
        $user = intentarLogin($usuario, $password);
        if ($user) {
            header('Location: ' . obtenerUrlRol($_SESSION['usuario_rol']));
            exit;
        } else {
            $error = 'Usuario o contraseña incorrectos.';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Taquería El Carnal</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body class="pagina-login">
    <div class="login-contenedor">
        <div class="login-card">
            <div class="login-header">
                <span class="login-logo">🌮</span>
                <h1>Taquería El Carnal</h1>
                <p>Sistema de Punto de Venta</p>
            </div>
            
            <?php if ($error): ?>
                <div class="mensaje mensaje-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <form method="POST" action="" class="login-form" id="formLogin">
                <div class="campo">
                    <label for="usuario">👤 Usuario</label>
                    <input type="text" id="usuario" name="usuario" required 
                           value="<?= htmlspecialchars($usuario ?? '') ?>"
                           placeholder="Ingresa tu usuario" autocomplete="username">
                </div>
                <div class="campo">
                    <label for="password">🔒 Contraseña</label>
                    <input type="password" id="password" name="password" required 
                           placeholder="Ingresa tu contraseña" autocomplete="current-password">
                </div>
                <button type="submit" class="btn btn-primario btn-block">Iniciar Sesión</button>
            </form>
            
            <div class="login-footer">
                <p>Accesos de prueba:</p>
                <small>admin / admin &bull; mesero1 / mesero1 &bull; cocina1 / cocina1</small>
            </div>
        </div>
    </div>
</body>
</html>
