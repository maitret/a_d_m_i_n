<?php

function auto_link_text($text) {
$pattern  = '#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#';
$result = preg_replace_callback($pattern, 'auto_link_text_callback', $text);
return $result;
//return preg_match($pattern, $text, $matches);
}
function auto_link_text_callback($matches) {
$max_url_length = 50;
    $max_depth_if_over_length = 2;
    $ellipsis = '&hellip;';
    $url_full = $matches[0];
$GLOBALS['url_completa'] = $url_full;
    $url_short = '';
    if (strlen($url_full) > $max_url_length) {
        $parts = parse_url($url_full);
        $url_short = $parts['scheme'] . '://' . preg_replace('/^www\./', '', $parts['host']) . '/';
        $path_components = explode('/', trim($parts['path'], '/'));
        foreach ($path_components as $dir) {
            $url_string_components[] = $dir . '/';
        }

        if (!empty($parts['query'])) {
            $url_string_components[] = '?' . $parts['query'];
        }

        if (!empty($parts['fragment'])) {
            $url_string_components[] = '#' . $parts['fragment'];
        }

        for ($k = 0; $k < count($url_string_components); $k++) {
            $curr_component = $url_string_components[$k];
            if ($k >= $max_depth_if_over_length || strlen($url_short) + strlen($curr_component) > $max_url_length) {
                if ($k == 0 && strlen($url_short) < $max_url_length) {
                    // Always show a portion of first directory
                    $url_short .= substr($curr_component, 0, $max_url_length - strlen($url_short));
                }
                $url_short .= $ellipsis;
                break;
            }
            $url_short .= $curr_component;
        }

    } else {
        $url_short = $url_full;
    }

    return "<a rel=\"nofollow\" href=\"$url_full\">$url_full</a>";
}

$text = "Se supoñe que estoy aquí: https://www.google.com.mx/maps/@22.2450204,-97.8423083,16z?hl=es-419 bla bla bla ú ñ ";
auto_link_text($text);
echo $url_completa."\n<hr>\n";

/*  */

$string = "this is my friend's website http://example.com I think it is cool, but this is cooler https://www.echteinfach.tv :) ".$text;
$regex = '/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i';
preg_match_all($regex, $string, $matches);
$urls = $matches[0];
// go over all links
foreach($urls as $url) {
    echo $url."\n<br>\n";
}

?>