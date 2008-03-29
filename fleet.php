<?php
include('include/header.php');
include('include/fleet_data.php');
?>
<table width="100%">
	<tr>
		<td width="50%">
<?php
$data = new FleetData;
$data->paste = $_REQUEST['paste'];
$data->base = $_REQUEST['base'];
$data->alpha = $_REQUEST['alpha'];
$data->beta = $_REQUEST['beta'];
$data->gamma = $_REQUEST['gamma'];
$data->defclass = $_REQUEST['defclass'];
$data->attclass = $_REQUEST['attclass'];
$data->eta = $_REQUEST['eta'];
$data->username = $_SESSION['USER'];

if($_REQUEST['action'] == 'list')
{
	$smarty->assign('classes', array(null => "select", "Fighter" => "FI", "Corvette" => "CO",
		"Frigate" => "FR", "Destroyer" => "DE", "Cruiser" => "CR", "Battleship" => "BS"));
	$smarty->assign('etas', array(null => "select", 7 => "7", 8 => "8", 9 => "9", 10 => "10",
		11 => "11", 12 => "12", 13 => "13"));
	$smarty->assign('def', $data->defclass);
	$smarty->assign('att', $data->attclass);
	$smarty->assign('eta', $data->eta);
	$smarty->assign('data', $data->selectFleets());
	$smarty->display('fleet_list.tpl');
}
else
{
	if($_REQUEST['paste'] != "")
	{
		$data->parseFleets();
	}
	$smarty->assign('fleet', $data->selectFleet());
	$smarty->assign('alpha', $data->alpha);
	$smarty->assign('beta', $data->beta);
	$smarty->assign('gamma', $data->gamma);
	$smarty->display('fleet_view.tpl');
}
?>
		</td>
	</tr>
</table>
<?php
include('include/footer.php');
?>