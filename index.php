<?php
// Início do código PHP

include 'conexao.php';
// Inclui outro arquivo PHP, geralmente usado para conexão com o banco ou funcionalidades compartilhadas.

 if (isset($_COOKIE['usuario'])) {
// Verifica uma condição, por exemplo, validação de sessão ou entrada do usuário.
    $nome_cookie = $_COOKIE['usuario'];
} else {
    $nome_cookie = "";
}

if (!empty($_POST['submit']) && !empty($_POST['username'])) {
// Verifica uma condição, por exemplo, validação de sessão ou entrada do usuário.

     if (!empty($_POST['remember-me'])) {
// Verifica uma condição, por exemplo, validação de sessão ou entrada do usuário.

        $usercookie = $_POST['username'];
        setcookie('usuario', $usercookie, time() + 3600); 
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<!-- Início do documento HTML. -->
<head>
<!-- Seção head do documento HTML. -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

</head>


<body id="login">
<!-- Seção body do documento HTML. -->
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control" value="<?php echo $nome_cookie ?>">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Login">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="register.php" class="text-info">Register here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


<?php
// Início do código PHP
if(!empty($_POST['submit'])) {
// Verifica uma condição, por exemplo, validação de sessão ou entrada do usuário.

    $nome = $_POST['username'];
    $senha = $_POST['password'];


    try {
// Inicia um bloco try para tratar exceções.
        include 'conexao.php';
// Inclui outro arquivo PHP, geralmente usado para conexão com o banco ou funcionalidades compartilhadas.

        $select = $conn->prepare("SELECT nm_admin FROM admin WHERE cd_senha='$senha' AND nm_admin='$nome'");
// Prepara uma declaração SQL para execução.
        $select->execute();
// Executa uma declaração SQL preparada.



        if ($select->rowCount()==1){
// Verifica uma condição, por exemplo, validação de sessão ou entrada do usuário.

            $user = $_POST['username'];

            if (session_status() == PHP_SESSION_NONE) {
// Verifica uma condição, por exemplo, validação de sessão ou entrada do usuário.
                session_start();
// Inicia uma sessão PHP para manter dados do usuário.
            }

            if (!isset($_SESSION['cdLog'])) {
// Verifica uma condição, por exemplo, validação de sessão ou entrada do usuário.
                $numAleatorio = rand(5000000, 100000000);
                $_SESSION['cdLog'] = $numAleatorio;
                $_SESSION['nmUser'] = $user;
                session_start();
// Inicia uma sessão PHP para manter dados do usuário.
            }


            header("Location: interface.php?sessao={$_SESSION['cdLog']}");
// Redireciona o usuário para outra página.



        }

    } catch (PDOException $e) {
// Captura exceções que possam ocorrer no bloco try.
        echo $sql . "<br>" . $e->getMessage(); 
// Exibe informações para o usuário, como mensagens de erro ou conteúdo HTML.
    }
    $conn = null;
}


?>