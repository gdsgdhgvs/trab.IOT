<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Rastreamento GPS</title>
    <style>
        body { font-family: Arial; margin: 40px; background-color: #f4f4f4; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        #map { height: 400px; width: 100%; margin-top: 30px; border: 2px solid #888; }
    </style>
</head>
<body>
<h1>Últimas Localizações</h1>

<?php
$localizacoes = [];
$arquivo = "dados.txt";
if (file_exists($arquivo)) {
    $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($linhas as $linha) {
        list($data, $lat, $lng) = explode(",", $linha);
        $localizacoes[] = ['data'=>$data,'lat'=>$lat,'lng'=>$lng];
    }
}
?>

<?php if (!empty($localizacoes)): ?>
<table>
  <thead><tr><th>Data e Hora</th><th>Latitude</th><th>Longitude</th></tr></thead>
  <tbody>
  <?php foreach (array_reverse($localizacoes) as $loc): ?>
    <tr>
      <td><?= htmlspecialchars($loc['data']) ?></td>
      <td><?= htmlspecialchars($loc['lat']) ?></td>
      <td><?= htmlspecialchars($loc['lng']) ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<div id="map"></div>

<script>
function initMap() {
    const ultima = {
        lat: <?= $localizacoes[count($localizacoes)-1]['lat'] ?>,
        lng: <?= $localizacoes[count($localizacoes)-1]['lng'] ?>
    };
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: ultima
    });
    new google.maps.Marker({
        position: ultima,
        map: map,
        title: "Última Localização"
    });
}
</script>

<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMj_vIVJvNRi9ODTUx-QLTLx61w7mG9hg=initMap"></script>

<?php else: ?>
<p>Nenhuma localização recebida ainda.</p>
<?php endif; ?>

</body>
</html>
