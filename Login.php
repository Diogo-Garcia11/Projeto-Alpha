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
    $Email= $_POST['Email'];
    
    if ($Botao == "Logar")
    {

        include "conexao.php";
        
        try
        {
            $Comando=$conexao->prepare("SELECT email_cliente, senha_cliente FROM tb_cliente WHERE email_cliente =? and senha_cliente =?");
            
                    $Comando->bindParam(1, $Usuario);
                    $Comando->bindParam(2, $Senha);
                    
            if ($Comando->execute())
            {
                if ($Comando->rowCount() >0)
                {
                    while ($Linha = $Comando->fetch(PDO::FETCH_OBJ)) 
                    {
                        

                        $email = $Linha->email_cliente;
                        $_SESSION['email'] = $email;

                        $senha = $Linha->senha_cliente;
                        $_SESSION['senha'] = $senha;
                        $_SESSION['senha'] = $senha;
                        $_SESSION["control"] = "logado";
                        
                        header('location:Cadastro.php');
                    }
                    
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
        $_SESSION["control"] = "!logado";
        header('location:Cadastro.php');
    }
    if($Botao == "Esqueceu a senha")
    {
        $novasenha= "alpha";
        $Comando=$conexao->prepare("UPDATE senha_cliente SET senha_cliente =$novasenha FROM tb_cliente WHERE email_cliente =?");
        $Comando->bindParam(1, $Email);
        $Comando->execute();
        include "respondercontato.php";
    }
    if($Botao == "Enviar")
    {
        $_SESSION['emailContato'] = $_POST['Email'];  
        include "respondercontato.php";
    }
}
else
{
    ?>
    <form action="Login.php?valor=enviado" method="post">
    Usuário: <br>
    <input type="email" placeholder="Usuario" name="Usuario"><br>
    Senha: <br>
    <input type="password" name="Senha" placeholder="Senha" maxlenght="8" required><br><br>

    <input type="submit" value="Logar" name="Botao"><br>
    <input type="submit" value="Cadastro" name="Botao"><br>
    <input type="submit" value="Esqueceu a senha" name="Botao"><br>
    <input type="reset" value="Limpar" name="Botao"><br><br>
    
    <p>Caso esqueceu a senha, insira um email que você tenha acesso:</p>
    <input type="email" placeholder="Email" name="Email"><br>
    <input type="submit" value="Enviar" name="Botao">
    </form>

</body>
</html>
<?php
}
?>
    
    
