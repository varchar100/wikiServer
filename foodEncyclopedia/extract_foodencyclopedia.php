<?php 

$input='./foodlist_a-z_html.html';
	$input_handle=fopen($input,'r');
	
	$output = './foodlist_a-z_xml.xml';
	$output_handle = fopen($output, "w+");
	
	echo "Open for read and write...\r\n";
	
	$counter = 0;
	while(!feof($input_handle)){
	
		$pattern_url = '#<a href=\".*\">#';
		$record=fgets($input_handle,4096);
		$record = str_replace("\n", "", $record);
		$record = str_replace("\r", "", $record);
		
		
		preg_match($pattern_url,$record,$match);
		
		
		
		$url = str_replace("<a href=\"","",$match[0]);
		$url = str_replace("\">","",$url);
		echo $url."\r\n";
	
	}





//echo get_desc($url);




function get_desc($url){

	$url = 'http://www.foodterms.com'.$url;
	$contents = file_get_contents($url);

	$contents = str_replace("\r","",$contents);
	$contents = str_replace("\n","",$contents);

	$desc_pattern = '#<p class=\'term-note-item\'>.*<p class=\'copyright crumb\'#';
	$pattern_2 = '#<p>.*</p>#';

	preg_match($desc_pattern,$contents,$match);

	preg_match($pattern_2,$match[0],$match);

	$str = mb_convert_encoding($match[0], 'UTF-8', 'HTML-ENTITIES');

	$str = str_replace("<p>","",$str);
	$str = str_replace("</p>","",$str);

	return $str;
}

?>