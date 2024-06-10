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
    $Botao = $_POST["Botaozao"];
    $Usuario_cliente = $_POST["Usuario"];
    $Senha_cliente = $_POST["Senha"];
    include "conexao.php";

    try 
    {
        $Comandozinho=$conexao->prepare("SELECT * FROM tb_cliente WHERE email_cliente =? and senha_cliente =?");
        $Comandozinho->bindParam(1,$Usuario_cliente);
        $Comandozinho->bindParam(2,$Senha_cliente);    
        echo $Usuario_cliente;
        echo $Senha_cliente;
        if($Comandozinho-> execute()){

            if($Comandozinho-> rowCount() > 0)
            {

                while($Linhazinha = $Comandozinho -> fetch(PDO:: FETCH_OBJ))
                {
                    $idcliente = $Linhazinha -> id_cliente;
                    $_SESSION["idCliente"] = $idcliente;
                    $_SESSION["control"] = "logado";
                
                    header('location:Cadastro.php'); 
                }
            }
        }        
    } 
    catch (PDOException $e) 
    {
        echo "Erro de execução da consulta: " . $e->getMessage();
    }           
            
 
}
else if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviar'))
{
    include "conexao.php";
    $Botao = $_POST["Botao"];
    $Email= $_POST['Email'];
    $novasenha= "alpha";
    if ($Botao == "Cadastro")
    {
        $_SESSION["control"] = "!logado";
        header('location:Cadastro.php');
    }
    else if($Botao == "Enviar")
    {
        
        try
        {
            $Comando2=$conexao->prepare("UPDATE tb_cliente SET senha_cliente = ? WHERE email_cliente =?");
            $Comando2->bindParam(1, $novasenha);
            $Comando2->bindParam(2, $Email);
            if($Comando2 ->execute())
            {
                if($Comando2->rowCount()>0)
                {
                    $_SESSION['emailContato'] = $Email;  
                    include 'location:respondercontato.php';
                    
                }
            }
            header('location:Cadastro.php');
        }
        catch (PDOException $e) 
        {
            echo "Erro de execução da consulta: " . $e->getMessage();
        } 

       
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

    <input type="submit" value="Login" name="Botaozao"><br>
    </form>
    
    <form action="Login.php?valor=enviar" method="post">
    <input type="submit" value="Cadastro" name="Botao"><br>
    <input type="reset" value="Limpar" name="Botao"><br><br>

    <div id="Esqueceu">

    <p>Caso esqueceu a senha, insira um email que você tenha acesso:</p>
    <input type="email" placeholder="Email" name="Email"><br>
    <input type="submit" value="Enviar" name="Botao"><br>

    </div>
    </form>
    
    
    <br>
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