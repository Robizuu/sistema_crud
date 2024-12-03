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
    session_unset();
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- Início do documento HTML. -->
<head>
<!-- Seção head do documento HTML. -->
<style>       
 body {      
background-color: #17a2b8;
font-family: Arial, sans-serif;
margin: 0;
padding: 0;
display: flex;
justify-content: center;
align-items: center;
height: 100vh;
}
.container {
background-color: #fff;
padding: 20px;
border-radius: 5px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
text-align: center; } 
a { text-decoration: none; color: #0b6085; } 
a:hover { text-decoration: underline;
.area-restrita {
        background-color: #0b6085;
        color: #fff;
        padding: 10px;
        text-align: center;
        font-size: 16px;
        border-radius: 5px;
    } 
}
</style>  
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- Seção body do documento HTML. -->
<div class="container">
<?php echo '<div class="area-restrita">Área restrita: ' . $_SESSION['nmUser'] . '</div>'; ?><br>
<!-- Início do código PHP -->
    <form method="post" action="#">
        <input type="text" name="nome_produto" placeholder="Nome do Produto" required><br>
        <input type="number" name="preco_produto" placeholder="Preço" required><br>
        <input type="text" name="link_img" placeholder="Link Imagem" required><br><br>
        <input type="submit" name="create" value="Adicionar Produto">
    </form>
<br><br>


<a href="interface.php?sessao=<?php echo $_SESSION['cdLog'];?>">Interface</a>
</div>
</body>

</html>

<?php
// Início do código PHP
if(!empty($_POST['create'])){
// Verifica uma condição, por exemplo, validação de sessão ou entrada do usuário.
    $nome_produto = $_POST['nome_produto'];
    $preco_produto = $_POST['preco_produto'];
    $link_img = $_POST['link_img'];

    try{
// Inicia um bloco try para tratar exceções.

        include 'conexao.php';
// Inclui outro arquivo PHP, geralmente usado para conexão com o banco ou funcionalidades compartilhadas.

        $sql="INSERT INTO PRODUTO(nm_produto,vl_produto,img_produto) VALUES (
            '$nome_produto','$preco_produto','$link_img')";

            $conn->exec($sql);
        echo "Produto inserido com sucesso!";
// Exibe informações para o usuário, como mensagens de erro ou conteúdo HTML.

    }
    catch (PDOException $e) {
// Captura exceções que possam ocorrer no bloco try.
        echo $sql . "<br>" . $e->getMessage(); 
// Exibe informações para o usuário, como mensagens de erro ou conteúdo HTML.
    }
    $conn = null;

}


?>