<!DOCTYPE html>
<html lang="pt-br">
<!-- Início do documento HTML. -->
<head>
<!-- Seção head do documento HTML. -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

</head>

<body id="register">
<!-- Seção body do documento HTML. -->
		<div class="container">
			<div class="row main">
				<div class="main-login main-center">
				<h5>Register Here</h5>
					<form class="" method="post" action="#">

						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Username</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="username" id="username"  placeholder="Enter your Username"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="confirm" id="confirm"  placeholder="Confirm your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<input type="submit" name="submit" class="btn btn-primary btn-lg btn-block login-button" value="Registrar">
						</div>

					</form>
				</div>
			</div>
		</div>

		 <!-- jQuery (necessário para os plugins JavaScript do Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Inclui todos os plugins compilados (abaixo) ou inclua arquivos individuais conforme necessário. -->
    <script src="js/bootstrap.min.js"></script>
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

        $sql = "INSERT INTO admin(nm_admin,cd_senha)
                VALUES('$nome','$senha');";

        $conn->exec($sql);

		echo "<script>alert('Cadastrado com sucesso!');</script>";
// Exibe informações para o usuário, como mensagens de erro ou conteúdo HTML.

		header("Location:index.php");
// Redireciona o usuário para outra página.
    } catch (PDOException $e) {
// Captura exceções que possam ocorrer no bloco try.
        echo $sql . "<br>" . $e->getMessage(); 
// Exibe informações para o usuário, como mensagens de erro ou conteúdo HTML.
    }
    $conn = null;
}
?>