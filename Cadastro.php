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

    if($Botão == "Confirmar Endereço")
    {
        header('location:Pgto.php');
        
    }
    
}
else{
?>
    <form action="Cadastro.php?valor=enviado"  method="post">
    <input type="text" name="Nome" id="Nome" placeholder="Nome" size="35"><br>
    <input type="text" name="Endereco" id="Endereco" placeholder="Endereço"><br>
    <input type="text" name="Valor" id="Valor" placeholder="Valor"><br>
    <input type="submit" name="Enviar" value="Confirmar Endereço"><br>
    <input type="reset" name="Limpar" value="Limpar"><br>
    </form>
</body>
</html>
<?php
}
?>







