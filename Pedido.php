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
$valorParcelaFormatado = number_format($_SESSION['ValorParcela'],2);
echo "Valor da Parcela: ".$valorParcelaFormatado."<br>";
echo "Valor do pedido: ".$_SESSION['valorProd']."<br>";

if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
{
    $Botao = $_POST['Botao'];
    if($Botao == "Gerenciar") 
    {
        include "conexao.php";

        try
        {
            date_default_timezone_set('America/Sao_Paulo');
            $DateTimedeagora = date('Y-m-d H:i:s');
            $Comando=$conexao->prepare("INSERT INTO tb_pedido (dta_pedido, formapgto_pedido, condicaopgto_pedido, valorparcela_pedido, valor_pedido,id_cliente,id_produto)VALUES (?,?,?,?,?,?,?)");
                    $Comando->bindParam(1, $DateTimedeagora );
                    $Comando->bindParam(2, $_SESSION['FormaPgto']);
                    $Comando->bindParam(3, $_SESSION['CondicaoPgto']);
                    $Comando->bindParam(4, $_SESSION['ValorParcela']);
                    $Comando->bindParam(5, $_SESSION['valorProd']);
                    $Comando->bindParam(6, $_SESSION["idCliente"]);
                    $Comando->bindParam(7, $_SESSION["idProd"]);
                    
            if ($Comando->execute())
            {
                if ($Comando->rowCount() >0)
                {
                    echo"<script> alert('Pedido registrado com sucesso!')</script>";
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
    <input type="submit" name="Botao" value="Gerenciar">
    </form>
</body>
</html>
<?php
}
?>