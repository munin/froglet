<?php
include('include/header.php');
include('include/priority_data.php');
?>
<table width="100%">
	<tr>
		<td width="50%">
<?php
$data = new PriorityData;
$data->high = $_REQUEST['high'];
$data->medium = $_REQUEST['medium'];
$data->low = $_REQUEST['low'];

if($data->high != "" && $data->medium != "" && $data->low != "")
{
	$data->updatePriority();
}
$smarty->assign('data', $data->selectPriority());
$smarty->display('priority.tpl');
?>
		</td>
	</tr>
</table>
<?php
include('include/footer.php');
?>