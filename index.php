<?php
    include_once ('class.pedigree.php');

    $pedigree = new Pedigree();
    $pedigree->render();

    function pr($array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
