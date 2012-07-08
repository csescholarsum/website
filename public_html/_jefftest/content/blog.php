<?php

####____Initialize Variables____####

$feed = ("http://csescholars.blogspot.com/atom.xml");

getFeed($feed);

function getFeed($feed_url) {
    
    $content = file_get_contents($feed_url);
    
    $x = new SimpleXmlElement($content);
    
    //die(var_dump($x));
    
    foreach($x as $entry) {

        if ( isset($entry->title) ) {
            echo "
                <div class='shell'>
                    <h3>
                      <a href='http://csescholars.blogspot.com' title='$entry->title'>" . $entry->title . "</a>
                    </h3>
                    <p>
                        $entry->content
                </div>";
            //NOTE: there is no </p> tag b/c the content ends the <p> tag for some reason
        }
    }
}
?> 