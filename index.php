<?php
$url = "http://data.bmkg.go.id/cuaca_indo_1.xml";
$sUrl = file_get_contents($url, False);
$xml = simplexml_load_string($sUrl);
for ($i=0; $i<sizeof($xml->Isi->Row); $i++) {
    $row = $xml->Isi->Row[$i];
    if(strtolower($row->Kota) == "bandung") {
        echo "<b>" . strtoupper($row->Kota) . "</b><br/>";
        echo "Cuaca :" . $row->Cuaca . "<br/>";
        echo "<img src='http://www.bmkg.go.id/ImagesStatus/" . $row->Cuaca . ".png' alt='" . $row->Cuaca . "'><br/>";
        echo "Suhu : " . $row->SuhuMin . " - ".$row->SuhuMax . " &deg;C<br/>";
        echo "Kelembapan : " . $row->KelembapanMin . " - " . $row->KelembapanMax . " %<br/>";
        break;
    }
}
?>
