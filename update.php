<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<?php
// Início do código PHP


$id = $_GET['id'];

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

try {
// Inicia um bloco try para tratar exceções.

    include 'conexao.php';
// Inclui outro arquivo PHP, geralmente usado para conexão com o banco ou funcionalidades compartilhadas.

    $select = $conn->prepare("SELECT * FROM produto WHERE cd_produto='$id'");
// Prepara uma declaração SQL para execução.
    $select->execute();
// Executa uma declaração SQL preparada.

    if($select->rowCount() == 1) {
// Verifica uma condição, por exemplo, validação de sessão ou entrada do usuário.
        if($produto = $select->fetch()){
// Verifica uma condição, por exemplo, validação de sessão ou entrada do usuário.
?>

<!DOCTYPE html>
<html>
<!-- Início do documento HTML. -->

<head>
<!-- Seção head do documento HTML. -->

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UPDATE PRODUTO</title>
</head>
<body>
<!-- Seção body do documento HTML. -->
<?php echo '<div class="area-restrita">Área restrita: ' . $_SESSION['nmUser'] . '</div>'; ?>
<!-- Início do código PHP -->
    <h1>Editar registros</h1>
    <form method="post" action="#">
        <label>Código Produto:</label>
        <input type="text" name="cd_produto" value="<?php echo $produto['cd_produto']; ?>" disabled><br>
        <label>Nome Produto: &nbsp</label>
        <input type="text" name="nm_produto" maxlength="45" value="<?php echo $produto['nm_produto']; ?>">
        <br>
        <label>Valor Produto:&nbsp&nbsp&nbsp&nbsp</label>
        <input type="number" name="vl_produto"  maxlength="50" value="<?php echo $produto['vl_produto']; ?>">
        <br>
        <label>Link Produto:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
        <input type="text" name="img_produto" value="<?php echo $produto['img_produto']; ?>" ​​​​​​​​​>
        <br>
        <input type="submit" value="Atualizar" name="btnatualizar">
    </form>
</body>
</html>

<?php
// Início do código PHP

            }
        }
    }catch(PDOException $e) {
// Captura exceções que possam ocorrer no bloco try.
        echo $sql . "<br>" . $e->getMessage();
// Exibe informações para o usuário, como mensagens de erro ou conteúdo HTML.
    }

    if(!empty($_POST['btnatualizar'])) {
// Verifica uma condição, por exemplo, validação de sessão ou entrada do usuário.
        $nome = $_POST['nm_produto'];
        $vl_produto = $_POST['vl_produto'];
        $img_produto = $_POST['img_produto'];
        try {
// Inicia um bloco try para tratar exceções.
            include 'conexao.php';
// Inclui outro arquivo PHP, geralmente usado para conexão com o banco ou funcionalidades compartilhadas.

            $sql = "UPDATE PRODUTO SET nm_produto='$nome', vl_produto='$vl_produto', img_produto='$img_produto'
            WHERE cd_produto='$id'";

            $update = $conn->prepare($sql);
// Prepara uma declaração SQL para execução.

            $update->execute();
// Executa uma declaração SQL preparada.

            echo $update->rowCount();
// Exibe informações para o usuário, como mensagens de erro ou conteúdo HTML.
            header("location:read.php?sessao={$_SESSION['cdLog']}");
// Redireciona o usuário para outra página.
        } catch (PDOException $e) {
// Captura exceções que possam ocorrer no bloco try.
            echo $sql . "<br>" . $e->getMessage(); 
// Exibe informações para o usuário, como mensagens de erro ou conteúdo HTML.
        }
    }
    $conn = null;
?>