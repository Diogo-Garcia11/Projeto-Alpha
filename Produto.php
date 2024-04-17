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


    else{
    ?>
    <form action="Produto.php?valor=enviado" method="post">
    Valor: <br>
    <input type="text" name="Valor" id="Valor" placeholder="Valor"required><br>
    <input type="text" name="Descricao" id="Descricao" placeholder="Descrição"required><br>
    <input type="submit" name="Enviar" value="Comprar">
    </form>
</body>
</html>
<?php
    }
?>