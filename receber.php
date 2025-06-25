<?php
$lat = $_GET['lat'] ?? null;
$lng = $_GET['lng'] ?? null;

if ($lat && $lng) {
    $data = date("Y-m-d H:i:s");
    $linha = "$data,$lat,$lng\n";
    file_put_contents("dados.txt", $linha, FILE_APPEND);
    echo "OK";
} else {
    echo "Erro: dados não recebidos.";
}
?>
