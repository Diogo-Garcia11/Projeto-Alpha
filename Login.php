<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<?php
session_start();
if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
{
    $Botao = $_POST ["Botao"];
    $Usuario = $_POST ["Usuario"];
    $Senha = $_POST ["Senha"];
    
    if ($Botao == "Login")
    {
        
        $_SESSION["control"] = "logado";
        include "conexao.php";
        
    try
    {
        $Comando=$conexao->prepare("SELECT * FROM tb_cliente(email_cliente, senha_cliente)VALUES (?,?)");
        
                $Comando->bindParam(1, $Usuario);
                $Comando->bindParam(2, $Senha);
                
        if ($Comando->execute())
        {
            if ($Comando->rowCount() >0)
            {
                echo"<script> alert('logado com sucesso!')</script>";
                echo ('<meta http equiv="refresh"content=0;""Login.php">');
                
                $Email = null;
                $Senha = null;
                
            }
            else
            {
                    echo "Erro ao tentar logar.";
            }
        }
        else
        {
            throw new PDOException("Erro: Não foi possível executar a declaração sql.");
        }
    }
    catch (PDOException $erro)
    {
        echo"Erro" . $erro->getMessage();
    }
    }
    if ($Botao == "Cadastro")
    {
        
        
        header('location:Cadastro.php');
    }
    if($Botao == "Esqueceu a senha")
    {
        echo"<script> var email = prompt(\"digite seu email\")</script>";
        $_SESSION['email'];
    }
}
else
{
    ?>
    <form action="Login.php?valor=enviado" method="post">
    Usuário: <br>
    <input type="email" placeholder="Email" name="Usuario"><br>
    Senha: <br>
    <input type="password" name="Senha" placeholder="Senha" maxlenght="8" required><br>

    <input type="submit" value="Logar" name="Botao">
    <input type="submit" value="Cadastro" name="Botao">
    <input type="submit" value="Esqueceu a senha" name="Botao">
    <input type="reset" value="Limpar" name="Botao">
    </form>

</body>
</html>
<?php
}
?>
    
    
