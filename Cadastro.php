<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
<?php
session_start();
if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
{
    include "conexao.php";
    $Botão = $_POST['Enviar'];
    $Nome = $_POST['Nome'];
    $Endereco = $_POST['Endereco'];
    $Email = $_POST['Email'];
    $Senha = $_POST['Senha'];
    $ConfSenha = $_POST['ConfSenha'];
    
    $_SESSION['Nome'] = $Nome;
    $_SESSION['Endereco'] = $Endereco;
    if ($Senha == $ConfSenha)
    {
        if($_SESSION["control"] == "logado")
        {

            $Comando=$conexao->prepare("UPDATE tb_cliente SET nome_cliente = ?, endereco_cliente = ?, email_cliente = ?, senha_cliente =? WHERE id_cliente =?");
            
                    $Comando->bindParam(1, $Nome);
                    $Comando->bindParam(2, $Endereco);
                    $Comando->bindParam(3, $Email);
                    $Comando->bindParam(4, $Senha);
                    $Comando->bindParam(5, $_SESSION['idCliente']);
                    
            if ($Comando->execute())
            {
                if ($Comando->rowCount() >0)
                {
                    echo "Dados atualizados com sucesso";
                    header('location:Pgto.php');
                }
                else
                {
                    echo "<script> alert('Usuario não encontrado');</script>";
                }
            }
            
        }
        else if($_SESSION["control"] != "logado")
        {
            echo "não logado";
            $Comando=$conexao->prepare("INSERT INTO tb_cliente (nome_cliente, endereco_cliente, email_cliente, senha_cliente) VALUES(?,?,?,?)");
            
            $Comando->bindParam(1, $Nome);
            $Comando->bindParam(2, $Endereco);
            $Comando->bindParam(3, $Email);
            $Comando->bindParam(4, $Senha);
            
            if ($Comando->execute())
            {
                if ($Comando->rowCount() >0)
                {
                    echo "Cadastro realizado com sucesso";
                    header('location:Login.php');
                }
            }
        }
        
    }
    else
    {
        echo "Senhas não conferem";
        echo "<a href='Cadastro.php'>Voltar</a>";
        exit();
    }
}
else{
?>
    <form action="Cadastro.php?valor=enviado"  method="post">
    <input type="text" name="Nome" id="Nome" placeholder="Nome" size="35" required><br><br>
    <input type="text" name="Endereco" id="Endereco" placeholder="Endereço"required><br><br>
    <input type="email" name="Email" placeholder="Email" required><br><br>
    <input type="password" name="Senha" placeholder="Senha" required><br><br>
    <input type="password" name="ConfSenha" placeholder="Confirme a Senha" required><br><br>
    <input type="submit" name="Enviar" value="Confirmar Dados"><br><br>
    <input type="reset" name="Limpar" value="Limpar"><br><br>
    </form>
</body>
</html>
<?php
}
?>







