
        <h1>Login</h1>
        
        <?php
        echo $this->session->flashdata('errmsg');
        echo $this->session->flashdata('success_reg');
        echo form_open('users/login_validation');
        echo validation_errors();
        
        echo "<p>Email: ";
        echo form_input('email', set_value('email'));
        echo "</p>";
        
        echo "<p>Password: ";
        echo form_password('password');
        echo "</p>";
        
        echo "<p>";
        echo form_submit('login_submit','Login');
        echo "</p>";
        
        echo form_close();
        
        ?>
        
        <a href="<?php echo base_url()."users/signup" ;?>">Sign Up!</a>
        
