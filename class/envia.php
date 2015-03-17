<?php
$tel = $_POST['tel'];
$msg = $_POST['msg'];
$lat = $_POST['lat'];
$long = $_POST['long'];
$msg = $msg . " - enviado do whatsanonymity.hol.es";
$hora = date('Y-m-d H:i:s'); 
function geraPalavra() {

    $CaracteresAceitos = 'abcdefghijklmnopqrstuvxywzABCDEFGHIJKLMNOPQRSTUVXYWZ';
    $max = strlen($CaracteresAceitos)-1;
    $palavra = NULL;
    for($i=0; $i < 9; $i++) {
         $palavra .= $CaracteresAceitos{mt_rand(0, $max)};
    }
return $palavra;
}

$nome = geraPalavra();

$ch = curl_init();
// informar URL e outras funÃ§Ãµes ao CURL
curl_setopt($ch, CURLOPT_URL, "http://whatsappemmassa.com.br/service.php");
// Faz um POST
$data = array('action' => 'enviorapido', 'whatsapp2' => $tel, 'remetente' => $nome, 'mensagem' => $msg);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
// Acessar a URL e imprimir a saÃ­da
curl_exec($ch);

$fp = fopen("log.log", "a");
$escreve = fwrite($fp, "Número:" . $tel . " | Mensagem:" . $msg . " | Hora:" . $hora . "| IP:" . $_SERVER['REMOTE_ADDR'] . "|Localizacao:" . $lat . "," . $long .  "\n");
fclose($fp); 

header("Location: http://104.236.211.241");
?>

