<?php
include 'simple_html_dom.php';
$url = "http://id.yahoo.com";
$html = file_get_html($url);
if (method_exists($html,"find")) {
echo "<ul>";
foreach($html->find('div[class=y-tabpanels] a[class=y-fp-pg-controls]') as $element ){
echo "<li>".$element ->plaintext."</li>";
}
echo "</ul>";
}else{}
?>
