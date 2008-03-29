<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="5">Planet listing</th>
	</tr>
	<tr class="header">
		<th><a href="planet.php?action=nicks&order=x,y,z">Coords</a></th>
		<th><a href="planet.php?action=nicks&order=nick">Nick</a></th>
		<th><a href="planet.php?action=nicks&order=fakenick">Fakenick</a></th>
		<th><a href="planet.php?action=nicks&order=alliance">Alliance</a></th>
	</tr>
	{foreach from=$data item="plan"}
	<tr class="{cycle values="odd,even"}">
		<td><a href="planet.php?x={$plan.x}&y={$plan.y}&z={$plan.z}">{$plan.x}:{$plan.y}:{$plan.z}</a></td>
		<td>{$plan.nick}</td>
		<td>{$plan.fakenick}</td>
		<td>{$plan.alliance}</td>
	</tr>
	</tr>
	{/foreach}
	<!--<tr class="datahigh">
		<td colspan="5">Pages: {$count|paginate:$page:"action=nicks&order=$order"}</td>
	</tr>-->
</table>
</td>
</tr>
</table>