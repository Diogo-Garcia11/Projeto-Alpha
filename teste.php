<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitrine</title>
</head>
<body>
<?php
include "conexao.php";
    $Matriz=$conexao->prepare("SELECT * FROM tb_produto");


        $Matriz->execute();
        echo"<h1>Selecione o produto desejado:</h1>";
        $Linha = $Matriz -> fetch(PDO:: FETCH_OBJ);
        
            $idProduto = $Linha -> id_produto;
            
            
            
            ?>
            
            <script>
                // document.addEventListener('DOMContentLoaded', function() 
                // {
                //     mostrarImagem();
                // });
                // function mostrarImagem() 
                // {        
                //     var imagem = document.getElementById("Imagem");

                //     var idProduto = <?php echo $idProduto ?>;
                //     console.log(idProduto);
                // }
                idProd = 1;
                console.log(idProd);
            </script>
            <?php
            

    
?>
</body>
</html>
<?php

?>
