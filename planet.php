<?php
include('include/header.php');
include('include/planet_data.php');

if(!$session->hasAccess(100))
{
	echo('<div align="center" class="warning">You are not authorized to access this page</div>');
	include('include/footer.php');
	exit();
}
echo('<table width="100%">');
echo('	<tr>');
echo('		<td width="50%">');

$data = new PlanetData;
$data->x = isset($_REQUEST['x']) ? $_REQUEST['x'] : '';
$data->y = isset($_REQUEST['y']) ? $_REQUEST['y'] : '';
$data->z = isset($_REQUEST['z']) ? $_REQUEST['z'] : '';
$data->nick_search = isset($_REQUEST['nick_search']) ? $_REQUEST['nick_search'] : '';
$data->ruler_name = isset($_REQUEST['ruler_name']) ? $_REQUEST['ruler_name'] : '';
$data->planet_name = isset($_REQUEST['planet_name']) ? $_REQUEST['planet_name'] : '';
$data->nick = isset($_REQUEST['nick']) ? $_REQUEST['nick'] : '';
$data->fakenick = isset($_REQUEST['fakenick']) ? $_REQUEST['fakenick'] : '';
$data->alliance = isset($_REQUEST['alliance']) ? $_REQUEST['alliance'] : '';
$data->channel = isset($_REQUEST['channel']) ? $_REQUEST['channel'] : '';
$data->phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : '';
$data->amplifiers = isset($_REQUEST['amplifiers']) ? $_REQUEST['amplifiers'] : '';
$data->distorters = isset($_REQUEST['distorters']) ? $_REQUEST['distorters'] : '';
$data->nap = isset($_REQUEST['nap']) ? $_REQUEST['nap'] : '';
$data->page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
$data->order = isset($_REQUEST['order']) ? $_REQUEST['order'] : 'score_rank';
$data->direction = isset($_REQUEST['dir']) ? $_REQUEST['dir'] : 'asc';
$data->nappedOnly = ((isset($_REQUEST['action'])?$_REQUEST['action']:'') == 'napped') ? 1 : 0;
if($data->order == "")
{
	$data->order = "score_rank";
}
if($data->direction == "")
{
	$data->direction = "asc";
}

if($data->x != "" && $data->y != "" && $data->z == "")
{
	echo('<script type="text/javascript">');
	echo("window.location.href='galaxy.php?x=" . $data->x . "&y=" . $data->y . "'");
	echo("</script>");
}
elseif(($data->x != "" && $data->y != "" && $data->z != "") || ($data->nick_search != ""))
{
	if($data->ruler_name != "" && $data->planet_name != "")
	{
		if($data->updatePlanetNotes() < 1)
		{
			$data->insertPlanetNotes();
		}
	}

	if($data->nick_search != "")
	{
		$data->count = $data->numOfNicks();
	}
	else
	{
		$data->count = 1;
	}
	
	$smarty->assign('data', $data->selectPlanet());
	if($data->count > 1)
	{
		$smarty->display('planet_list.tpl');
	}
	else
	{
		$smarty->assign('outgoing', $data->outgoingFleets());
		$smarty->assign('incoming', $data->incomingFleets());
		$smarty->display('planet_view.tpl');
	}
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "channels")
{
	$smarty->assign('data', $data->planetChannels());
	$smarty->assign('count', $data->numberOfPlanetsWithChannels());
	$smarty->assign('page', $data->page);
	$smarty->assign('order', $data->order);
	$smarty->assign('options', array(null => "select one") + $data->allianceOptions());
	$smarty->assign('channel', $data->channel);
	$smarty->assign('alliance', $data->alliance);
	$smarty->display('planet_channels.tpl');
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "nicks")
{
	$smarty->assign('data', $data->planetNicks());
	$smarty->assign('count', $data->numberOfPlanetsWithNicks());
	$smarty->assign('page', $data->page);
	$smarty->assign('order', $data->order);
	$smarty->display('planet_nicks.tpl');
}
else
{
	$smarty->assign('data', $data->selectPlanet());
	$smarty->assign('count', $data->numberOfPlanets());
	$smarty->assign('page', $data->page);
	$smarty->assign('order', $data->order);
	$smarty->assign('dir', $data->direction);
	$smarty->display('planet_list.tpl');
}

echo('		</td>');
echo('	</tr>');
echo('</table>');

include('include/footer.php');
?>