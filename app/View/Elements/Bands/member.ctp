<script>
    jQuery(function($){ 
        $('#saveBandDetails').die("click")
        .live('click', function(event){ 
            event.preventDefault();
            event.stopPropagation();
            $("#bandDetailForm").ajaxSubmit({ 
                success: function(responseText, responseCode) { 
                    $('#statusArea').hide().html(responseText).fadeIn();             
                    $("#accountSettionSection").html(responseText);
                    $.ajax({
                        type: 'post'
                        , url: '<?php echo $this->Html->url( '/', true );?>/band/bandDetails/<?php echo $band['Band']['id'] ?>'
                        , data: "id=<?php echo $band['Band']['id'] ?>"
                        , success: function(response, status) {
                            $('#bandProfileDetails').html(response);
                        }
                        , error: function(response, status) {
                            alert('An unexpected error has occurred!');
                        }
                    });
            
                    setTimeout(function(){ 
                        $('#statusArea').fadeOut(); 
                    }, 5000); 
                },
                error:function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(textStatus);
                }
            }); 
            return false; 
        }); 
    });

</script>

<div id="accountSettionSection">
    <div>
        <?php
        echo $this->Form->create(null, array('id' => 'bandDetailForm'
            , 'url' => array('action' => 'save')));
        ?>
        <fieldset>
            <?php
            echo $this->Form->input('id'
                , array('value' => $band['Band']['id']
                , 'type' => 'hidden')
            );
            echo $this->Form->input('bandName'
                , array('value' => $band['Band']['bandName']
                , 'label' => 'Band Name')
            );
            echo $this->Form->input('genre'
                , array('value' => $band['Band']['genre']
                , 'label' => 'Genre', 'type' => 'select', 'options' => Configure::read('genre'))
            );
            echo $this->Form->input('email'
                , array('value' => $band['Band']['email']
                , 'label' => 'Email')
            );
            echo $this->Form->input('aboutBand'
                , array('value' => $band['Band']['aboutBand']
                , 'label' => 'About', 'type' => 'textarea')
            );
            ?>
            <div id="statusArea" class="ribbon" style="float: left; margin-top: 6px; padding: 5px; display: none;"></div>
            <input type="button" id="saveBandDetails" value ="Save" 
                   style="width:110px; float: right; margin: 6px 16px 0 0;"/>
                   <?php
                   echo $this->Form->end();
                   echo $this->Js->writeBuffer(array('inline' => 'true'));
                   ?>
            <div style="clear: both; margin-top: 50px; min-height: 250px;" >
                <div id="memberTable" style="clear: both; padding-right: 16px;">    

                    <?php echo $this->element('Bands/memberlist') ?>
                </div>

                <div id="newMember" style="clear: both; display: none; margin-top: 6px;">
                    <?php echo $this->element('Bands/newmember') ?>
                </div>
            </div>
        </fieldset>
    </div>
</div>