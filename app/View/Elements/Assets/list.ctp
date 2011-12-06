<table cellpadding='0' cellspacing='0' class="dataview">
    <thead>
    <th width="90%">Song</th>
    <th></th>                   
</thead>

<?php
foreach ($band['Bandasset'] as $asset):
    if ($asset['media_type'] == $mediaType) {
        ?>
        <tr>
            <td>
                <?php
                echo $this->Html->link($asset['file_name']
                    , 'http://' . $_SERVER['SERVER_ADDR'] . $this->Html->url('/content/band/songs/song_' . $asset['id'] . '.mp3')
                    , array('id' => 'songLink' . $asset['id']));
                ?>
            </td>
            <td>
                <?php
                echo $this->Js->link('', array('controller' => 'Bandassets'
                    , 'action' => 'delete'
                    , $asset['id'], $mediaType)
                    , array('update' => ($mediaType == 1 ? '#songSection' : '#videoSection')
                    , 'class' => 'icon delete'
                    , 'style' => 'margin-left: 10px; width: 20px;'
                    , 'confirm' => 'Are you sure you want to delete?'
                    , 'title' => 'Delete'));
                echo $this->Js->writeBuffer(array('inline' => 'true'));
                ?>
            </td>
        </tr>
        <?php
    }
endforeach;
?>
<script>
    $(document).ready(function() {
        YAHOO.MediaPlayer.addTracks(document.getElementById("songLink<?php echo $asset['id'] ?>"));
    });
</script>

</table>
