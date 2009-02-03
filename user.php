<?php
include('include/header.php');
include('include/user_data.php');

if(!$session->hasAccess(100))
{
	echo('<div align="center" class="warning">You are not authorized to access this page</div>');
	include('include/footer.php');
	exit();
}
echo('<table width="100%">');
echo('	<tr>');
echo('		<td width="50%">');
$data = new UserData;
$data->pnick = isset($_REQUEST['pnick']) ? $_REQUEST['pnick'] : '';
$data->phone = isset($_REQUEST['sponsor']) ? $_REQUEST['sponsor'] : '';
$data->email = isset($_REQUEST['invites']) ? $_REQUEST['invites'] : 0;
$data->order = isset($_REQUEST['order']) ? $_REQUEST['order'] : 'pnick';
$data->direction = isset($_REQUEST['dir']) ? $_REQUEST['dir'] : 'ASC';

if($data->pnick != "")
{
	if(isset($_REQUEST['update']) && $_REQUEST['update'] != "")
	{
		$data->updateUser();
	}
	
	$smarty->assign('data', $data->selectUser());
	$tz = array();
	for($i=-12; $i<=12; $i++)
	{
		$tz[$i] = sprintf("GMT%+d", $i);
	}

	$smarty->assign('options', $tz);
	$smarty->assign('bool', array(0 => "No", 1 => "Yes"));
	$smarty->display('user_view.tpl');
}
else
{
	$smarty->assign('data', $data->selectUser());
	$smarty->assign('order', $data->order);
	$smarty->assign('dir', $data->direction);
	$smarty->display('user_list.tpl');
}
echo('		</td>');
echo('	</tr>');
echo('</table>');
include('include/footer.php');
?>