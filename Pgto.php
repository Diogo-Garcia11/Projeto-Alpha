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

    $Botao = $_POST['Enviar'];

    $_SESSION['Nome'] = $_POST['Nome'];
    $_SESSION['FormaPgto'] = $_POST['Opcao'];
    $_SESSION['CondicaoPgto'] = $_POST['Parcelamento'];
    

    if($Botao == "Confirmar Pagamento")
    {
        header('Location: Pedido.php');
    }

}
else{
?>
    <form action="Pgto.php?valor=enviado"  method="post">
    <label for="Opcao">Selecione a opção de pagamento</label><br>
    <input type="radio" name="Opcao" id="Pix">Pix<br>
    <input type="radio" name="Opcao" id="Cartao">Cartão<br>
    <select name="Parcelamento" id="Parcelamento">
        <option default value="1">Selecione a quantidade de parcelas</option>
        <option value="2">2X</option>
        <option value="4">4X</option>
        <option value="6">6X</option>
        <option value="8">8X</option>
        <option value="10">10X</option>
        <option value="12">12X</option>
    </select><br>
    <input type="submit" name="Enviar" value="Confirmar Pagamento"><br>
    <input type="reset" name="Limpar" value="Limpar"><br>
    </form>
    
    <script>
        document.getElementById('Pix').addEventListener('change', function() 
        {
            if(this.checked) 
            {
                document.getElementById('Parcelamento').style.display = 'none';
                document.getElementById('Parcelamento').value = '1';
            }
        }
    );

        document.getElementById('Cartao').addEventListener('change', function() 
                {
                    if(this.checked) 
                    {
                        document.getElementById('Parcelamento').style.display = '';
                    }
                }
            );
        
    </script>
</body>
</html>
<?php
}
?>