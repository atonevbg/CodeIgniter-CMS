<h1>Edit page</h1>

<?php

    echo form_open();
    
    echo form_label('Page title:').br();
    
    $data = array(
        'name' =>'page_title',
        'value' =>$page_item['page_title'],
        'style' =>'width:400px',
    );
    echo form_input($data).br();
    echo form_error('page_title');
    
    echo form_label('Page keywords:').br();
    
    $data = array(
        'name' =>'page_keywords',
        'value' =>$page_item['page_keywords'],
        'style' =>'width:400px',
    );
    echo form_input($data).br();
    echo form_error('page_keywords');
    
    echo form_label('Page description:').br();
    
    $data = array(
        'name' =>'page_description',
        'value' =>$page_item['page_description'],
        'style' =>'width:400px',
    );
    echo form_input($data).br();
    echo form_error('page_description');
    
    echo form_label('Page slug:').br();
    
    $data = array(
        'name' =>'page_slug',
        'value' =>$page_item['page_slug'],
        'style' =>'width:400px',
    );
    echo form_input($data).br();
    echo form_error('page_slug');
 
    echo form_label('Page content:');
    foreach ($page_item['page_content'] as $k => $value) {

    $data = array(
        'name' =>'page_content['.$k.']',
        'value' => $value,
        'style' =>'width:500px;height:200px;',
    );
    echo form_textarea($data).'
                <script>
                    CKEDITOR.replace("page_content['.$k.']",
                    {
                        width: 650,
                        height:150
                    });
                </script>';
    if(count($page_item['page_content'] ) > 1 ){
    ?>
    <a href="<?php echo base_url(); ?>delete_content/<?= $k; ?>" onClick="return confirm('Are you sure?')"> Remove</a>
    <?php
    }
    echo form_error('page_content[]');
    
    echo br();
    echo br();	
    
}
    
    $data = array(
        'name' => 'submit',
        'value' => 'Edit page',
        'style' => 'padding:5px; width:120px',
    );
    
    echo form_hidden('content', '');
    echo form_submit('submit', 'Add box');
    echo br();
    echo br();
    echo form_submit($data);
    
    echo form_close();
?>