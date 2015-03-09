<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="<?php if(isset($post['page_description'])){ echo $post['page_description'];} else { echo ''; } ?>">
        <meta name="keywords" content="<?php if(isset($post['page_keywords'])){ echo $post['page_keywords'];} else { echo ''; } ?>">
        <title><?php if(isset($post['page_title'])){ echo $post['page_title'];} else { echo $title; } ?></title>
        <script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>        
    </head>
<body>
        