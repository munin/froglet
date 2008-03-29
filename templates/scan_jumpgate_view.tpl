<table cellspacing="0" cellpadding="0" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="5">Jumpgate Probe on {$data.x}:{$data.y}:{$data.z} in tick {$data.tick}</th>
	</tr>
	<tr class="header">
		<td align="right">Origin</td>
		<td align="right">Mission</td>
		<td align="right">Fleet</td>
		<td align="right">ETA</td>
		<td align="right">Fleetsize</td>
	</tr>
	{foreach from=$jgp item="fleet"}
	<tr class="{cycle values="odd,even"}">
		<td align="right">{$fleet.x}:{$fleet.y}:{$fleet.z}</td>
		<td align="right">{$fleet.mission}</td>
		<td align="right">{$fleet.fleet}</td>
		<td align="right">{$fleet.eta}</td>
		<td align="right">{$fleet.ships}</td>
	</tr>
	{/foreach}
</table>
</td>
</tr>
</table>