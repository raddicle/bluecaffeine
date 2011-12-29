<?php
$this->Paginator->options(array(
    'update' => '#bandNewsList',
    'evalScripts' => true
));
?>
<div id="bandNewsList">
    <table width="250">
        <?php foreach ($news as $newsItem): ?>
            <tr>
                <td> 
                    <?php
                    echo $this->Html->link($newsItem['BandNews']['title'], $newsItem['BandNews']['newsurl']
                            , array('class' => 'button', 'target' => '_blank'));
                    ?> 
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <!--
    <?php echo $this->Paginator->prev() . " "; ?>
    <?php echo $this->Paginator->numbers(); ?>
    <?php echo " " . $this->Paginator->next(); ?>
    -->
</div>
<?php echo $this->Js->writeBuffer(); ?>



