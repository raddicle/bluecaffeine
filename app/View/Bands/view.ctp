<div style='display: table; width: 100%'>
    <div style='display: table-row;'>
        <div style='display: table-cell; width: 50%'>
            <?php
            echo $this->Html->image('/content/band/thumbnail/band_' . strtolower($band['Band']['id']), array('style' => 'width: 100%', 'id' => "profileImage"
            ));
            ?>
            <div style="border: 1px solid lightgrey;">
                <div id="bandProfileDetails">
                    <dl>
                        <dt>Band Name</dt>
                        <dd><?php echo $band['Band']['bandName']; ?></dd>
                        <dt>Genre</dt>
                        <dd><?php echo $band['Band']['genre']; ?></dd>
                    </dl>
                </div>
            </div>
        </div>
        <div style='display: table-cell; vertical-align: top; padding-left: 6px;'>
<!--            <button id="follow" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" 
                    style="margin: 3px 0 3px 3px; width: 120px">
                <span class="ui-button-text">Follow</span>
            </button>   
            <button id="playMusic" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" 
                    style="margin: 3px 0 3px 3px; width: 120px">
                <span class="ui-button-text">Play Music</span>
            </button>   
            <button id="buyMusic" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" 
                    style="margin: 3px 0 3px 3px; width: 120px">
                <span class="ui-button-text">Buy Music</span>
            </button>   
            <br/>
            <button id="playVideo" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" 
                    style="margin: 3px 0 3px 3px; width: 120px">
                <span class="ui-button-text">Play Video</span>
            </button>   
            <button id="website" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" 
                    style="margin: 3px 0 3px 3px; width: 120px">
                <span class="ui-button-text">Goto Website</span>
            </button>   
            <button id="concert" class="ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all" 
                    style="margin: 3px 0 3px 3px; width: 120px">
                <span class="ui-button-text">Concert</span>
            </button>-->
            <div class="ribbon" style="width: 100%; height: 340px; color: white;">
                <div style="text-align: center; font-weight: bold;color: white;">
                    about <?php echo $band['Band']['bandName']; ?>
                </div>
                <div style="margin: 10px; color: white;">
                    <?php echo $band['Band']['aboutBand']; ?>
                </div>
            </div>
        </div>
    </div>
    <div style='display: table-row;'>
        <div style='display: table-cell; '>
            <div class="ribbon" style="width: 100%; height: 200px; margin-top: 10px;">
                <div style="text-align: center; font-weight: bold">
                    Songs
                </div>
                <div style="margin: 10px">
                    <?php
                    foreach ($band['Bandasset'] as $asset):
                        if ($asset['media_type'] == 1) :
                            ?>
                            <div>
                                <?php echo $this->Html->link($asset['file_name'], '/content/band/songs/song_'.$asset['id'].'.mp3', array('style'=>'color: white;'));?>
                            </div>
                            <?php
                        endif;
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        <div style='display: table-cell; padding-left: 6px;'>
            <div class="ribbon" style="width: 100%; height: 200px; margin-top: 10px;">
                <div style="text-align: center; font-weight: bold">
                    Video
                </div>
                <div style="margin: 10px">
                    <?php
                    foreach ($band['Bandasset'] as $asset):
                        if ($asset['media_type'] == 2) :
                            ?>
                            <div>       
                                <?php echo $this->Html->link($asset['file_name'], '/content/band/songs/song_'.$asset['id'].'.mp3', array('style'=>'color: white;'));?>
                            </div>
                            <?php
                        endif;
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
