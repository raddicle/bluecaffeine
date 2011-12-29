<script>
    jQuery(function($){
        $('#createNewBand').die("click")
        .live('click', function(event){
            event.preventDefault();
            event.stopPropagation();
            $("#newBandForm").ajaxSubmit({
                success: function(responseText, responseCode) {

                    url = '<?php echo $this->Html->url(array('controller' => 'band', 'action' => 'manageBand'));  ?>/' + responseText;
                    document.location = url;
                    $( "#newBandDialog" ).dialog( "close" );
                },
                error:function (XMLHttpRequest, textStatus, errorThrown) {
                    $( "#newBandDialog" ).dialog( "close" );
                }
            });
            return false;
        });
    });

</script>
<div id="newBand">
    <div>
        <?php
        echo $this->Form->create(null, array('id' => 'newBandForm'
            , 'url' => array('action' => 'newBand')));
        ?>
        <fieldset>
            <?php
            echo $this->Form->input('bandName'
                , array('label' => 'Band Name')
            );
            echo $this->Form->input('genre'
                , array('label' => 'Genre', 'type' => 'select', 'options' => Configure::read('genre'))
            );
            echo $this->Form->input('email'
                , array('label' => 'Email')
            );
            echo $this->Form->input('aboutBand'
                , array('label' => 'About', 'type' => 'textarea')
            );
            ?>
            <input type="button" id="createNewBand" value ="Create"
                   style="width:110px; float: right; margin: 6px 16px 0 0;"/>
            <?php
                echo $this->Form->end();
                echo $this->Js->writeBuffer(array('inline' => 'true'));
            ?>
        </fieldset>
    </div>
</div>