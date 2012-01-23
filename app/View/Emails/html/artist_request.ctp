Dear Webmaster, <br/>

<p>
    <?php $user = $this->Session->read('user'); ?>
    
    A request is received from <?php echo $user['User']['first_name'] . ' ' . $user['User']['last_name'] . ' (user id ' . $user['User']['id']?>). Please consider changing the role of this user to that of an artist.
</p>

<br/>
<br/>
Thanks & Regards,<br/>
Bluecaffeine Team.