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
        session_start();
        include "conexao.php";
        if ($_SESSION['controleResp'] == 'localizado')
        {
            echo "Dados do Contato:<br><br>";
            echo "Nome: <BR>" .  $_SESSION['nomeContato']. '<br>'. '<br>';
            echo "Fone:<BR>" . $_SESSION['foneContato']. '<br>' .'<br>';
            echo "Email:<BR>" .  $_SESSION['emailContato'] . '<br>'. '<br>';
            echo "Assunto: <BR>" .  $_SESSION['assuntoContato'].'<br>'. '<br>';
            echo "Mensagem: <BR>" .  $_SESSION['msgContato'] . '<br>'. '<br>';
            echo "Resposta: <BR>" . $_SESSION['respContato'] . '<br>'. '<br>';
            echo "Cadastro localizado com sucesso:". '<br>' .'<br>';
        }


        else if ($_SESSION['controleResp'] == 'respondido')
        {
            echo "Resposta gravada com sucesso:<br><br>";
        }


        else if ($_SESSION['controleResp'] == 'enviado')
        {
            echo "Resposta enviada com sucesso:<br><br>";
        }

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

        if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado')){
            if($_POST['id_contato']!= "") $_SESSION['idContato'] = $_POST['id_contato'];
            if($_POST['resp_contato'] !="") $_SESSION['respContato'] = $_POST['resp_contato'];
            $Botao = $_POST ['Botao'];

            if($Botao == "Alterar")
            {
                include "alterarcontato.php";
            }
            if($Botao == "Enviar")
            {
                include "respondercontato.php";
            }
            if($Botao == "Localizar")
            {
                include "localizarcontato.php";
            }
        }
    }

    else
    {
    ?>
    <form action="Pedido.php?valor=enviado" method="post">
    
    <input class="button" type="submit" value="Alterar">

    </form>
</body>
</html>
<?php
}
?>
