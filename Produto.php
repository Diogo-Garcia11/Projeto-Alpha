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

        
            include "conexao.php";
           
            $idProduto = $_SESSION['idProd'];
        
            $query = $conexao->prepare("SELECT nome_prod, valor_prod, des_prod FROM tb_produto WHERE id_produto = ?");
            $query->bindParam(1, $idProduto);
            $query->execute();
            $Linha = $query -> fetch(PDO:: FETCH_OBJ);

            
            $nomeProd = $Linha -> nome_prod;
            $valorProd = $Linha -> valor_prod;
            $desProd = $Linha -> des_prod;
            $_SESSION['nomeProd'] = $nomeProd;
            $_SESSION['valorProd'] = $valorProd;
            $_SESSION['desProd'] = $desProd;


            if($query->rowCount() > 0) {
                $produto = $query->fetch(PDO::FETCH_OBJ);

                $_SESSION['produto_selecionado'] = $produto;
                
                echo "Nome do Produto:$nomeProd"."<br>"."<br>";
                echo "Valor: R$ $valorProd"."<br>"."<br>";
                echo "Descrição: $desProd"."<br>";

                echo "<img src='img/gato.webp' id='Imagem$idProduto' style='width: 20%; height: 20%;'><br>";
                echo"<form action='Produto.php?valor=enviado' method='post'>";
                echo "<input type='hidden' name='idProduto' value='$idProduto'>";
                echo"<input type='submit' name='BotaoEnviar' value='Comprar'>";
                echo"</form>";
               
                
            } 
            else 
            {
                echo "<script> alert('Produto não encontrado');</script>";
            }
        
        
       
    
        if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
        {
            header('location:Login.php'); 
        }
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                mostrarImagem<?php echo $idProduto; ?>();
            });

            function mostrarImagem<?php echo $idProduto; ?>() {
                var imagem = document.getElementById("Imagem<?php echo $idProduto; ?>");
                var idProd = <?php echo $idProduto; ?>;

                if (idProd == 1) {
                    imagem.src = "img/kindle.webp";
                } 
                if (idProd == 2) {
                    imagem.src = "img/canon.webp";
                }
            }
            
        </script>
        
</body>
</html>
