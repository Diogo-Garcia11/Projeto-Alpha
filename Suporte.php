<!-- essa página não faz parte da atividade, é apenas para ajudar, apagar depois de terminar -->
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
<?php 
session_start();

if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
{
    //  essa página não faz parte da atividade, é apenas para ajudar, apagar depois de terminar
    $Botao = $_POST ["Botao"]; 
    $Opcao = $_POST["opcao"];
           
    if ($Botao == "Parcela")
    {
        echo "Dados do pagmento:<br><br>";
        $Parcela = $_POST["parcela"];
        $Total = $_POST["total"];
        if ($Opcao == "boleto") 
            {
                $ValorParcela = $Total;
                $Parcela = 1; 
                echo "Opção Escolhida: Avista Boleto <br>";
            }
        if ($Opcao == "cartao") 
            {
                $ValorParcela = $Total / $Parcela;
                echo "Opção Escolhida: Cartão Parcelado <br>";
            }
           
            echo "Quantidade Parcela(s):" .$Parcela. "<br>";
            echo "Valor Parcela: " .$ValorParcela. "<br>";
            echo "Valor Total: " .$Total .'<BR>';
            ?> 
                <form name="form1" action="Suporte.php?valor=enviado" method="POST">
                Opção de Compra: <br>
                <P> Confirmar forma de pagamento: <BR>     
                <input name="Botao" type="submit" value="Confirma">
                </p>
                </form>
                </body>
            <?php 
          
    }
    if ($Botao =="Confirma")
    {
         header('location:Pedido.php'); 
    }
}
else 
{
    ?> 
    <form name="form1" action="Suporte.php?valor=enviado" method="POST">
  		Opção de Compra: <br>
        <P> Selecione a opção de pagamento: <BR>
            <input type="radio" name="opcao" value="pix"> Pix <BR>
            <input type="radio" name="opcao" value="cartao">Cartão <br></p>
            Digite a quantidade de parcela(s):  <br>
            <input class="input" type="text" placeholder="Qtd Parcela" name="parcela"><BR><p>
            Digite o valor da compra:  <br>
            <input class="input" type="text" placeholder="Valor Compra" name="total"><BR><p>
            <input name="Botao" type="submit" value="Parcela">
     	 
		  </p>
		</form>
    </body>
  <?php 
}
?>