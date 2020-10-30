<?php
$db=new \clinela\database\DB();
?>
<div class="card">
    <div class="card-body">
        <p><?php echo html_entity_decode($db->getOptions('terms'));?></p>
    </div>
</div>
