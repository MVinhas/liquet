<?php   
    echo "<pre style='z-index: 100;
    position: absolute;
    border: 1px solid #ccc;
    top: 100%;
    background: #eee;
    width: 100%;
    left:0;'>";
    echo "<b>SESSION:</b>";
    print_r($_SESSION);
    echo "<br><b>POST:</b>";
    print_r($_POST);
    echo "<br><b>GET:</b>";
    print_r($_GET);
    echo "<br><b>COOKIE:</b>";
    print_r($_COOKIE);
    echo "<br><b>SERVER:</b>";
    print_r($_SERVER);
    echo "</pre>";