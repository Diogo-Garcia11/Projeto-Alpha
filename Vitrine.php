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

    $Matriz=$conexao->prepare("SELECT * FROM tb_produto");

        echo "Pedidos do site:<br><br>"; 
        $Matriz->execute();

        echo "<table border=1>";
        echo "<tr>";
        echo "<td> Id Pedido </td>";
        echo "<td> Data/Hora Do Pedido</td>";
        echo "<td> Valor do Pedido</td>";
        echo "<td> Status do Pedido</td>";
        echo "<td> Id do Cliente</td>";
        echo "<td> Id do Produto</td>";
        
        echo "</tr>";

        while ($Linha = $Matriz -> fetch(PDO:: FETCH_OBJ))
        {
            $idPedido = $Linha -> id_pedido;
            $dataPedido = $Linha -> dta_pedido;
            $valorPedido = $Linha -> valor_pedido;
            $statusPedido = $Linha -> status_pedido;
            $idCliente = $Linha -> id_cliente;
            $id_cliente = $Linha -> id_produto;
            

            echo "<tr>";
            echo "<td>" . $idPedido. "</td>";
            echo "<td>" . $dataPedido. "</td>";
            echo "<td>" . $valorPedido. "</td>";
            echo "<td>" . $statusPedido. "</td>";
            echo "<td>" . $idCliente. "</td>";
            echo "<td>" . $id_cliente. "</td>";
            echo "</tr>";
// id_produto
// nome_prod
// valor_prod
// des_prod
        }
        echo "</table>";
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
