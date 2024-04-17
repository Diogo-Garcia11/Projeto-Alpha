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
    
    if ($Botao == "Login")
    {
        session_start();
        $_SESSION["control"] = "logado";
        include "Logado.php";
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
    <input type="email" placeholder="Email" name="usuario"><br>
    Senha: <br>
    <input type="password" name="senha" placeholder="Senha" maxlenght="8"><br>

    <input type="submit" value="Logar" name="Botao">
    <input type="submit" value="Cadastro" name="Botao">
    <input type="reset" value="Limpar" name="Botao">

    </form>
    <?php
}
?>







</body>
</html>
    
    
