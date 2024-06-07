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
    include "conexao.php";
    if ($Botao == "Logar")
    {
        try
        {
            $Comando=$conexao->prepare("SELECT email_cliente, senha_cliente FROM tb_cliente WHERE email_cliente =? AND senha_cliente =?");
                
            $Comando->bindParam(1, $Usuario);
            $Comando->bindParam(2, $Senha);

            if ($Comando->execute())
            {
                if ($Comando->rowCount() >0)
                {
                    $_SESSION["control"] = "logado";
                    echo "Logado com sucesso";
                    header('location:Cadastro.php');
                    exit();
                }
                else
                {
                    echo "Usuário ou senha inválidos";
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
    else if ($Botao == "Cadastro")
    {
        $_SESSION["control"] = "!logado";
        header('location:Cadastro.php');
    }
    if($Botao == "Enviar")
    {
        $novasenha= "alpha";
        
        $Comando2=$conexao->prepare("UPDATE senha_cliente SET senha_cliente = ? FROM tb_cliente WHERE email_cliente =?");
        $Comando2->bindParam(1, $novasenha);
        $Comando2->bindParam(2, $Email);

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
    <input type="password" name="Senha" placeholder="Senha" maxlenght="8" ><br><br>

    <input type="submit" value="Logar" name="Botao"><br>
    <input type="submit" value="Cadastro" name="Botao"><br>
    <input type="reset" value="Limpar" name="Botao"><br><br>

    <div id="Esqueceu">
    <p>Caso esqueceu a senha, insira um email que você tenha acesso:</p>
    <input type="email" placeholder="Email" name="Email"><br>
    <input type="submit" value="Enviar" name="Botao"><br>
    </div>
    
    </form><br>
    <input type="button" value="Esqueci a senha" id="EsqueceuBotao" name="Botao"><br>

    <script>
        document.getElementById('Esqueceu').style.display = 'none'

        document.getElementById('EsqueceuBotao').addEventListener('click', function() 
        {
            if(this.click) 
            {   if(document.getElementById('Esqueceu').style.display == 'none')
                {
                    document.getElementById('Esqueceu').style.display = ''
                    this.value = "Não esqueci a senha"
                }
                else{
                document.getElementById('Esqueceu').style.display = 'none'
                this.value = "Esqueci a senha"
                
                }
            }
        }
    );
</script>
</body>
</html>
<?php
}
?>