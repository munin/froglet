<?php
include('include/header.php');
include('include/priority_data.php');
include('include/user_data.php');
include('include/planet_data.php');
include('include/defcall_data.php');
?>
<?php
if(isset($_GET['action']) && ($_GET['action'] == "login"))
{
	$smarty->display('login.tpl');
}
else
{
	echo('<table width="100%">');
	echo('	<tr>');
	echo('		<td width="50%">');
	if (isset($_SESSION['USER']) && !empty($_SESSION['USER']))
	{
		$planet = new PlanetData;
		$planet->username = $_SESSION['USER'];
		
		$defcall = new DefcallData;
		$defcall->username = $_SESSION['USER'];
		$defcall->order = 'defcall_id';
		$defcall->eta_low = 0;
		$defcall->eta_high = 14;
		
		$smarty->assign('data', $planet->selectPlanet());
		$smarty->display('planet_view_user.tpl');
		
		$smarty->assign('data', $defcall->listDefcalls());
		$smarty->display('defcall_list_user.tpl');
	}
?>
<p>&nbsp;</p>
<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td width="33%">
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="13">Battle calculators</th>
	</tr>
	<tr class="odd">
		<td><a href="http://bcalc.visionhq.org" target="_blank">VSN bcalc</a></td>
	</tr>
	<tr class="even">
		<td><a href="http://bcalc.lch-hq.org/" target="_blank">LCH bcalc</a></td>
	</tr>
	<tr class="odd">
		<td><a href="http://thrud.co.uk/bcalc/" target="_blank">Thrud's bcalc</a></td>
	</tr>
	<tr class="even">
		<td>&nbsp;</td>
	</tr>
</table>
</td>
<td width="33%">
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="13">Parsers</th>
	</tr>
	<tr class="odd">
		<td><a href="http://parser.exilition.org/" target="_blank">eXilition parser</a></td>
	</tr>
	<tr class="even">
		<td><a href="http://parser.visionhq.org" target="_blank">VSN parser</a></td>
	</tr>
	<tr class="odd">
		<td><a href="http://parser.lch-hq.org/" target="_blank">LCH parser</a></td>
	</tr>
	<tr class="even">
		<td>&nbsp;</td>
	</tr>
</table>
</td>
<td width="34%">
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="13">Tools</th>
	</tr>
	<tr class="odd">
		<td><a href="http://sandmans.co.uk/" target="_blank">Sandmans</a></td>
	</tr>
	<tr class="even">
		<td><a href="http://www.pilkara.com/" target="_blank">Pilkara</a></td>
	</tr>
	<tr class="odd">
		<td><a href="http://patools.thrud.co.uk/" target="_blank">Thrud's planetarion tools</a></td>
	</tr>
	<tr class="even">
		<td><a href="http://www.lch-hq.org/lch/ccalc/" target="_blank">Covert ops calculator</a></td>
	</tr>
</table>
</td>
</tr>
</table>
<?php
}
echo('		</td>');
echo('	</tr>');
echo('</table>');
include('include/footer.php');
?>