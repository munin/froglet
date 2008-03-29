<?php 
include('include/header.php');
include('include/defcall_data.php');
?>
<table width="100%">
	<tr>
		<td width="50%">
<?php
$data = new DefcallData;
$data->name = $_REQUEST['name'];
$data->page = $_REQUEST['page'];
$data->order = $_REQUEST['order'];
$data->direction = $_REQUEST['dir'];

$smarty->assign('order', $data->order);
$smarty->assign('dir', $data->direction);

if($data->name != "")
{
	$smarty->assign('data', $data->selectAlliance());
	$smarty->assign('alli', $data->name);
	$smarty->assign('count', $data->numberOfMembers());
	$smarty->assign('page', $data->page);
	$smarty->display('alliance_view.tpl');
}
else
{
	if($data->order == "")
	{
		$data->order = "alliance";
	}
	if($data->direction == "")
	{
		$data->direction = "asc";
	}
	$smarty->assign('data', $data->listHostileAlliances());
	$smarty->assign('total', $data->getTotalHostiles());
	$smarty->display('hostile_list.tpl');
}
?>
		</td>
	</tr>
</table>
<?php
include('include/footer.php');
?>