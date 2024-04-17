<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<?php
if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
{
    $Botao = $_POST ["Botao"];
    $Usuario = $_POST ["Usuario"];
    $Senha = $_POST ["Senha"];
    
    if ($Botao == "Login")
    {
        session_start();
        $_SESSION["control"] = "logado";
        include "Logado.php";
        
    try
    {
        $Comando=$conexao->prepare("INSERT INTO TB_CADASTRO (USUARIO, SENHA)
            VALUES (?,?)");

                $Comando->bindParam(1, $Usuario);
                $Comando->bindParam(2, $Senha);
                
        if ($Comando->execute())
        {
            if ($Comando->rowCount() >0)
            {
                echo"<script> alert('Contato registrado com sucesso!')</script>";
                echo ('<meta http equiv="refresh"content=0;""Login.php">');
                
                $Email = null;
                $Senha = null;
                
                

            }
            else
            {
                    echo "Erro ao tentar efetivar o contato.";
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
        session_start();
        $_SESSION["control"] = "new";
        echo "<a href=\"Cadastro.php\">Novo</a>";
    }
}
else
{
    ?>
    <form action="Login.php?valor=enviado" method="post">
    Usuário: <br>
    <input type="email" placeholder="Email" name="Usuario"><br>
    Senha: <br>
    <input type="password" name="Senha" placeholder="Senha" maxlenght="8"><br>

    <input type="submit" value="Logar" name="Botao">
    <input type="submit" value="Cadastro" name="Botao">
    <input type="reset" value="Limpar" name="Botao">

    </form>
    <?php
}
?>







</body>
</html>
    
    
