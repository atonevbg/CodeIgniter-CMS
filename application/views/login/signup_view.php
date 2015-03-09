        <h1>Sign Up</h1>
        <?php       
        echo $this->session->flashdata('error_add_user');
        echo form_open('users/signup_validation');
        echo validation_errors();
        
        echo "<p>Email: ";
        echo form_input('email', set_value('email'));
        echo "</p>";
        
        echo "<p>Password:";
        echo form_password('password');
        echo "</p>";
        
        echo "<p>Confirm password: ";
        echo form_password('cpassword');
        echo "</p>";
        
        echo "<p>";
        echo form_submit('signup_submit', 'Sign up');
        echo "</p>";
        
        echo form_close();
        ?>
