
<?php
    if (isset($db_error))
        if (!empty($db_error)) echo $db_error;
    echo "<pre class='debug'>";
    echo "<br><b>Script running time:</b> ". (round(microtime(true) - $time_start,3)).' seconds';
    echo "<br><b>PHP and MYSQL:</b>";
    print_r('<div id="php-sql-errors"></div>');
    echo "<br><b>SESSION:</b>";
    print_r($_SESSION);
    echo "<br><b>POST:</b>";
    print_r($_POST);
    echo "<br><b>GET:</b>";
    print_r($_GET);
    echo "<br><b>REQUEST:</b>";
    print_r($_REQUEST);
    echo "<br><b>COOKIE:</b>";
    print_r($_COOKIE);
    echo "<br><b>SERVER:</b>";
    print_r($_SERVER);
    echo "<br><b>ENV:</b>";
    print_r($_ENV);
    echo "<br><b>FILES:</b>";
    print_r($_FILES);
    echo "</pre>";
?>
<script>
    let divs = document.getElementsByClassName("debug-silent");
    let elem = document.querySelector('#php-sql-errors');
    for (i=0;i<divs.length;i++) {
        var str = divs[i].innerText;
        elem.innerHTML = elem.innerHTML + str;
        divs[i].innerHTML = '';
        divs[i].style.visibility = 'hidden';
    }
 </script>