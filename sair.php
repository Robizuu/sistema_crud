
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

if(isset($_SESSION['nmUser']) && (time() - $_SESSION['sessaotime'] > 1800)) {
// Verifica uma condição, por exemplo, validação de sessão ou entrada do usuário.

    session_unset();     
    session_destroy();   
}

header("Location: index.php");
// Redireciona o usuário para outra página.

?>