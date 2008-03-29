<table cellspacing="0" cellpadding="0" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="5">Military Scan on {$data.x}:{$data.y}:{$data.z} in tick {$data.tick}</th>
	</tr>
	<tr class="datahigh">
		<th>Ship</th>
		<th>Base</th>
		<th>Fleet1</th>
		<th>Fleet2</th>
		<th>Fleet3</th>
	</tr>
	{foreach from=$mili item="ship"}
	<tr class="{cycle values="odd,even"}">
		<td align="left">{$ship.ship}</td>
		<td align="right">{$ship.base}</td>
		<td align="right">{$ship.alpha}</td>
		<td align="right">{$ship.beta}</td>
		<td align="right">{$ship.gamma}</td>
	</tr>
	{/foreach}
</table>
</td>
</tr>
</table>