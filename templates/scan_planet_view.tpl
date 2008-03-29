<table cellspacing="0" cellpadding="0" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="4">Planet Scan {$data.x}:{$data.y}:{$data.z} in tick {$data.tick}</th>
	</tr>
	<tr class="datahigh">
		<th colspan="4">{$data.ruler_name} of {$data.planet_name} ({$data.race})</th>
	</tr>
	<tr class="header">
		<th>&nbsp;</th>
		<th align="right">Metal</th>
		<th align="right">Crystal</th>
		<th align="right">Eonium</th>
	</tr>
	<tr class="odd">
		<td>Asteroids</td>
		<td align="right">{$plan.roid_metal}</td>
		<td align="right">{$plan.roid_crystal}</td>
		<td align="right">{$plan.roid_eonium}</td>
	</tr>
	<tr class="even">
		<td>Resources</td>
		<td align="right">{$plan.res_metal}</td>
		<td align="right">{$plan.res_crystal}</td>
		<td align="right">{$plan.res_eonium}</td>
	</tr>
	<tr class="odd">
		<th align="right">Score</th>
		<td align="right">{$data.score}</td>
		<th align="right">Value</th>
		<td align="right">{$data.value}</td>
	</tr>
</table>
</td>
</tr>
</table>