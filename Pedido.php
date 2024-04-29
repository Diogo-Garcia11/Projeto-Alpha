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
if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
{

    $Botão = $_POST['Enviar'];

    echo "Nome: ".$_SESSION['Nome']."<br>";
    echo "Endereço: ".$_SESSION['Endereco']."<br>";
    echo "Forma de Pagamento: ".$_SESSION['FormaPgto']."<br>";
    echo "Condição de pagamento(Quantidade de Parcelas): ".$_SESSION['CondicaoPgto']."<br>";
    echo "Valor da Parcela: ".$_SESSION['ValorParcela']."<br>";
    echo "Valor do pedido: ".$_SESSION['Valor']."<br>";

    if($Botão == "Gerenciar")
    {
        
        header('location:GerPedido.php');
        
    }
}


else{
?>
    <form action="Pedido.php?valor=enviado"  method="post">
    <input type="submit"  name="Enviar" value="Gerenciar">
    </form>
</body>
</html>
<?php
}
?>