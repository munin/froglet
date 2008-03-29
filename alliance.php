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
if(isset($_REQUEST['name']) && $_REQUEST['name'] != "")
{
	$data->names = array(0 => $_REQUEST['name']);
}
else
{
	$data->names = null;
}
$data->page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 0;
$data->order = isset($_REQUEST['order']) ? $_REQUEST['order'] : 'score_rank';
$data->direction = isset($_REQUEST['dir']) && $_REQUEST['dir'] == 'desc' ? $_REQUEST['dir'] : 'asc';

$smarty->assign('order', $data->order);
$smarty->assign('dir', $data->direction);

if($data->names != "")
{
	$smarty->assign('data', $data->selectAlliance());
	$smarty->assign('alli', implode($data->names, ","));
	$smarty->assign('count', $data->numberOfMembers());
	$smarty->assign('page', $data->page);
	$smarty->display('alliance_view.tpl');
}
else if(isset($_REQUEST['action']) && $_REQUEST['action'] == "intel")
{
	if($data->order == "score_rank" || $data->order == "")
	{
		$data->order = "score";
	}
	if($data->direction == "")
	{
		$data->direction = "desc";
	}
	$smarty->assign('data', $data->allianceIntelList());
	$smarty->assign('count', $data->numberOfIntel());
	$smarty->assign('page', $data->page);
	$smarty->display('alliance_intel_list.tpl');
}
else
{
	$smarty->assign('data', $data->allianceList());
	$smarty->assign('count', $data->numberOfAlliances());
	$smarty->assign('page', $data->page);
	$smarty->display('alliance_list.tpl');
}
echo('		</td>');
echo('	</tr>');
echo('</table>');
include('include/footer.php');
?>