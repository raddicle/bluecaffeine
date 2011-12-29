<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php echo $this->Facebook->html(); ?>
<!--<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">-->
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        Bluecaffeine
    </title>

    <?php
    echo $this->Html->meta('icon');
    echo $scripts_for_layout;
    echo $this->Html->css('cake.generic');
    echo $this->Html->css('imgareaselect-default');
    echo $this->Html->css('jquery-ui');
    print $this->Html->script('jquery');
    print $this->Html->script('jquery-form');
    print $this->Html->script('jquery-ui-min');
    print $this->Html->script('jquery-jeditable');
    print $this->Html->script('ckeditor/ckeditor');
    print $this->Html->script('ckeditor/adapters/jquery');
    ?>
    <script>
        function loadPage(actionUrl) {
            $.ajax({
                type: "post",
                url: actionUrl,
                success: function(response) {
                    $("#siteContentArea").html(response);
                },
                error:function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(textStatus + errorThrown);
                }
            });
        }
        
    </script>
</head>
<body style="height: 100%;">
    <div style="width: 1000px; margin-left: auto; margin-right: auto;">
         <?php echo $this->element('security/credentials'); ?>
    </div>
    <div id="bar">
        <div id="container" style="width: 1000px; margin-left: auto; margin-right: auto;">
             <?php
             echo $this->Html->image('logo.png', array('url' => '/home', 'style' => 'width: 120px;'));
             ?>
        </div>
    </div>
    <div style="width:550px;  margin-top: -30px; margin-left: auto; margin-right: auto;">                
        <?php
        echo $this->Html->image(
            'menu/menu_left_blue.png', array('style' => 'float:left;'));
        ?>
        <ul id="menu">
            <li style="width: 80px; height: 50px; text-align: right;">
                <?php $userDetails = $this->Session->read('user'); ?>
                <?php if ($userDetails['User']['role'] == 'band'): ?>
                    <a href="#" onclick="loadPage('<?php echo $this->Html->url(array('controller' => 'band', 'action' => 'manageBand', $userDetails['User']['id'])); ?>')">ARTIST</a>
                <?php else: ?>
                    <a href="#" onclick="loadPage('<?php echo $this->Html->url(array('controller' => 'band', 'action' => 'index', $userDetails['User']['id'])); ?>')">ARTIST</a>
                <?php endif ?>
            </li>
            <li style="width: 50px; height: 50px; text-align: right;">
                <a href="#">FAN</a>
            </li>
            <li style="width: 80px; height: 50px; text-align: right;">
                <a href="#">COMMUNITY</a>
            </li>
            <li style="width: 200px; height: 50px; text-align: right;">
                Place search form here.
            </li>

        </ul>
        <?php
        echo $this->Html->image(
            'menu/menu_right_blue.png', array('style' => 'float:left'));
        ?>
    </div>
    <div style="display: table; width: 1000px;margin-left: auto;
         margin-right: auto; margin-top:60px;" id="siteContentArea">
        <div style="display: table-row;">
            <div id="siteContentArea" style="display: table-cell; width: 700px;">
                <?php
                echo $content_for_layout;
                ?>
            </div>
<!--            <?php
            if ($this->here != $this->Html->url("/")) :
                ?>

                <div style="display: table-cell; width: 200px;">
                    <?php 
                    echo $this->element('adv');
                    ?>
                </div>
            <?php endif ?>
-->
        </div>
    </div>


<!--           <div>            
    <?php echo $this->element('sql_dump'); ?>    
            </div>
-->
    <script type="text/javascript" src="http://webplayer.yahooapis.com/player-beta.js">
    </script> 
</body>
<?php echo $this->Facebook->init(); ?>
</html>



