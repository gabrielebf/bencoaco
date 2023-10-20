<?php
// Recebendo dados do formulário
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$arquvio = $_POST['arquivo']

$headers = "Content-Type: text/plain;charset=utf-8\r\n";
$headers .= "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";

// Dados que serão enviados
$corpo = "Formulário da página de contato\r\n";
$corpo .= "Nome: " . $name . "\r\n";
$corpo .= "Email: " . $email . "\r\n";
$corpo .= "Mensagem: " . $message . "\r\n";
$corpo .= "Arquivo: " . $arquivo . "\r\n";

// Email que receberá a mensagem
$email_to = 'gabriele.figueiredo@bencoaco.com.br';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $diretorioDestino = "uploads/"; // Diretório onde os arquivos serão armazenados
  $arquivoTmp = $_FILES["arquivo"]["tmp_name"];
  $nomeArquivo = $_FILES["arquivo"]["name"];
  $caminhoCompleto = $diretorioDestino . $nomeArquivo;

  if (move_uploaded_file($arquivoTmp, $caminhoCompleto)) {
      echo "Arquivo enviado com sucesso.";
  } else {
      echo "Ocorreu um erro ao enviar o arquivo.";
  }
}

// Enviando email
$status = mail($email_to, mb_encode_mimeheader($subject, "utf-8"), $corpo, $headers);

if ($status):
  // Enviada com sucesso
  header('location:index.php?status=sucesso');
else:
  // Se der erro
  header('location:index.php?status=erro');
endif;
?>