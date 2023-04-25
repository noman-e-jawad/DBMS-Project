<?php

ob_start();

?>
<div class="nav">

    <div class="nav-header">
        <div class="nav-title">
            SPMS 4.0
        </div>
        <div class="logo">
        </div>
    </div>
</div>
<?php

$html = ob_get_clean();

echo ($html);
