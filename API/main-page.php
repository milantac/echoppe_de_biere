<?php
$basePath = substr($_SERVER["PHP_SELF"], 0, strrpos($_SERVER["PHP_SELF"], '/'))

?>
<h1>PHP REST ECHOPE DE BIERE</h1>
<hr/>
liste des end-points
 
<ul>
    <li>
        <a href="<?=$basePath?>/biere">/biere</a>
        <ul>
            <li>GET</li>
            <li>POST</li>
        </ul>
    </li>
    <li>
        <a href="<?=$basePath?>/biere/1">/biere/${id}</a>
        <ul>
            <li>GET</li>
            <li>PUT</li>
            <li>PATCH</li>
            <li>DELETE</li>
        </ul>
        <br/>
        <br/>
    </li>
    <li>
        <a href="<?=$basePath?>/type_de_biere">/type_de_biere</a>
        <ul>
            <li>GET</li>
        </ul>
    </li>
    <li>
        <a href="<?=$basePath?>/type_de_biere/1">/type_de_biere/${id}</a>
        <ul>
            <li>GET</li>
        </ul>
        <br/>
        <br/>

    </li>
    <li>
        <a href="<?=$basePath?>/livre_d_or">/livre_d_or</a>
        <ul>
            <li>GET</li>
        </ul>
    </li>
    <li>    
        <a href="<?=$basePath?>/livre_d_or/1">/livre_d_or/${id}</a>
        <ul>
            <li>GET</li>
        </ul>
    </li>
</ul>
 