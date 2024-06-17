<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitrine</title>
</head>
<body>
<?php
session_start();
if(1==1)
{
    $_SESSION['idProd']= "";
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
            echo "</table> <br>";
           
            echo "<img src='img/gato.webp' id='Imagem$idProduto' style='width: 20%; height: 20%;'><br>";
            echo "<form action='Vitrine.php?valor=enviado' method='post'>";
            echo "<input type='hidden' name='idProduto' value='$idProduto'>";
            echo "<input type='submit' name='Botao' value='Comprar'>";
            echo "</form>";
            echo "<br>";

            
            ?>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarImagem<?php echo $idProduto; ?>();
            });

            function mostrarImagem<?php echo $idProduto; ?>() {
                var imagem = document.getElementById("Imagem<?php echo $idProduto; ?>");
                var idProd = <?php echo $idProduto; ?>;

                if (idProd == 1) 
                {
                   
                    imagem.src = "img/kindle.webp";
                } 
                if (idProd == 2) 
                {
                    
                    imagem.src = "img/canon.webp";
                }
                
            }
        </script>
        <?php

          
        if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
            { 
                $_SESSION['idProd'] = $_POST['idProduto']; // Salva o ID do produto na session
                header('Location: Produto.php');
                exit; 
            }   
        } 
    
}

        ?>
</body>
</html>

