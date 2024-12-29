<?php
include_once 'config/init.php';
?>

<?php
$template = new Template('templates/frontend.php');

$template->title = 'Job Lister';
echo $template;

?>