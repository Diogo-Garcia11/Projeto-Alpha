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

$_SESSION['Nome'] = $_POST['Nome'];
$_SESSION['Endereco'] = $_POST['Endereco'];
$_SESSION['Valor'] = $_POST['Valor'];

echo "<a href='Pedido.php'>Continuar</a>";

}


else{
?>
    <form action="Pgto.php?valor==enviado"  method="post">
    <label for="Opcao">Selecione a opção de pagamento</label>
    <input type="radio" name="Opcao" id="Pix"><br>
    <input type="radio" name="Opcao" id="Cartao"><br>
    <select name="Parcelamento" id="Parcelamento">
        <option default value="1">Selecione a quantidade de parcelas</option>
        <option value="2">2X</option>
        <option value="4">4X</option>
        <option value="6">6X</option>
        <option value="8">8X</option>
        <option value="10">10X</option>
        <option value="12">12X</option>
    </select>
    <input type="submit" name="Enviar" value="Confirmar Endereço"><br>
    <input type="reset" name="Limpar" value="Limpar"><br>
    </form>'
    
    <script>
        var elemento = getElementById("Parcelamento")
        var pagamento = getElementsByName("Opcao").value
        if(pagamento = "Pix")
        {
            elemento.style.display ="block";
        }
        else if(pagamento = "Cartao")
        {
            elemento.style.display ="none";
        }
    </script>
</body>
</html>
<?php
}
?>