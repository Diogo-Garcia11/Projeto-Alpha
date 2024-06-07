<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido</title>
</head>
<body>
<?php
session_start();
echo "Nome: ".$_SESSION['Nome']."<br>";
echo "Endereço: ".$_SESSION['Endereco']."<br>";
echo "Forma de Pagamento: ".$_SESSION['FormaPgto']."<br>";
echo "Condição de pagamento(Quantidade de Parcelas): ".$_SESSION['CondicaoPgto']."<br>";
echo "Valor da Parcela: ".$_SESSION['ValorParcela']."<br>";
echo "Valor do pedido: ".$_SESSION['valorProd']."<br>";

if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
{

    if(isset($_POST['Botao']) && ($_POST['Botao'] == 'Gerenciar')) 
    {
        include "conexao.php";

        try
        {
            $Comando2=$conexao->prepare("SELECT id_cliente FROM tb_cliente WHERE  nome_cliente =? and endereco_cliente =?");
            $Comando2->bindParam(1 ,$_SESSION['Nome']);
            $Comando2->bindParam(2 ,$_SESSION['Endereco']);
            $idcliente=$Comando2->fetch(PDO::FETCH_OBJ);
            $_SESSION["idCliente"] = $idcliente;
            date_default_timezone_set('America/Sao_Paulo');
            $DateTimedeagora = date('Y-m-d H:i:s');
            $Comando=$conexao->prepare("INSERT INTO tb_pedido (dta_pedido, formapgto_pedido, condicaopgto_pedido, valorparcela_pedido, valor_pedido,id_cliente,id_produto)VALUES (?,?,?,?,?,?,?)");
                    $Comando->bindParam(1, $DateTimedeagora );
                    $Comando->bindParam(2, $_SESSION['FormaPgto']);
                    $Comando->bindParam(3, $_SESSION['CondicaoPgto']);
                    $Comando->bindParam(4, $_SESSION['ValorParcela']);
                    $Comando->bindParam(5, $_SESSION['valorProd']);
                    $Comando->bindParam(6, $idcliente);
                    $Comando->bindParam(7, $_SESSION["idProd"]);
                    
            if ($Comando->execute())
            {
                if ($Comando->rowCount() >0)
                {
                    echo"<script> alert('Pedido registrado com sucesso!')</script>";
                    echo ('<meta http equiv="refresh"content=0;""Pedido.php">');
                    header('location:GerPedido.php');
                }
                else
                {
                        echo "Erro ao tentar efetivar o pedido.";
                }
            }
            else
            {
                throw new PDOException("Erro: Não foi possível executar a declaração sql.");
            }
        }

        catch (PDOException $erro)
        {
            echo"Erro" . $erro->getMessage();
        }

   
    }

}
else{
?> 
    <form action="Pedido.php?valor=enviado"  method="post">
    <input type="submit" name="Botao"  value="Gerenciar">
    </form>
</body>
</html>
<?php
}
?>