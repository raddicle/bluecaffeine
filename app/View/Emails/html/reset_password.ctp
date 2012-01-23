Dear <?php echo $resetUser['User']['first_name'] . ' ' . $resetUser['User']['last_name'] ?>, <br/>

<p>
    We received a request to reset your password. Please use the url below to reach to password reset page at Bluecaffeine.com.
</p>

<?php
echo 'http://' . env('SERVER_NAME') . $this->Html->url('/Users/activate/' . $resetUser['User']['id'] . '/' . $resetUser['User']['verificationCode']);
?>
<br/>
<br/>
Thanks & Regards,<br/>
Bluecaffeine Team.