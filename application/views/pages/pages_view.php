<h1>Pages</h1>
<a href="<?php echo base_url()."pages/create_page" ;?>">Add page</a>
<table width="300" cellspacing="0" cellpadding="8" border="1">
        <tr>
        <th>Page title</th>
        <th>Action</th></tr>
        <?php foreach ($pages as $page) : ?>
    <tr>
    
        <td>
           <?php echo '<a href="page/'.str_replace(' ','-',$page['page_slug']).'-'.$page['page_id'].'">'. ucfirst($page['page_title']).'</a>'; ?>
        </td>
        <td>

            <a href="edit_page/<?php echo $page['page_id']; ?>">Edit</a> |
            <a href="delete_page/<?php echo $page['page_id']; ?>" onClick="return confirm('are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>     
</table>
<a href="<?php echo base_url()."users/logout" ;?>">Logout</a>