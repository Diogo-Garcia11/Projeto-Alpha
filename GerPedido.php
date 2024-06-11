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
        $Nome = $_POST['Nome'];
        $Endereco = $_POST['Endereco'];
        $Botao = $_POST['Botao'];
        if($Botao == "Alterar")
        {
            include "conexao.php";
            $Comando = $conexao->prepare("UPDATE tb_cliente set nome_cliente=?, endereco_cliente=? WHERE id_cliente =?");
            $Comando->bindParam(1, $Nome);
            $Comando->bindParam(2, $Endereco);
            $Comando->bindParam(3, $_SESSION['idCliente']);
            if($Comando-> execute()){

                if($Comando-> rowCount() > 0)
                {
                    echo "<script> alert('Dados alterados com sucesso');</script>";
                    header('location:Vitrine.php');
                    
                }
                else
                {
                    echo "<script> alert('Erro ao achar o usuário');</script>";
                }
            }  
        }
        
        else if($Botao == "Voltar para a Vitrine")
        {
            header('location:Vitrine.php');
        }
    }
    else
    { 
        include "conexao.php";
        //Carrega a tabela
        $Matriz=$conexao->prepare("SELECT * FROM tb_pedido");

        echo "Pedidos do site:<br><br>"; 
        $Matriz->execute();

        echo "<table border=1>";
        echo "<tr>";
        echo "<td> Id do Pedido </td>";
        echo "<td> Data/Hora Do Pedido</td>";
        echo "<td> Forma de Pagamento do Pedido</td>";
        echo "<td> Condição de Pagamento do Pedido</td>";
        echo "<td> Valor de Cada Parcela do Pedido</td>";
        echo "<td> Valor do Pedido</td>";
        echo "<td> Id do Cliente</td>";
        echo "<td> Id do Produto</td>";
        echo "</tr>";

        while ($Linha = $Matriz -> fetch(PDO:: FETCH_OBJ))
        {
            $idPedido = $Linha -> id_pedido;
            $dataPedido = $Linha -> dta_pedido;
            $formaPgto = $Linha -> formapgto_pedido;
            $condicaoPgto = $Linha -> condicaopgto_pedido;
            $valorParcela = $Linha -> valorparcela_pedido;
            $valorPedido = $Linha -> valor_pedido;
            $idCliente = $Linha -> id_cliente;
            $idProduto = $Linha -> id_produto;
            

            echo "<tr>";
            echo "<td>" . $idPedido. "</td>";
            echo "<td>" . $dataPedido. "</td>";
            echo "<td>" . $formaPgto. "</td>";
            echo "<td>" . $condicaoPgto. "</td>";
            echo "<td>" . $valorParcela. "</td>";
            echo "<td>" . $valorPedido. "</td>";
            echo "<td>" . $idCliente. "</td>";
            echo "<td>" . $idProduto. "</td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>
    <form action="GerPedido.php?valor=enviado" method="post">
    <p>Preencha caso deseje alterar seu nome e endereço do cadastro</p>
    <label for="Nome">Nome:</label>
    <input type="text" name="Nome"><br><br>
    <label for="Endereco">Endereço:</label>
    <input type="text" name="Endereco"><br><br>
    <input name="Botao" type="submit" value="Alterar"><br><br>
    <input name="Botao" type="submit" value="Voltar para a Vitrine">

    </form>
</body>
</html>
<?php
}
?>
