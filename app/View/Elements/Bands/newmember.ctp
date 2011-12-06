<script>
    jQuery(function($){ 

        $('#addMember').die("click")
        .live('click', function(event){ 
            event.preventDefault();
            event.stopPropagation();
            $("#newMemberForm").ajaxSubmit({ 
                success: function(responseText, responseCode) { 
                    $('#memberTable').html(responseText);
                    $("#newMember").css("display","none"); 
                    $("#memberTable").css("display","inline");
                },
                error:function (XMLHttpRequest, textStatus, errorThrown) {
                    alert('User already member of band or required information missing. Please enter all mandatory values.');
                }

            }); 
            return false; 
        }); 
    

        $( "#newBandMember" ).autocomplete({
            source: function (request, response) {
                jQuery.ajax({
                    url: "<?php echo $this->Html->url(array('controller' => 'BandMember', 'action' => 'memberEmail')) ?>/" + jQuery("#newBandMember").val() ,
                    dataType: "json",
                    type: "POST",
                    minChars: 2,
                    contentType: "application/json; charset=utf-8",
                    success: function (data) {
                        response($.map(data, function (item) {
                            return {
                                data: item.User,
                                value: item.User.username
                            }
                        }))
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        //Do nothing. This can also happen when there is no rows matching the email if in the database.
                    }
                });
            },
            select: function (event, ui) {
                userSelected(event, ui)
            }
        });
    });
    
    function userSelected(event, ui){
        $("#newFirstName").val(ui.item.data.first_name);
        $("#newLastName").val(ui.item.data.last_name);
        $("#newUserId").val(ui.item.data.id);
    }
    
    
</script>    
<?php
echo $this->Form->create('User'
    , array('id' => 'newMemberForm'
    , 'url' => array('controller' => 'BandMember'
        , 'action' => 'addMember')));
?>
<fieldset>
    <span style="font-weight: bold; text-decoration: underline;">
        New Member
    </span>
    <?php
    echo $this->Form->input('User.username'
        , array('label' => 'Email', 'id' => 'newBandMember'));

    echo $this->Form->input('BandMember.role'
        , array('label' => 'Role in Band', 'id' => 'newRole'));

    echo $this->Form->input('User.first_name'
        , array('label' => 'First Name', 'id' => 'newFirstName'));
    echo $this->Form->input('User.last_name'
        , array('label' => 'Last Name', 'id' => 'newLastName'));

    echo $this->Form->input('BandMember.band_id'
        , array('id' => 'newBandId', 'type' => 'hidden', 'value' => $band['Band']['id']));
    echo $this->Form->input('BandMember.user_id'
        , array('id' => 'newUserId', 'type' => 'hidden'));
    ?>
    <input type="button" value="Save Member" id="addMember" 
           style="width:110px; float: right; margin: 6px 14px 0 0;"/>
    <input type="button"  value="Cancel" 
           style="width:110px; float: right; margin: 6px 6px 0 0;"
           onclick='$("#newMember").css("display","none"); $("#memberTable").css("display","inline");   return false;'/>
</fieldset>
<?php
echo $this->Form->end();
echo $this->Js->writeBuffer(array('inline' => 'true'));
?>
