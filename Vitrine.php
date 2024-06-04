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

    $Botao = $_POST ["id_produto"];

    if ($Botao == 1)
    {
        header('location:Produto.php?id_produto=1');
    }
    else if ($Botao == 2)
    {
        header('location:Produto.php?id_produto=2');
    }
}
else{
?>
    <form action="Produto.php?valor=enviado" method="post">
    <div style="text-align: center;">
    <h1>Selecione o produto desejado:</h1>
    <button type="submit" name="id_produto" value="1" style="background-image: url('imagens/cameracanon.jpg'); background-size: cover; width: 200px; height: 150px;"></button>
    <button type="submit" name="id_produto" value="2" style="background-image: url('imagens/kindle.jpg'); background-size: cover; width: 200px; height: 150px;"></button>
    </div>
    </form>

</body>
</html>
<?php
}
?>
