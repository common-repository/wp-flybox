<?php
$deviantoptions = array('username' => get_option('wpflybox_deviant_username') ,'limit' => get_option('wpflybox_deviant_limit'), 'max_width' => get_option('wpflybox_deviant_max_width'), 'max_height' => get_option('wpflybox_deviant_max_height'), 'columns' => get_option('wpflybox_deviant_columns'));
function wpfb_get_deviant_data($options)
{
$key = 'wpfb_d_' . $options['username'];
$you = get_transient($key);
if ($you!='' && is_string($you)){
$you = base64_decode($you);
$you = unserialize($you);
} else {$you=false;}
if (!$you)
{  
	function parseRSS($url) {
  $opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n" .
              "User-Agent:Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)\r\n"
  )
);
$context = stream_context_create($opts);  
        $feedeed = file_get_contents($url,false,$context);
        $parser = xml_parser_create();
        xml_parse_into_struct($parser, $feedeed, $valueals, $index);
        xml_parser_free($parser);
        foreach($valueals as $keyey => $valueal){
            if($valueal['type'] != 'cdata') {
                $item[$keyey] = $valueal;
			}
        } 
        $i = 0;
        foreach($item as $key => $value){
            if($value['type'] == 'open') { 
                $i++;
                $itemame[$i] = $value['tag']; 
            } elseif($value['type'] == 'close') { 
                $feed = $values[$i];
                $item = $itemame[$i];
                $i--; 
                if(count($values[$i])>1){
                    $values[$i][$item][] = $feed;
                } else {
                    $values[$i][$item] = $feed;
                } 
            } else {
                $values[$i][$value['tag']] = $value['value'];  
            }
        } 
        return $values[0];
	}
$xml = parseRSS("https://backend.deviantart.com/rss.xml?type=deviation&q=by%3A".$options['username']."+sort%3Atime+meta%3Aall");
if($xml['RSS']['CHANNEL']['ITEM']){ 
$k=0;
foreach($xml['RSS']['CHANNEL']['ITEM'] as $item) if ($k<$options['limit']){
$picture[$k] = parseRSS("http://backend.deviantart.com/oembed?url=".$item['LINK']."&format=xml");
//Get width to height ratio for maxes
if ($picture[$k]["OEMBED"]["TYPE"] == 'photo'){
$ratio=$picture[$k]["OEMBED"]["THUMBNAIL_WIDTH"]/$picture[$k]["OEMBED"]["THUMBNAIL_HEIGHT"];
//Set dimensions with maxes
if ($ratio>1)
  {
  $height[$k]=$options['max_height'];
  $width[$k]=round($ratio*$height[$k]);
  if ($width[$k]>$options['max_width'])
    {
    $width[$k]=$options['max_width'];
    $height[$k]=round((1/$ratio)*$width[$k]);
    }
  } else if ($ratio<=1)
  {
  $width[$k]=$options['max_width'];
  $height[$k]=round((1/$ratio)*$width[$k]);
  if ($height[$k]>$options['max_height'])
    {
    $height[$k]=$options['max_height'];
    $width[$k]=round($ratio*$height[$k]);
    }   
  }
  $you[$k]['link']=$item["LINK"];
  $you[$k]['thumbnail']=$picture[$k]["OEMBED"]["THUMBNAIL_URL_150"];
  $you[$k]['height']=$height[$k];
  $you[$k]['width']=$width[$k];
  $you[$k]['title']=$item["TITLE"];
  $k=$k+1;
}
}//end for
}//end if
  $you1=serialize($you);
  $you1=base64_encode($you1);
  set_transient($key, $you1, 60*60*12);
  update_option($key, $you1);
  return $you;
} else {
  return $you;
}
}
function wpfb_show_deviant($options, $data)
{
$k=0;
while ($k<$options['limit'])
  {
  $j=0;
  while ($j<$options['columns'])
    {
    echo '<a href="'.$data[$k]['link'].'" target="_blank" style="border:none;"><img style="vertical-align:middle;padding:1px;border:none;" src="'.$data[$k]['thumbnail'].'" height="'.$data[$k]['height'].'" width="'.$data[$k]['width'].'" title="'.$data[$k]['title'].'" alt="'.$data[$k]['title'].'"></a>';
    $k=$k+1;
    $j=$j+1;
    }
  echo '<br />';  
  }
}
$you = wpfb_get_deviant_data($deviantoptions);
echo '<div style="margin:0px;padding:0px;text-align:center;display:inline-block;background-color:'.get_option('wpflybox_deviant_background').';border:1px solid '.get_option('wpflybox_deviant_border').';">'; 
if($you)
  {
  wpfb_show_deviant($deviantoptions, $you);
  } else {
  echo 'Error: Invalid username or deviant server cannot be reached.';
  } 
echo '</div>';
?>