<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
    {
        $_SESSION['Valor'] = $_POST['Valor'];
        $_SESSION['Descricao']= $_POST['Descricao'];
        $Botao = $_POST['Enviar'];

        if($Botao == "Comprar")
        {
            header('location:Login.php');
        }
    }


    
    ?>
    <form action="Produto.php?valor=enviado" method="post">
    Valor: <br>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if(isset($_GET['preco1']))
        {
            $preco1 = $_GET['preco1'];
            echo "O preço do Produto é: R$".$preco1
        }

        else(isset($_GET['preco2']))
        {
            $preco2 = $_GET['preco2'];
            echo "O preço do Produto é: R$".$preco2
        }
    }
    
    ?>
    <input type="submit" name="Enviar" value="Comprar">
    </form>
</body>
</html>
<?php
    
?>