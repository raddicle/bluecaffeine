<h2>Bands</h2>
<table>
    <tr>
        <th>Band Name</th>
        <th>Description</th>
    </tr>
    <?php foreach ($bands as $band): ?>
        <tr>
            <td>
                <?php echo $band['Band']['bandName'] ?>
            </td>
            <td>
                <?php echo $band['Band']['aboutBand'] ?>
                <?php echo $this->Html->link ('Profile', array('action' => 'view', $band['Band']['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
