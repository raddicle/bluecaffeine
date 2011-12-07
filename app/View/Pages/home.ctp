<script>
    $(function() {
        $('#addemailToNotify') 
        .click(function(event){ 
            event.preventDefault();
            event.stopPropagation();
            addPost();
        }); 
    });

    function addPost(){
        $("#newPreStartForm").ajaxSubmit({ 
            success: function(responseText, responseCode) { 
                document.getElementById("messageArea").innerHTML = 
                    "Thanks for registering with us. We will inform you when we open for business.";
            } 
        }); 
        return false; 
    }

</script>

<div class="backImage" style="text-align: center;">
    <?php
    echo $this->Html->image('home/home.jpg', array('url' => '/home', 'style' => ' margin-top: 10px'));
    ?>
</div>
<div style="width: 300px; font-size: 24px; font-weight: bold; color: #fff; margin-left: auto; margin-right: auto; text-align: center">
    new music records make them and then break some
</div>
