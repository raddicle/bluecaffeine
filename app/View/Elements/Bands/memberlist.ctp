<script>
    jQuery(function($){ 
        $('#addMemberLink').unbind("click")
        .bind('click', function(event){ 
            $("#newMember").css("display","inline"); 
            $("#memberTable").css("display","none"); 
            $("#newBandMember").focus();  
            $('#newBandMember').val('');
            $('#newRole').val('');
            $('#newFirstName').val('');
            $('#newLastName').val('');
            $('#newUserId').val('');
        });
    });
</script>
<a href="#" class="icon add" id='addMemberLink'>Add Member</a>
<table cellpadding='0' cellspacing='0' class="dataview" style="width: 100%; min-height: 200px; margin-top: 6px;">
    <thead>
    <th>Member</th>
    <th>Role</th>                   
    <th width="30px"></th>                   
</thead>
<?php
$rowCount = 0;
echo $this->Form->create(null, array('id' => 'bandDetailForm'
    , 'url' => array('action' => 'save')));
foreach ($band['User'] as $row) {
    ?>
    <tr>
        <td>
            <?php echo $row['first_name'] . ' ' . $row['last_name']; ?>
        </td>
        <td>
            <?php echo $row['BandMember']['role'] ?>
        </td>
        <td>
            <?php
            $rowCount++;
            echo $this->Js->link('', array('controller' => 'BandMember'
                , 'action' => 'deleteMember'
                , $row['BandMember']['user_id'], $row['BandMember']['band_id'])
                , array('update' => '#memberTable'
                , 'class' => 'icon delete'
                , 'style' => 'margin-left: 10px; width: 20px;'
                , 'confirm' => 'Are you sure you want to delete?'
                , 'title' => 'Delete Member'))
            ?>
        </td>
    </tr>
    <?php
}
echo $this->Form->end();
echo $this->Js->writeBuffer(array('inline' => 'true'));
?>
</table>
