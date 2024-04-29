<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
    {
            session_start();
        include "conexao.php";
        if ($_SESSION['controleResp'] == 'localizado')
        {
            echo "Dados do Contato:<br><br>";
            echo "Nome: <BR>" .  $_SESSION['nomeContato']. '<br>'. '<br>';
            echo "Fone:<BR>" . $_SESSION['foneContato']. '<br>' .'<br>';
            echo "Email:<BR>" .  $_SESSION['emailContato'] . '<br>'. '<br>';
            echo "Assunto: <BR>" .  $_SESSION['assuntoContato'].'<br>'. '<br>';
            echo "Mensagem: <BR>" .  $_SESSION['msgContato'] . '<br>'. '<br>';
            echo "Resposta: <BR>" . $_SESSION['respContato'] . '<br>'. '<br>';
            echo "Cadastro localizado com sucesso:". '<br>' .'<br>';
        }


        else if ($_SESSION['controleResp'] == 'respondido')
        {
            echo "Resposta gravada com sucesso:<br><br>";
        }


        else if ($_SESSION['controleResp'] == 'enviado')
        {
            echo "Resposta enviada com sucesso:<br><br>";
        }

        //Carrega a tabela
        $Matriz=$conexao->prepare("select * FROM TB_FALECONOSCO");

        echo "Contatos realizados no site:<br><br>"; 
        $Matriz->execute();

        echo "<table border=1>";
        echo "<tr>";
        echo "<td> Id Contato </td>";
        echo "<td> Nome do Contato</td>";
        echo "<td> Fone do Contato</td>";
        echo "<td> Email do Contato</td>";
        echo "<td> Assunto do Contato</td>";
        echo "<td> Msg do Contato</td>";
        echo "<td> Resposta do Contato</td>";
        echo "</tr>";

        while ($Linha = $Matriz -> fetch(PDO:: FETCH_OBJ))
        {
            $idContato = $Linha -> ID_CONTATO;
            $nomeContato = $Linha -> NOME_CONTATO;
            $foneContato = $Linha -> FONE_CONTATO;
            $emailContato = $Linha -> EMAIL_CONTATO;
            $assuntoContato = $Linha -> ASSUNTO_CONTATO;
            $msgContato = $Linha -> MSG_CONTATO;
            $respContato = $Linha -> RESP_CONTATO;

            echo "<tr>";
            echo "<td>" . $idContato. "</td>";
            echo "<td>" . $nomeContato. "</td>";
            echo "<td>" . $foneContato. "</td>";
            echo "<td>" . $emailContato. "</td>";
            echo "<td>" . $assuntoContato. "</td>";
            echo "<td>" . $msgContato. "</td>";
            echo "<td>" . $respContato. "</td>";
            echo "</tr>";
        }
        echo "</table>";

        if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado')){
            if($_POST['id_contato']!= "") $_SESSION['idContato'] = $_POST['id_contato'];
            if($_POST['resp_contato'] !="") $_SESSION['respContato'] = $_POST['resp_contato'];
            $Botao = $_POST ['Botao'];

            if($Botao == "Alterar")
            {
                include "alterarcontato.php";
            }
            if($Botao == "Enviar")
            {
                include "respondercontato.php";
            }
            if($Botao == "Localizar")
            {
                include "localizarcontato.php";
            }
        }
    }

    else
    {
    ?>
    <form action="Pedido.php?valor=enviado" method="post">
    <input class="button" type="submit" value="Alterar">

    </form>
</body>
</html>
<?php
}
?>