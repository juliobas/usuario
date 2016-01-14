<?php
    require_once 'usuario.php';
    require_once 'usuario_modelo.php';
    
    $usuario = new Usuario();
    $usuario_modelo = new UsuarioModelo();
        
    if(isset($_REQUEST['action'])){
        switch ($_REQUEST['action']){
            case 'registrar':
                $usuario->set('nombre', $_REQUEST['nombre']);
                $usuario->set('apellido', $_REQUEST['apellido']);
                $usuario->set('login', $_REQUEST['login']);
                $usuario->set('password', $_REQUEST['password']);
                
                $usuario_modelo->registrar($usuario);
                header('Location: index.php');
                break;
            case 'eliminar':
                $usuario_modelo->eliminar($_REQUEST['id']);
                header('Location: index.php');
                break;
            case 'editar':
                $usuario = $usuario_modelo->buscar($_REQUEST['id']);
                break;
            case 'actualizar':
                $usuario->set('id', $_REQUEST['id']);
                $usuario->set('nombre', $_REQUEST['nombre']);
                $usuario->set('apellido', $_REQUEST['apellido']);
                $usuario->set('login', $_REQUEST['login']);
                $usuario->set('password', $_REQUEST['password']);
                
                $usuario_modelo->actualizar($usuario);
                header('Location: index.php');
                break;
            
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Crud Usuarios</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    
    <body>
        <form action="?action=<?php echo $usuario->get('id') > 0 ? 'actualizar' : 'registrar'; ?>" method="post">
            
            <input type="hidden" name="id" value="<?php echo $usuario->get('id');?>"/>
            <label>Nombre:</label>
            <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $usuario->get('nombre');?>"></br>
            
            <label>Apellido:</label>
            <input type="text" name="apellido" placeholder="Apellido" value="<?php echo $usuario->get('apellido');?>"></br>
            
            <label>Login:</label>
            <input type="text" name="login" placeholder="Login" value="<?php echo $usuario->get('login');?>"></br>
            
            <label>Password:</label>
            <input type="password" name="password" placeholder="Password"></br>
            
            <button type="submit">Guardar</button>
                    
        </form>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Login</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            
            <?php foreach ($usuario_modelo->listar() as $listar): ?>
                <tr>
                    <td><?php echo $listar->get('nombre') ?></td>
                    <td><?php echo $listar->get('apellido') ?></td>
                    <td><?php echo $listar->get('login') ?></td>
                    <td>
                        <a href="?action=editar&id=<?php echo $listar->get('id') ?>">Editar</a>
                    </td>
                    <td>
                        <a href="?action=eliminar&id=<?php echo $listar->get('id') ?>">Eliminar</a>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>
    </body>
    
</html>

