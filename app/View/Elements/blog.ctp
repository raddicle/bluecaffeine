<?php
$this->Paginator->options(array(
                                'update' => '#blogList',
                                'evalScripts' => true
                                ));
?>
<div id="blogList">
  <table width="250">
  <?php foreach($posts as $post): ?>
  <tr>
  <td><?php echo $post['Post']['title']; ?> </td>
  </tr>
<?php endforeach; ?>
  </table>
  <!--
<?php echo $this->Paginator->prev()." "; ?>
<?php echo $this->Paginator->numbers(); ?>
<?php echo " ".$this->Paginator->next(); ?>
  -->
</div>
<?php
  echo $this->Js->writeBuffer(); ?>
