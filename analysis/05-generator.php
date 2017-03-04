<?php



// Config
$inputFile = "02-linenumbers.txt";
$inputFileComments = "03-comments.txt";
$inputFileTopics = "04-topics.txt";
$urlPrefix = "https://github.com/adibaba/rapidminer-studio/blob/6.5.2/src/main/java/com/";
$heading = "RapidMiner";
$subheading = "(Open source, GNU AGPL v3)";
$descriptionHtml = 'Some of the <a target="_blank" href="https://twitter.com/adrianwilke/status/650973732119429120"> files I worked on</a> at RapidMiner in 2014.';
$footerHtml = '<h3>Contact</h3>Adrian Wilke<br /><a href="http://adrianwilke.de/">http://adrianwilke.de/</a>';
$outputFileHtml = "06-output.htm";



// Paths and lines
$lines = file($inputFile);
$data = Array();
foreach($lines as $line) {
 $parts = explode(":", $line);
 $item = Array();
 $item['codepath'] = $parts[0];
 $item['codeline'] = $parts[1];
 $item['shortpath'] = substr($item['codepath'], stripos($item['codepath'], "rapidminer/"));
 $item['url'] = $urlPrefix . $item['shortpath'] . "#L" . $item['codeline'];
 array_push($data, $item);
}
//print_r($data);



// Add comments
$comments = file($inputFileComments);
$i=0;
foreach($comments as $comment) {
 $data[$i]['comment'] = trim($comment);
 $i++;
}
//print_r($data);



// Add topics
$topics = file($inputFileTopics);
/*
$i=0;
foreach($topics as $topic) {
 if(!empty(trim($topic))) {
   $currentTopic = $topic;
 }
 $data[$i]['topic'] = $currentTopic;
 $i++;
}
$data[sizeof($data)-1]['topic'] = $currentTopic;
*/
$i=0;
foreach($topics as $topic) {
 if(!empty(trim($topic))) {
   $data[$i]['topic'] = trim($topic);
 }
 $i++;
}
//print_r($data);


// Create HTML
$html = '<!DOCTYPE html><html><head><title>' . $heading . ' ' . $subheading . '</title></head><body>';
$html .= "\n";
$html .= '<h1>' . $heading . '</h1>';
$html .= "\n";
$html .= '<h3>' . $subheading . '</h3>';
$html .= "\n";
$html .= $descriptionHtml;
foreach($data as $item) {
 if(isset($item['topic'])) {
  $html .= "\n";
  $html .= "\n";
  $html .= "<h3>";
  $html .= $item['topic'];
  $html .= "</h3>";
  $html .= "\n";
  $html .= "\n";
 }
 $html .= '<a target="_blank" href="';
 $html .= $item['url'];
 $html .= '">';
 $html .= $item['shortpath'];
 $html .= '</a>';
 $html .= "\n";
 
 
 $html .= '<pre>';
 $html .= $item['comment'];
 $html .= '</pre>';
 $html .= "\n";
 $html .= "\n";
}
$html .= $footerHtml;
$html .= '</body></html>';
//echo $html;
if(true) {
 $handle = fopen($outputFileHtml, 'w');
 fwrite($handle, $html);
 fclose($handle);
}
?>