<script>
    $(function() {
        var loginButton = $('#loginButton');
        var loginBox = $('#loginBox');
        var loginForm = $('#loginForm');
        loginButton.removeAttr('href');
        loginButton.mouseup(function(login) {
            loginBox.toggle();
            loginButton.toggleClass('active');
            $('#UserUsername').focus();
        });
        loginForm.mouseup(function() { 
            return false;
        });

        var registerButton = $('#registerButton');
        var registerBox = $('#registerBox');
        var registerForm = $('#registerForm');
        registerButton.removeAttr('href');
        registerButton.mouseup(function(login) {
            registerBox.toggle();
            registerButton.toggleClass('active');
            $('#UserFirstName').focus();
        });
        registerForm.mouseup(function() { 
            return false;
        });
        
        $(this).mouseup(function(item) {
            if(!($(item.target).parent('#loginButton').length > 0)) {
                loginButton.removeClass('active');
                loginBox.hide();
            }
            if(!($(item.target).parent('#registerButton').length > 0)) {
                registerButton.removeClass('active');
                registerBox.hide();
            }
        });
    }); 
</script>

<div id="loginContainer" class="menuButtonContainer" style="float: right; min-width: 200px">
    <?php if (!$this->Session->read('Auth.User')) : ?>
        <!-- Login Starts Here -->
        <a href="#" id="registerButton" class="menuButton"><span>Register</span><em></em></a>
        <a href="#" id="loginButton" class="menuButton"><span>Login</span><em></em></a>
        <div style="clear:both"></div>
        <div id="loginBox" class="menuButtonBox" style="width: 248px">                
            <?php echo $this->element("security/loginform") ?>
        </div>
        <!-- Login Ends Here -->
        <!-- Register -->
        <div id="registerBox" class="menuButtonBox" style="width: 248px">                
            <?php echo $this->element('security/registration'); ?>
        </div>
        <!-- Register-->        


    <?php else : ?>
        <!-- Logout Starts Here -->
        <style>
            .menuButton span {
                color:#445058; 
                font-size:14px; 
                font-weight:bold; 
                text-shadow:1px 1px #fff; 
                padding:7px 9px 9px 10px;
                background:url(<?php echo $this->Html->image('loginArrow.png') ?> no-repeat 5% 7px;
                display:block
            }
            .menuButton.active span {
                background-position:5% -76px;
            }
        </style> 
        <span style="float: right;">
            <a href="#" id="loginButton" class="menuButton" style="width: 20px;">
                <span style="width: 0px; float: right;">&nbsp;</span><em></em>
            </a>
        </span>
        <span style="float: right; margin-top: 6px; color:#445058; font-weight:bold; text-shadow:1px 1px #fff; ">
            <?php
            $userDetails = $this->Session->read('user');
            echo 'Welcome ' . $userDetails['User']['first_name'];
            ?>
        </span>
        <div style="clear:both"></div>
        <div id="loginBox" class="menuButtonBox">                
            <?php
            echo $this->Form->create('User', array('id' => 'loginForm'
                , 'class' => 'menuButtonForm', 'style' => 'width:100px;', array('action' => 'login')));
            echo $this->Html->link('Log out', array('controller' => 'Users'
                , 'action' => 'logout'
                , 'class' => 'menuButton'));
            echo $this->Form->end();
            ?>
        </div>
        <!-- Logout Ends Here -->
    <?php endif ?>
    <?php if (!$this->Session->read('Auth.User')) : ?>
        <div style="margin-left: auto; margin-right: auto; margin-top: 8px;">
            <center>
                <?php
                echo $this->Facebook->login(array('show-faces' => 0, 'redirect' => '/Users/login', 'img' => 'facebook_login.jpg', 'width' => '90px'));
                ?>
            </center>
        </div>
    <?php endif ?>
</div>
