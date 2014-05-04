<?php
$sUrl = 'https://id.berita.yahoo.com/nasional/';
$sUrlSrc = getWebsiteContent($sUrl);

// Load Dokumennya
$dom = new DOMDocument();
@$dom->loadHTML($sUrlSrc);

$xpath = new DomXPath($dom);

// Ambil links:
$aLinks = array();
$vRes = $xpath->query("/html/body/div[2]/div/div[2]/div/div[2]/div/div/div/div/div/div/div[2]/div/div/ul/li/div/cite");
foreach ($vRes as $obj) {
    $aLinks[] = $obj->getAttribute('href');
}

// Ambil Judul Posting:
$aTitles = array();
$vRes = $xpath->query("/html/body/div[2]/div/div[2]/div/div[2]/div/div/div/div/div/div/div[2]/div/div/ul/li/div/a");
foreach ($vRes as $obj) {
    $aTitles[] = $obj->nodeValue;
}

// Ambil Deskripsi Berita:
$aDescriptions = array();
$vRes = $xpath->query("/html/body/div[2]/div/div[2]/div/div[2]/div/div/div/div/div/div/div[2]/div/div/ul/li/div/p");
foreach ($vRes as $obj) {
    $aDescriptions[] = $obj->nodeValue;
}

echo '<link href="css/styles.css" type="text/css" rel="stylesheet"/><div class="main">';
echo '<h1>Using xpath for dom html</h1>';

$entries = $xpath->evaluate('/html/body/div[2]/div/div[2]/div/div[2]/div/div/div/div/div/div/div[2]/div/div/ul/li/div/a');
echo '<h1>' . $entries->item(0)->nodeValue . ' Berita Yahoo Terbaru</h1>';


$i = 0;
foreach ($aLinks as $sLink) {
    echo <<<EOF
<div class="unit">
    <a href="{$sLink}">{$aTitles[$i]}</a>
    <div>{$aDescriptions[$i]}</div>
</div>
EOF;
    $i++;
}
echo '</div>';

// / / Fungsi ini akan mengembalikan konten halaman menggunakan cache (kami akan memuat sumber asli tidak lebih dari sekali per jam)
function getWebsiteContent($sUrl) {
    // our folder with cache files
    $sCacheFolder = 'cache/';

    // cache filename
    $sFilename = date('YmdH').'.html';

    if (! file_exists($sCacheFolder.$sFilename)) {
        $ch = curl_init($sUrl);
        $fp = fopen($sCacheFolder.$sFilename, 'w');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array('User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15'));
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }
    return file_get_contents($sCacheFolder.$sFilename);
}


?>
