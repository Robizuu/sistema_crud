<?php
// Início do código PHP

session_start();
// Inicia uma sessão PHP para manter dados do usuário.

if(isset($_SESSION["nmUser"])){
// Verifica uma condição, por exemplo, validação de sessão ou entrada do usuário.
    include 'conexao.php';
// Inclui outro arquivo PHP, geralmente usado para conexão com o banco ou funcionalidades compartilhadas.

    $id = $_GET['id'];

    try {
// Inicia um bloco try para tratar exceções.
        include 'conexao.php';
// Inclui outro arquivo PHP, geralmente usado para conexão com o banco ou funcionalidades compartilhadas.

        $sql = "DELETE FROM produto WHERE cd_produto='$id'";

        $conn->exec($sql);

    } catch(PDOException $e) {
// Captura exceções que possam ocorrer no bloco try.
        echo $sql . "<br>" . $e->getMessage();
// Exibe informações para o usuário, como mensagens de erro ou conteúdo HTML.
    }

    $conn = null;

    header("location:read.php?sessao={$_SESSION['cdLog']}");
// Redireciona o usuário para outra página.



} else {
    header('location:index.php');
// Redireciona o usuário para outra página.
}

?>