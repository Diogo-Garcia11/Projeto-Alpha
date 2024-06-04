<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    
    if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
    {
        include "conexao.php";
        $Botao = $_POST['Botao'];
        //Carrega a tabela
        $Matriz=$conexao->prepare("SELECT * FROM tb_pedido");

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
        }
        echo "</table>";

        if($Botao = "Alterar")
        {
            $Nome = $_POST['Nome'];
            $Endereco = $_POST['Endereco'];
            $Comando = $conexao->prepare("UPDATE nome_cliente, endereco_cliente set nome_cliente=?, endereco_cliente=? FROM tb_cliente WHERE id_cliente =?");

            $Comando->bindParam(1, $Nome);
            $Comando->bindParam(2, $Endereco);
            $Comando->bindParam(3, $idCliente);
        }
        if($Botao = "Voltar")
        {
            header('location:Vitrine.php');
        }
    }

        
    else
    {
    ?>
    <form action="GerPedido.php?valor=enviado" method="post">
    <label for="Nome">Nome:</label>
    <input type="text" name="Nome">
    <label for="Endereco">Endereço:</label>
    <input type="text" name="Endereco">
    <input name="Botao" type="submit" value="Alterar">
    <input name="Botao" type="button" value="Voltar">

    </form>
</body>
</html>
<?php
}
?>
