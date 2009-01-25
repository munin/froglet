<?php 
include('include/header.php');
include('include/alliance_data.php');

if(!$session->hasAccess(100))
{
	echo('<div align="center" class="warning">You are not authorized to access this page</div>');
	include('include/footer.php');
	exit();
}

echo('<table width="100%">');
echo('	<tr>');
echo('		<td width="50%">');

$data = new AllianceData;
$data->names = $_REQUEST['alliances'];
if(!is_array($data->names))
{
	$data->names = explode(",", $data->names);
}
$data->order = $_REQUEST['order'];
$data->direction = $_REQUEST['dir'];
$data->minroids = $_REQUEST['minroids'];
$data->maxroids = $_REQUEST['maxroids'];
$data->minvalue = $_REQUEST['minvalue'];
$data->maxvalue = $_REQUEST['maxvalue'];
$data->action = "target";
$data->limit = 1000;

if($data->order == "")
{
	$data->order = "x,y,z";
}

$smarty->assign('data', $data->selectAlliance());
$smarty->assign('alli', implode($data->names, ","));
$smarty->assign('options', $data->allianceOptions());
$smarty->assign('minroids', $data->minroids);
$smarty->assign('maxroids', $data->maxroids);
$smarty->assign('minvalue', $data->minvalue);
$smarty->assign('maxvalue', $data->maxvalue);
$smarty->display('target_list.tpl');

echo('		</td>');
echo('	</tr>');
echo('</table>');
include('include/footer.php');
?>