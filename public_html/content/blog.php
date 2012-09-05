<?php

####____Initialize Variables____####

$feed = ("http://csescholars.blogspot.com/atom.xml");

getFeed($feed);

//FUNCTIONS_________________________________________

function get_http_response_code($url) {

    $headers = get_headers($url);
    return substr($headers[0], 9, 3);
}

function getFeed($feed_url) {
   

    //Check if file_get_contents will fail
    if (get_http_response_code($feed_url)!="404") {

        $content = file_get_contents($feed_url);
    }
    else {
        echo "Error trying to load http://csescholars.blogspot.com/atom.xml. <br />
              Please refresh the page.";
        return;
    }
    
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