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
        if(isset($_POST['id_produto'])) 
        {

            include "conexao.php";
        
            $id_produto = $_POST['idProd'];
        
            $query = $conexao->prepare("SELECT nome_prod, valor_prod, des_prod FROM tb_produto WHERE id_produto = ?");
            $query->bindParam(1, $id_produto);
            $query->execute();
        
            if($query->rowCount() > 0) {
                $produto = $query->fetch(PDO::FETCH_OBJ);

                $_SESSION['produto_selecionado'] = $produto;
                
                echo "<h1>{$produto['nome_prod']}</h1>";
                echo "<p>Valor: R$ {$produto['valor_prod']}</p>";
                echo "<p>Descrição: {$produto['des_prod']}</p>";
                echo "<form action='Login.php' method='post'>";
                echo "<input type='submit' name='Enviar' value='Comprar'>";
                echo "</form>";
            } else {
                echo "<p>Produto não encontrado.</p>";
            }
        } 
        else 
        {
            echo "<p>Nenhum produto selecionado.</p>";
        }

        
    }


    else{
    ?>
    <form action="Produto.php?valor=enviado" method="post">
    <input type="submit" name="Enviar" value="Comprar">
    </form>
</body>
</html>
<?php
    }
?>