<script>
    $(function() {
        $('#profileUpdate').button();
        $( "#UserDob" ).datepicker({ changeMonth: true,
			changeYear: true });
        $( "#UserGender" ).combobox();

        $('#profileUpdate').die("click")
        .live('click', function(event){
            event.preventDefault();
            event.stopPropagation();
            $("#profileForm").ajaxSubmit({
                success: function(responseText, responseCode) {

                },
                error:function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(textStatus);
                }
            });
            return false;
        });
        
        
        $( "#profileImageDialog" ).dialog({
            autoOpen: false,
            height: 500,
            width: 540,
            modal: true,
            close: function() {
            }
        });
        
        
        $( "#editProfileImg" ) .button() .click(function() {
             
            $.ajax({
                type: 'post'
                , url: '<?php echo $this->Html->url('/Users/editProfileImage', true); ?>'
                , success: function(response, status) {
                    $('#profileImageDialog').html(response);
                }
                , error: function(response, status) {
                    alert('An unexpected error has occurred!');
                }
            });
            
            $( "#profileImageDialog" ).dialog( "open" );
        });
    });

</script>

<div id="profileImageDialog" title="Edit Profile image">
</div>

<div class="container" style="width: 100%">
    <table>
        <tr>
            <td style="width: 400px; text-align: center; vertical-align: middle;">
            <?php 
            searchForFile("temp*");

            function searchForFile($fileToSearchFor){
                $numberOfFiles = count(glob($fileToSearchFor));
                if($numberOfFiles == 0){ 
                    return(FALSE);
                } else { 
                    return(TRUE);
                }
            }
    
            $user = $this->Session->read('user');
            
            if (searchForFile(WWW_ROOT.'content/band/thumbnail/user_'. $user['User']['id'].'.*')) {
                
                echo $this->Html->image('/content/band/thumbnail/user_'. $user['User']['id'], array('id' => "profileImage",
                    'onmouseover' => 'document.getElementById("bandImage").style.visibility = "visible"',
                    'onmouseout' => 'document.getElementById("bandImage").style.visibility = "hidden"'));
            } else {

                echo $this->Html->image('/content/band/blank.png', array('id' => "profileImage",
                    'onmouseover' => 'document.getElementById("bandImage").style.visibility = "visible"',
                    'onmouseout' => 'document.getElementById("bandImage").style.visibility = "hidden"'));
            }
            ?>
            <div id="bandImage" style="margin-top: -20px; margin-left: 10px; visibility: hidden;"
                onmouseover='document.getElementById("bandImage").style.visibility = "visible"' 
                onmouseout='document.getElementById("bandImage").style.visibility = "hidden"'>
                    <?php
                    echo $this->Html->image('picture_edit.png', array('id' => 'editProfileImg'));
                    ?>
                <span style="font-weight: bold; text-shadow: 0 0 4px #000">
                    Edit Image
                </span>
            </div>
            </td>
            <td style="border-left: 1px solid lightgrey;">
                <?php
                $currentUser = $this->Session->read('user');
                echo $this->Form->create('User', array('id' => 'profileForm'
                    , 'url' => array('action' => 'userprofile')));
                echo $this->Form->input('id', 
                        array('value'=>$currentUser['User']['id']
                            , 'type' => 'hidden'));
                echo $this->Form->input('first_name', 
                        array('value'=>$currentUser['User']['first_name']
                            , 'style' => "text-align: left"));
                echo $this->Form->input('last_name', 
                        array('value'=>$currentUser['User']['last_name']));
                echo $this->Form->input('gender', 
                        array('options' => array(1 => 'Male', 2 => 'Female')));
                echo $this->Form->input('dob', 
                        array('label' => 'Date of Birth', 'type'=>'text'));
                echo $this->Form->input('phone', 
                        array('value'=>$currentUser['User']['phone']));
                echo $this->Form->button('Save', 
                        array('id' => "profileUpdate"
                    , 'type' => "button"
                    , 'style' => "float: right; margin: 12px 20px 0 0; color: #444;"));
                echo $this->Form->end();
                ?>
            </td>
        </tr>
    </table>
</div>
