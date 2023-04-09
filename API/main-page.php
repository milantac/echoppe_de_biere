<?php 
    $basePath=substr($_SERVER["PHP_SELF"],0,strrpos($_SERVER["PHP_SELF"],'/'))

?>
<h1>PHP REST ECHOPE DE BIERE</h1>
<hr/>
liste des end-points
<ul>type_de_biere
    <li><a href="<?=$basePath?>/bieres">bieres</a> &amp; <a href="<?=$basePath?>/bieres/1">bieres/${id}</a></li>
    <li><a href="<?=$basePath?>/type_de_biere">type_de_biere</a> &amp; <a href="<?=$basePath?>/type_de_biere/1">type_de_biere/${id}</a></li>
    <li><a href="<?=$basePath?>/livre_d_or">livre_d_or</a> &amp; <a href="<?=$basePath?>/livre_d_or/1">livre_d_or/${id}</a></li>
</ul>
    
