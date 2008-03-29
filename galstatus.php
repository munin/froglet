<?php
include('include/header.php');
include('include/galstatus_data.php');
?>
<table width="100%">
	<tr>
		<td width="50%">
<?php
$data = new GalstatusData;
$data->paste = isset($_REQUEST['paste']) ? $_REQUEST['paste'] : '';
$data->username = isset($_SESSION['USER']) ? $_SESSION['USER'] : '';

$ticking = false;

$time_details = localtime(time(), 1);
$min = $time_details['tm_min'];
$ticking = ($min > 0 && $min < 3);

if($data->paste != "" && !$ticking)
{
	$data->parseFleets();
}
else if ($ticking)
{
	echo '<h1>fuck off and wait for tick to finish you idiot!</h1>';
}
$smarty->display('galstatus_view.tpl');

?>
		</td>
	</tr>
</table>
<?php
include('include/footer.php');
?>