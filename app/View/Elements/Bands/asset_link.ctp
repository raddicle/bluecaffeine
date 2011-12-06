<div id='assetLinks'>
    <div class="input file">
    <?php
      echo $this->Form->input('BandassetLink.link', array('div'=>false));
      echo $this->Js->link(null, array('controller' => 'Bandasset', 'action' => 'delete', 6)
                      , array('update' => '#memberTable'
                              , 'class'=>'icon delete', 'style'=>'margin-left: 10px;'
                              , 'confirm'=>'Are you sure you want to delete this link?'
                              , 'title'=>'Delete Link'));
    ?>
    </div>
</div>