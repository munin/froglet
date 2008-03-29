<table cellspacing="0" cellpadding="0" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="2">Unit Scan on {$data.x}:{$data.y}:{$data.z} in tick {$data.tick}</th>
	</tr>
	{foreach from=$unit item="ship"}
	<tr class="{cycle values="odd,even"}">
		<td align="left">{$ship.ship}</td>
		<td align="right">{$ship.count}</td>
	</tr>
	{/foreach}
</table>
</td>
</tr>
</table>