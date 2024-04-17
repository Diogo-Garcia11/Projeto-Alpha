<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<?php
session_start();
if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
{

    $Botao = $_POST['Enviar'];
    
    $_SESSION['FormaPgto'] = $_POST['Opcao'];
    $_SESSION['CondicaoPgto'] = $_POST['Parcelamento'];
    

    if($Botao == "Confirmar Pagamento")
    {
        header('location:Pedido.php');
    }

    if (isset($_POST['Parcelamento'])) 
    {
        $Parcelamento = $_POST['Parcelamento'];
        $ValorParcela = $_SESSION['Valor'] / $Parcelamento;
        $_SESSION['ValorParcela'] = $ValorParcela;

        echo $Parcelamento . "<br>";
        echo $ValorParcela. "<br>";
    }
    else
    {
        echo "Selecione a quantidade de parcelas";
    }
    
}
else{
?>
    <form action="Pgto.php?valor=enviado"  method="post">
    <label for="Opcao">Selecione a opção de pagamento</label><br>
    <input type="radio" name="Opcao" id="Pix" value="Pix">Pix<br>
    <input type="radio" name="Opcao" id="Cartao"value="Pix">Cartão<br>
    <select name="Parcelamento" id="Parcelamento">
        <option default value="1">Selecione a quantidade de parcelas</option>
        <option value="2">2X</option>
        <option value="3">3X</option>
        <option value="4">4X</option>
        <option value="5">5X</option>
        <option value="6">6X</option>
        <option value="7">7X</option>
        <option value="8">8X</option>
        <option value="9">9X</option>
        <option value="10">10X</option>
        <option value="11">11X</option>
        <option value="12">12X</option>
    </select><br>

    
    <label for="">Valor de Cada parcela:</label><br>
    <div id="ValorParcela">
        
    </div>

    <label for="">Valor do Produto:</label><br>
    <?php
    
    echo $_SESSION['Valor'];
    ?><br>
    

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
                var Valor = <?php echo $_SESSION['Valor']; ?>;
                var ValorParcela = Valor / 1;
                document.getElementById('ValorParcela').textContent = ValorParcela;
            }
        }
    );
    
    $(document).ready(function(){
        $("#Parcelamento").change(function(){
            var Parcelamento = $(this).val();
            var Valor = <?php echo $_SESSION['Valor']; ?>; // Pega o valor do session pelo php e manda pro javascript
            var ValorParcela = Valor / Parcelamento;
            $("#ValorParcela").text(ValorParcela); // mostra o valor de cada parcela parcela
        });
    });


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