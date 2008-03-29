<?php
include('include/header.php');
include('include/planet_data.php');
include('include/galaxy_data.php');
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
$plan = new PlanetData;
$smarty->assign('data', $plan->top10Planets());
$smarty->display('top_planets.tpl');

echo('	</td>');
echo('	<td width="50%">');
	
$gala = new GalaxyData;
$smarty->assign('data', $gala->top10Galaxies());
$smarty->display('top_galaxies.tpl');

echo('		</td>');
echo('	</tr>');
echo('	<tr>');
echo('		<td>');

$alli = new AllianceData;
$smarty->assign('data', $alli->top5Alliances());
$smarty->display('top_alliances.tpl');
echo('		</td>');
echo('	</tr>');
echo('</table>');
include('include/footer.php');
?>