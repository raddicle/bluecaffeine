<script>
    $(function() {
        $("#registerAsArtist").click(registerAsArtist);
        //$("#goManageBand").button();
        $("#createBand").click(createBand);
        $( "#newBandDialog" ).dialog({
            autoOpen: false,
            height: 400,
            width: 750,
            modal: false,
            close: function() {
            }
        });

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


    
    function registerAsArtist(){;
       
        $.ajax({
            type: "post",
            url: "<?php echo $this->Html->url('/Users/registerAsArtist'); ?>",
            success: function(response) {
                alert("An email is end to Sales Support. Someone from Sales support will contact you.");
            },
            error:function (XMLHttpRequest, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
        return false;    
    }

    function createBand(){
       
        $.ajax({
            type: "post",
            url: "<?php echo $this->Html->url('/Band/newBand'); ?>",
            success: function(response) {
                $("#newBandDialog").html(response);
                $("#newBandDialog").dialog("open");
            },
            error:function (XMLHttpRequest, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
        return false;    
    }
    
    function manageBand(){
        var bandId = $('#userBands').val();
        document.location = "<?php echo $this->Html->url('/Band/manageBand'); ?>/" + bandId
        
    }

</script>

<div id="newBandDialog" title="Create New Band"></div>
<?php
$user = $this->Session->read('user');
$this->set('showAdd', false);

if ($this->Session->read('Auth.User') && $user['User']['role'] == 'fan') {
    echo $this->Html->link('Register as artist', array(), array('id' => 'registerAsArtist'
        , 'style' => 'float:right; margin-top: -25px'));
} else if ($this->Session->read('Auth.User') && $user['User']['role'] == 'artist') {
    echo $this->Html->link('Create new band', array(), array('id' => 'createBand'
        , 'style' => 'float:right; margin-top: -25px'));

    $userBand = $this->Session->read('bands');
    
    if (isset($userBand)) {
    ?>     
    <div style='float:right;'>
        <select id="userBands">
            <?php
            foreach ($userBand as $band) {
                ?>        
                <option value="<?php echo $band['Band']['id']; ?>"><?php echo $band['Band']['bandName']; ?></option>
                <?php
            }
            ?>        
        </select>
        <button id='goManageBand' onclick='manageBand()'>Manage</button>
    </div>
<?php }

} ?>

<div class="backImage" style="text-align: center;">
    <?php
    $this->set('showAdd', false);
    echo $this->Html->image('home/home.jpg', array('url' => '/home', 'style' => ' margin-top: 10px'));
    ?>
</div>
<div style="width: 300px; font-size: 24px; font-weight: bold; margin-left: auto; margin-right: auto; text-align: center">
    new music records make them and then break some
</div>
