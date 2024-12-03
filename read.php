<!DOCTYPE html>
<html>
<!-- Início do documento HTML. -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<head>
<!-- Seção head do documento HTML. -->
    <meta charset="UTF-8">
    <title>Sua Página</title>    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body id=read>
<!-- Seção body do documento HTML. -->
<?php
// Início do código PHP
session_start();
// Inicia uma sessão PHP para manter dados do usuário.

if (isset($_SESSION['cdLog'])) {
// Verifica uma condição, por exemplo, validação de sessão ou entrada do usuário.
    $cod1 = $_GET['sessao'];
    $cod2 = $_SESSION['cdLog'];
    if ($cod1 != $cod2) {
// Verifica uma condição, por exemplo, validação de sessão ou entrada do usuário.
        echo "Erro ao logar!";
// Exibe informações para o usuário, como mensagens de erro ou conteúdo HTML.
        exit;
    }
} else {
    echo "Erro ao logar!";
// Exibe informações para o usuário, como mensagens de erro ou conteúdo HTML.
    exit;
}


$_SESSION['sessaotime'] = time();

if (isset($_SESSION['nmUser']) && (time() - $_SESSION['sessaotime'] > 1800)) {
// Verifica uma condição, por exemplo, validação de sessão ou entrada do usuário.
    // A última solicitação foi há mais de 30 minutos
    session_unset();
    session_destroy();
}

try {
// Inicia um bloco try para tratar exceções.
    include 'conexao.php';
// Inclui outro arquivo PHP, geralmente usado para conexão com o banco ou funcionalidades compartilhadas.

    $select = $conn->prepare("SELECT * FROM PRODUTO");
// Prepara uma declaração SQL para execução.
    $select->execute();
// Executa uma declaração SQL preparada.
?>
<br>
<table border='1'>
    <tr>
        <th style="text-align: center; border: 1px solid black;">Código Produto</th>
        <th style="text-align: center; border: 1px solid black;">Nome Produto</th>
        <th style="text-align: center; border: 1px solid black;">Valor Produto</th>
        <th style="text-align: center; border: 1px solid black;">Imagem do produto</th>
        <th colspan="2">Gerenciamento</th>
    </tr>
<?php while($produto = $select->fetch()){ ?>
<!-- Início do código PHP -->
    <tr>
        <td style="text-align: center; border: 1px solid black;"> <?php echo $produto['cd_produto'];  ?> </td>
        <td style="text-align: center; border: 1px solid black;"> <?php echo $produto['nm_produto']; ?> </td>
        <td style="text-align: center; border: 1px solid black;"> <?php echo $produto['vl_produto']; ?> </td>
        <td style="text-align: center; border: 1px solid black;"> <img src  = '<?php echo $produto['img_produto'];?>' width="100" height="100"/> </td>
        <td style="border: 1px solid black;"> <a href="delete.php?id=<?php echo $produto['cd_produto']?>&sessao=<?php echo $_SESSION['cdLog']; ?>">Excluir</a></td>
        <td style="border: 1px solid black;"><a href="update.php?id=<?php echo $produto['cd_produto']?>&sessao=<?php echo $_SESSION['cdLog']; ?>">Editar</a></td>

    </tr> 
<?php } ?>
<!-- Início do código PHP -->
</table>
<a href="interface.php?sessao=<?php echo $_SESSION['cdLog'];?>">Interface</a>
<?php
// Início do código PHP
} catch (PDOException $e) {
// Captura exceções que possam ocorrer no bloco try.
    echo $sql . "<br>" . $e->getMessage(); 
// Exibe informações para o usuário, como mensagens de erro ou conteúdo HTML.
}

$conn = null;
?>
</body>
</html>