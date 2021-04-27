
<?php
    if (isset($db_error))
        if (!empty($db_error)) echo addslashes($db_error);
    echo "<pre class='debug'>";
    echo "<br><b>Script running time:</b> ". addslashes((round(microtime(true) - $time_start,3))).' seconds';
    echo "<br><b>PHP and MYSQL:</b>";
    print_r('<div id="php-sql-errors"></div>');
    echo "<br><b>SESSION:</b>";
    print_r(filter_var_array($_SESSION));
    echo "<br><b>POST:</b>";
    print_r(filter_input_array(INPUT_POST));
    echo "<br><b>GET:</b>";
    print_r(filter_input_array(ARRAY_GET));
    echo "<br><b>COOKIE:</b>";
    print_r(filter_var_array($_COOKIE));
    echo "<br><b>SERVER:</b>";
    print_r(filter_var_array($_SERVER));
    echo "<br><b>FILES:</b>";
    print_r(filter_var_array($_FILES));
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