<?php
$x = array();
$x['copyleft'] = date('Y')." - Micael Vinhas";
echo $twig->render('footer.html', $x);
?>
