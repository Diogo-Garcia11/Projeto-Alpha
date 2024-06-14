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
        if(isset($_SESSION["idProd"]))
        {
            include "conexao.php";
           
            $id_produto = $_SESSION['idProd'];
        
            $query = $conexao->prepare("SELECT nome_prod, valor_prod, des_prod FROM tb_produto WHERE id_produto = ?");
            $query->bindParam(1, $id_produto);
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
                ?>
                <form action='Produto.php?valor=enviado' method='post'>
                <input type='submit' name='BotaoEnviar' value='Comprar'>
                </form>
                <?php
                
            } 
            else 
            {
                echo "<script> alert('Produto não encontrado');</script>";
            }
        }
        else
        {
            echo "<script> alert('Produto não encontrado');</script>";
        }
        if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
        {
            header('location:Login.php'); 
        }


        
}
else
{
?>
</body>
</html>
<?php
}

?>