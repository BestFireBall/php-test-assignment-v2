<?php

$text=file_get_contents("http://lenta.ru/rss");
$text=substr($text,strpos($text,"<item>"));
$text=substr($text,0,strpos($text,"</channel>"));
$preg=preg_match_all('|<item[^>]*?>(.*?)</item>|sei', $text, $arr);
$text_array=$arr[1];

for ($i=0;$i<sizeof($text_array);$i++)
	{
	preg_match('|<guid[^>]*?>(.*?)</guid>|sei', $text_array[$i],$guid);
	preg_match('|<title[^>]*?>(.*?)</title>|sei', $text_array[$i],$title);
	preg_match('|<link[^>]*?>(.*?)</link>|sei', $text_array[$i],$link);
	preg_match('|<description[^>]*?>(.*?)</description>|sei', $text_array[$i],$description);
	$description_a=str_replace("<![CDATA[","",$description[1]);
	$description_a=trim(str_replace("<br />","",$description_a));
	$description_a=trim(str_replace("]]>","",$description_a));
	
	preg_match('|<pubDate[^>]*?>(.*?)</pubDate>|sei', $text_array[$i],$pubDate);
//	preg_match('', $text_array[$i], $enclosure);
	preg_match('|<category[^>]*?>(.*?)</category>|sei', $text_array[$i],$category);

	$result[$i]=array('guid'=>$guid[1],'title'=>$title[1],'link'=>$link[1],'description'=>$description_a,'category'=>$category[1]);
	}

for ($i=0;$i<5;$i++)
	{
	echo iconv('UTF-8', 'cp866', $result[$i]['title'])."\r\n".iconv('UTF-8', 'cp866', $result[$i]['link'])."\r\n".iconv('UTF-8', 'cp866', $result[$i]['description'])."\r\n\r\n";
//	echo $result[$i]['title'], $result[$i]['link'], $result[$i]['description']."<hr>";
	}
/*	
echo "<pre>";
var_dump($result);
echo "</pre>";
*/
?>