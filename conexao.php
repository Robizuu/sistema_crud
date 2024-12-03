<?php
// Início do código PHP


$servername = "localhost";
$username = "root";
$password = "";

try {
// Inicia um bloco try para tratar exceções.
    $conn = new PDO("mysql:host=$servername;", $username, $password);
// Cria um objeto PDO para conectar ao banco de dados.
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $exists = $conn->prepare("CREATE DATABASE IF NOT EXISTS banco");
// Prepara uma declaração SQL para execução.
    $exists->execute();
// Executa uma declaração SQL preparada.

    $conn = new PDO("mysql:host=$servername;dbname=banco", $username, $password);
// Cria um objeto PDO para conectar ao banco de dados.
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if($exists) {
// Verifica uma condição, por exemplo, validação de sessão ou entrada do usuário.
        $createTableAdmin = $conn->prepare("CREATE TABLE IF NOT EXISTS ADMIN  (
-- Prepara uma declaração SQL para execução.
            cd_admin integer primary key auto_increment,
            nm_admin varchar(50) NOT NULL,
            cd_senha varchar(255) NOT NULL)");


        $createTableProduto = $conn->prepare("CREATE TABLE IF NOT EXISTS PRODUTO  (
-- Prepara uma declaração SQL para execução.
            cd_produto integer primary key auto_increment,
            nm_produto varchar(100) NOT NULL,
            vl_produto DECIMAL(10,2) NOT NULL,
            img_produto varchar(200));");

        $createRegisterAdmin1 = $conn->prepare("INSERT IGNORE INTO ADMIN (cd_admin, nm_admin, cd_senha) VALUES (38, 'administrador', '1234')");
// Prepara uma declaração SQL para execução.
        $createRegisterAdmin2 = $conn->prepare("INSERT IGNORE INTO ADMIN (cd_admin, nm_admin, cd_senha) VALUES (69, 'admin', 'senha')");
// Prepara uma declaração SQL para execução.
        $createRegisterProduto1 = $conn->prepare("INSERT IGNORE INTO PRODUTO (cd_produto, nm_produto, vl_produto, img_produto) VALUES (50, 'Salame Aurora', 30, 'imagens/salame_aurora.webp')");
// Prepara uma declaração SQL para execução.
        $createRegisterProduto2 = $conn->prepare("INSERT IGNORE INTO PRODUTO (cd_produto, nm_produto, vl_produto, img_produto) VALUES (51, 'Margarina Qualy', 6, 'https://brf--c.na149.content.force.com/servlet/servlet.ImageServer?id=0154w000024Tt41&oid=00D410000012TJa&lastMod=1653421725000')");
// Prepara uma declaração SQL para execução.
        $createRegisterProduto3 = $conn->prepare("INSERT IGNORE INTO PRODUTO (cd_produto, nm_produto, vl_produto, img_produto) VALUES (52, 'Pão de Forma Bauducco', 8, 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQTVbih667i9ysGp4AfY25VS_qMizGn34REpPrQxSMOqkA27TABGDtbVpAG808jlVdkDTz4ombzyION9qEciPFolXUntt18FketOOp5J05y4GrN9bbQ37e3&usqp=CAE')");
// Prepara uma declaração SQL para execução.



            $createTableAdmin->execute();
// Executa uma declaração SQL preparada.
            $createTableProduto->execute();
// Executa uma declaração SQL preparada.
            $createRegisterAdmin1->execute();
// Executa uma declaração SQL preparada.
            $createRegisterAdmin2->execute();
// Executa uma declaração SQL preparada.
            $createRegisterProduto1->execute();
// Executa uma declaração SQL preparada.
            $createRegisterProduto2->execute();
// Executa uma declaração SQL preparada.
            $createRegisterProduto3->execute();
// Executa uma declaração SQL preparada.

        }
} catch(PDOException $e) {
// Captura exceções que possam ocorrer no bloco try.
    echo "Connection failed: " . $e ->getMessage();
// Exibe informações para o usuário, como mensagens de erro ou conteúdo HTML.
}
?>