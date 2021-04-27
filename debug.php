
<?php
    if (isset($db_error))
        if (!empty($db_error)) print_r($db_error);
?>
<?= 
    "<pre class='debug'>".
    "<br><b>Script running time:</b> ". (round(microtime(true) - $time_start,3)).' seconds'.
    "<br><b>PHP and MYSQL:</b>".
    '<div id="php-sql-errors"></div>'.
    "<br><b>SESSION:</b>".
    filter_var_array($_SESSION).
    "<br><b>POST:</b>".
    filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING).
    "<br><b>GET:</b>".
    filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING).
    "<br><b>COOKIE:</b>".
    filter_var_array($_COOKIE, FILTER_SANITIZE_STRING).
    "<br><b>SERVER:</b>".
    filter_var_array($_SERVER, FILTER_SANITIZE_STRING).
    "<br><b>FILES:</b>".
    filter_var_array($_FILES, FILTER_SANITIZE_STRING).
    "</pre>";
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