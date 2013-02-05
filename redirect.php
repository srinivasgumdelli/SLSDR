<?php
function redirect($url)
{
    ?>
    <script type="text/javascript">
        <!--
        window.location = "<?=$url?>"
        -->
    </script>
    <?php
}

?>
