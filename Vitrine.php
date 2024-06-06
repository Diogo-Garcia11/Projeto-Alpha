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
if(1==1)
{

    include "conexao.php";

    $Matriz=$conexao->prepare("SELECT * FROM tb_produto");

       
        $Matriz->execute();
        echo"<h1>Selecione o produto desejado:</h1>";
        while ($Linha = $Matriz -> fetch(PDO:: FETCH_OBJ))
        {
            $idProduto = $Linha -> id_produto;
            $nomeProd = $Linha -> nome_prod;
            $valorProd = $Linha -> valor_prod;
            $desProd = $Linha -> des_prod;
            
            echo "<table border=1>";
            echo "<tr>";
            echo "<td> Id do produto </td>";
            echo "<td> Nome do produto </td>";
            echo "<td> Valor do produto </td>";
            echo "<td> Descrição do produto </td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>" . $idProduto. "</td>";
            echo "<td>" . $nomeProd. "</td>";
            echo "<td>" . $valorProd. "</td>";
            echo "<td>" . $desProd. "</td>";
            echo "</tr>";
            echo "</table> <br>" ;
            ?>
            <form action="Vitrine.php?valor=enviado" method="post">
            <input type="submit" name="Botao" value="Comprar">
            </form>
            <br>
            <?php
            
            if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
            { 
                $_SESSION['idProd'] = $idProduto;
                header('location:Produto.php'); 
            }
        }
        
}
else{
?>
</body>
</html>
<?php
}
?>
