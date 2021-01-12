<?php
  function bbcode($data)
  {
          $input = array(
                  '/\[b\](.*?)\[\/b\]/is',
                  '/\[i\](.*?)\[\/i\]/is',
                  '/\[u\](.*?)\[\/u\]/is',
                  '/\[img\](.*?)\[\/img\]/is',
                  '/\[url\](.*?)\[\/url\]/is',
                  '/\[url\=(.*?)\](.*?)\[\/url\]/is',
                  '/\[color\=(.*?)\](.*?)\[\/color\]/is',
                  '/\[align\=(.*?)\](.*?)\[\/align\]/is'
          
                  );

          $output = array(
                  '<strong>$1</strong>',
                  '<em>$1</em>',
                  '<u>$1</u>',
                  '<img src="$1" />',
                  '<a href="$1">$1</a>',
                  '<a href="$1">$2</a>',
				  '<font style="color: $1;">$2</font>',
				  '<font style="text-align: $1;">$2</font>'
                  
                  );
 	

          $rtrn = preg_replace ($input, $output, $data);

          return $rtrn;
  }
//$bcode = bbcode('[img]http://www.pkmnplanet.net/rpg/images/mugshots/ck/N.png[/img]');// This is how you use it on a forum or a page

//echo $bcode;//output: <strong>this is again another test text</strong>
?>