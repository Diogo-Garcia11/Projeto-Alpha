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

    $Botão = $_POST['Enviar'];

    $_SESSION['Nome'] = $_POST['Nome'];
    $_SESSION['Endereco'] = $_POST['Endereco'];
    $_SESSION['Valor'] = $_POST['Valor'];

    $ValorParcela = $_SESSION['Valor'] / $_SESSION['CondicaoPgto'];

    if($Botão == "Valor da Compra")
    {
        echo "Nome: ".$_SESSION['Nome']."<br>";
        echo "Endereço: ".$_SESSION['Endereco']."<br>";
        echo "Forma de Pagamento: ".$_SESSION['FormaPgto']."<br>";
        echo "Condição de pagamento(Quantidade de Parcelas): ".$_SESSION['CondicaoPgto']."<br>";
        echo "Valor da Parcela: ".$_SESSION['ValorParcela']."<br>";
        echo "Valor do pedido: ".$$_SESSION['Valor']."<br>";
        
        
    }
}


else{
?>
    <form action="Pedido.php?valor=enviado"  method="post">
    
    <input type="submit"  name="Enviar" value="Valor da Compra">
    </form>
</body>
</html>
<?php
}
?>