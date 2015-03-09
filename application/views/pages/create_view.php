<h1>Create a new page</h1>

<?php
    echo form_open();
    
    echo form_label('Page title:').br();
    
    $data = array(
        'name' =>'page_title',
        'value' =>set_value('page_title'),
        'style' =>'width:400px',
    );
    echo form_input($data).br();
    echo form_error('page_title');
    
    echo form_label('Page keywords:').br();
    
    $data = array(
        'name' =>'page_keywords',
        'value' =>set_value('page_keywords'),
        'style' =>'width:400px',
    );
    echo form_input($data).br();
    echo form_error('page_keywords');
    
    echo form_label('Page description:').br();
    
    $data = array(
        'name' =>'page_description',
        'value' =>set_value('page_description'),
        'style' =>'width:400px',
    );
    echo form_input($data).br();
    echo form_error('page_description');
    
    echo form_label('Page slug:').br();
    
    $data = array(
        'name' =>'page_slug',
        'value' =>set_value('page_slug'),
        'style' =>'width:400px',
    );
    echo form_input($data).br();
    echo form_error('page_slug');
    
echo form_label('Page content:');
echo '<div class="inc">';
echo '<div class="controls">';
    $data = array(
        'name' =>'page_content',
        'value' =>set_value('page_content')
    );
    echo form_textarea($data).'
                <script>
                    CKEDITOR.replace("page_content",
{
 width: 650,
 height:150
});
                </script>';
    echo form_error('page_content');
    
    echo br();
    echo br();	
    echo '</div>';
    echo '</div>';

    echo form_error('page_content');
    
    $data = array(
        'name' => 'submit',
        'value' => 'Create page',
        'style' => 'padding:5px; width:120px',
    );
    echo br();
    echo "<b>For more content boxes please first create the page.</b>";
    echo br();
    echo br();
    echo form_submit($data);
    
    echo form_close();


?>