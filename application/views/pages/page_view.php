<?php
    echo '<b>'.ucfirst($post['page_title']).'</b><br>';
    foreach ($post['page_content'] as $content){
        echo strip_tags($content).'<br>';
    }  
?>