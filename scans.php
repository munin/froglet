<?php
include('include/header.php');
include('include/scans_data.php');
?>
<table width="100%">
	<tr>
		<td width="50%">
<?php
if ($_GET['action'] == 'submit')
{
	if (isset($_POST['submit']))
	{
		preg_match_all("|scan_id=([0-9]*)|", $_POST['sourcecode'], $matches);
		
		foreach($matches[1] as $match)
		{
			$sql = sprintf('INSERT INTO scanparser_queue (rand_id) VALUES (%d)', $match);
			$db->exec($sql);
		}	
		echo 'Ascendancy thanks you for sharing your wisdom!';
	}
	
	$smarty->display('scan_submit.tpl');	
}
else
{
	$data = new ScansData;
	$data->page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
	$data->order = isset($_REQUEST['order']) ? $_REQUEST['order'] : '';
	$data->direction = isset($_REQUEST['dir']) ? $_REQUEST['dir'] : '';
	
	if($data->order == "")
	{
		$data->order = "score_rank";
	}
	if($data->direction == "")
	{
		$data->direction = "asc";
	}
	
	$smarty->assign('data', $data->selectScans());
	$smarty->assign('count', $data->numberOfScans());
	$smarty->assign('page', $data->page);
	$smarty->assign('order', $data->order);
	$smarty->assign('dir', $data->direction);
	$smarty->display('scans_list.tpl');
}
?>
		</td>
	</tr>
</table>
<?php
include('include/footer.php');
?>