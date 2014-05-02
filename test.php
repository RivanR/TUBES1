<?php
$xml = simplexml_load_file("test.xml");

echo $xml->getName() . "<br />";

foreach($xml->children() as $title)
  {
  echo $title->getName() . ": " . $title . " "<br />";
  }
?>
