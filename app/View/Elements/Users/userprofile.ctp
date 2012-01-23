<script>
    $(function() {
        $('#profileUpdate').button();
        $( "#UserDob" ).datepicker();
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
    });

</script>
<div class="container" style="width: 100%">
    <table>
        <tr>
            <td style="width: 400px;">


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
