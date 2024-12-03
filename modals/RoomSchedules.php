<?php

$Currenttime = date('g:i:s a');
?>
<div>
    <h1><?= $Currenttime ?></h1>

    <form method="POST">
        <input type="time" name="time">
        <input type="submit">
    </form>
</div>