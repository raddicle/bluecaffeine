<script>

    $( "#emailWebMaster" )
    .button()
    .click(function() {
        $( "#emailWebMasterDialog" ).dialog( "open" );
        $( "#MessageSubject" ).val('');
        $( "#MessageMsg" ).val('');
    });

    jQuery(function($){ 
        $('#sendEmail') 
        .click(function(){ 
            $("#webmasterEmailForm").ajaxSubmit({ 
                success: function(responseText, responseCode) { 
                    if ("\"success\"" == responseText) {
                        $( "#emailWebMasterDialog" ).dialog( "close" );
                    } else {
                        $('#emailwebmasterContent').html(responseText);
                    }
                } 
            }); 
            return false; 
        }); 
    });
</script>

<?php
echo $this->Form->create('Message'
    , array('id' => 'webmasterEmailForm'
    , 'url' => array('action' => 'sendMsgToWebMaster'
        , 'controller' => 'Message')));
?>
<fieldset>
    <?php
    echo $this->Form->input('to', array('type' => 'hidden', 'value' => 'webmaster@bluecaffeine.com'));
    echo $this->Form->input('from', array('type' => 'hidden', 'value' => $this->Session->read('band')));
    echo $this->Form->input('subject');
    echo $this->Form->input('msg', array('type' => 'textarea', 'cols' => '45', 'rows' => '12'));
    ?>
    <input type="button" value="Send" id="sendEmail" 
           style="width:110px; float: right; margin: 6px 24px 0 0;"/>

    <input type="button" value="Cancel" id="addMember" 
           onclick='$( "#emailWebMasterDialog" ).dialog( "close" );'
           style="width:110px; float: right; margin: 6px 24px 0 0;"/>

</fieldset>
<?php
echo $this->Form->end();
echo $this->Js->writeBuffer(array('inline' => 'true'));
?>
