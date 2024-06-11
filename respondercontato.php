<?php
$email = $_SESSION['emailContato'];
$corpo = "Sua senha foi alterada, agora é \"alpha\", mude na tela cadastro"; // fazer mensangem para o usuario falando da recuperação de senha
$data_envio = date('d/m/Y');
$hora_envio = date('H:i:s');

require_once("phpmailer/class.phpmailer.php");

include "senhaemail.php";
$para = $email;
$de = 'murillo.joaquim@etec.sp.gov.br'; //email do murilo
$de_nome = 'Desenvolvedores Alpha sigma male';
$assunto = "Recuperar senha";

function smtpmailer($para, $de, $de_nome, $assunto, $corpo){
    global $error;
    $mail = new PHPMailer();
    $mail-> IsSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;   // Autenticação ativada
    $mail->SMTPSecure = 'tls';  // Padrão de segurança
    $mail->Host = 'smtp.office365.com'; // SMTP utilizado
    $mail->Port = 587;      // A porta 587 deverá estar aberta em seu servidor
    $mail->Username = USER;
    $mail->Password = PWD;
    $mail->SetFrom($de, $de_nome);
    $mail->Subject = $assunto;
    $mail->Body = $corpo;
    $mail->AddAddress($para);
    if(!$mail -> Send()){
        $error = 'Mail Error: ' . $mail->ErrorInfo;
        return false;
    }
    else{
        $error = 'Mensagem Enviada!';
        return true;
    }
}

$vai = "E-mail: $email \n \n Resposta: $corpo";

 if(smtpmailer($email, 'murillo.joaquim@etec.sp.gov.br', 'Murillo Prevelato Gabriel Joaquim', 'Mudança de Senha', $vai)){
    echo('sucesso enviado, ');
    header('location:Cadastro.php');
 }
 if (!empty ($error)) echo $error;
?>