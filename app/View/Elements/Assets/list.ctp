<table cellpadding='0' cellspacing='0' class="dataview">
    <thead>
    <th width="90%"><?php ($mediaType == 1 ? 'Song' : 'Video') ?></th>
    <th></th>                   
</thead>

<?php
foreach ($band['Bandasset'] as $asset):
    if ($asset['media_type'] == $mediaType) {
        ?>
        <tr>
            <td>
                <?php
                 if ($asset['link'] != "") {
                     echo $this->Html->link($asset['file_name'], $asset['link']);
                 } else {
                    echo $this->Html->link($asset['file_name'], '/content/band/songs/song_' . $asset['id'] . '.mp3');
                 }
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
        
        <script>
            $(document).ready(function() {
                try{
                    YAHOO.MediaPlayer.addTracks(document.getElementById("songLink<?php echo $asset['id'] ?>"));
                } catch(err) {
                }
            });
        </script>
        <?php
    }
endforeach;
?>

</table>
