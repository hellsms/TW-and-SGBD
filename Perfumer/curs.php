<?php
if(empty($in))
	$in = 0;
  $doc = new DOMDocument();
  $doc->load( 'http://www.bnr.ro/nbrfxrates.xml' ); 
  $rates = $doc->getElementsByTagName( "Rate" );
  $eur = 0.000;
  $usd = 0.000;
  $data = $doc->getElementsByTagName( "PublishingDate" )->item(0)->nodeValue;
  foreach( $rates as $rate )
  {
	if($rate->getAttributeNode("currency")->value == 'EUR')
		$eur = $rate->nodeValue;
	if($rate->getAttributeNode("currency")->value == 'USD')
		$usd = $rate->nodeValue;
  }
  ?>
