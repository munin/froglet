<?php
require_once('include/header.php');
include('include/scan_data.php');
?>
<table width="100%">
	<tr>
		<td width="50%">
<?php
$data = new ScanData;
$data->rand_id = $_REQUEST['id'];

if($data->rand_id != "")
{
	$smarty->assign('data', $data->selectScan());

	$tpl_vars = $smarty->get_template_vars();

	if($tpl_vars['data']['type'] == "planet")
	{
		$smarty->assign('plan', $data->selectPlanetScan());
		$smarty->display('scan_planet_view.tpl');
	}
	elseif($tpl_vars['data']['type'] == "surface")
	{
		$smarty->assign('surf', $data->selectSurfaceScan());
		$smarty->display('scan_surface_view.tpl');
	}
	elseif($tpl_vars['data']['type'] == "tech")
	{
		$smarty->assign('tech', $data->selectTechScan());
		$smarty->display('scan_tech_view.tpl');
	}
	elseif($tpl_vars['data']['type'] == "unit")
	{
		$smarty->assign('unit', $data->selectUnitScan());
		$smarty->display('scan_unit_view.tpl');
	}
	elseif($tpl_vars['data']['type'] == "jumpgate")
	{
		$smarty->assign('jgp', $data->selectJumpgateScan());
		$smarty->display('scan_jumpgate_view.tpl');
	}
	elseif($tpl_vars['data']['type'] == "military")
	{
		$smarty->assign('mili', $data->selectMilitaryScan());
		$smarty->display('scan_military_view.tpl');
	}
}
?>
		</td>
	</tr>
</table>
<?php
include('include/footer.php');
?>