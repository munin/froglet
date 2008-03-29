<?php
include('include/header.php');
include('include/galaxy_data.php');
if(!$session->hasAccess(100))
{
	echo('<div align="center" class="warning">You are not authorized to access this page</div>');
	include('include/footer.php');
	exit();
}
echo('<table width="100%">');
echo('	<tr>');
echo('		<td width="50%">');
$data = new GalaxyData;
$data->x = isset($_REQUEST['x']) ? $_REQUEST['x'] : '';
$data->y = isset($_REQUEST['y']) ? $_REQUEST['y'] : '';
$data->page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
$data->order = isset($_REQUEST['order']) ? $_REQUEST['order'] : 'score_rank';
$data->direction = isset($_REQUEST['dir']) ? $_REQUEST['dir'] : 'asc';

if(isset($_REQUEST['left']) && $_REQUEST['left'] != "")
{
	$data->y--;
	if($data->y < 1)
	{
		$data->y = 10;
		$data->x--;
	}
}
elseif(isset($_REQUEST['right']) && $_REQUEST['right'] != "")
{
	$data->y++;
	if($data->y > 10)
	{
		$data->y = 1;
		$data->x++;
	}
}

if($data->x != "" && $data->y != "")
{
	$smarty->assign('data', $data->selectGalaxyPlanets());
	$smarty->assign('gala', $data->selectGalaxy());
	$smarty->display('galaxy_view.tpl');
}
else
{
	$smarty->assign('data', $data->selectGalaxy());
	$smarty->assign('count', $data->numberOfGalaxies());
	$smarty->assign('page', $data->page);
	$smarty->assign('order', $data->order);
	$smarty->assign('dir', $data->direction);
	$smarty->display('galaxy_list.tpl');
}
echo('		</td>');
echo('	</tr>');
echo('</table>');
include('include/footer.php');
?>