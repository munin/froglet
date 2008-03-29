<?php
include('include/header.php');
include('include/defcall_data.php');

if(!$session->hasAccess(100))
{
	echo('<div align="center" class="warning">You are not authorized to access this page</div>');
	include('include/footer.php');
	exit();
}
echo('<table width="100%">');
echo('	<tr>');
echo('		<td width="50%">');
$data = new DefcallData;
$data->defcall_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
$data->order = isset($_REQUEST['order']) ? $_REQUEST['order'] : '';
$data->direction = isset($_REQUEST['dir']) ? $_REQUEST['dir'] : 'DESC';

if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'old')
{
	$data->eta_low = -24;
	$data->eta_high = 0;
}
elseif(isset($_REQUEST['type']) && $_REQUEST['type'] == 'all')
{
	$data->eta_low = -1500;
	$data->eta_high = 14;
}
else
{
	$data->eta_low = 0;
	$data->eta_high = 14;
}

if($data->order == "")
{
	$data->order = "eta_now";
}
/*
if($data->eta == "")
{
	$data->eta = 0;
}
*/

if($data->defcall_id != "")
{
	$smarty->assign('call', $data->selectDefcall());
	$smarty->assign('data', $data->selectDefcallFleets());
	$smarty->display('defcall_view.tpl');
}
else
{
	$smarty->assign('data', $data->listDefcalls());
	$smarty->assign('order', $data->order);
	$smarty->assign('dir', $data->direction);
	$smarty->display('defcall_list.tpl');
}
echo('		</td>');
echo('	</tr>');
echo('</table>');
include('include/footer.php');
?>