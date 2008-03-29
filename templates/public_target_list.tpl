<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="11">Planet listing</th>
	</tr>
	<tr class="header">
		<th><a href="public_target.php?order=x,y,z&dir=asc">X</a></th>
		<th><a href="public_target.php?order=y,x,z&dir=asc">Y</a></th>
		<th><a href="public_target.php?order=z,x,y&dir=asc">Z</a></th>
		<th>Ruler</th>
		<th>Planet</th>
		<th><a href="public_target.php?order=race,size&dir=desc">Race</a></th>
		<th><a href="public_target.php?order=size&dir=desc">Size</a></th>
		<th><a href="public_target.php?order=value&dir=desc">Value</a></th>
		<th><a href="public_target.php?order=score&dir=desc">Score</a></th>
		<th><a href="public_target.php?order=xp&dir=desc">XP</a></th>
		<th>Scans</th>
	</tr>
	{foreach from=$data item="plan"}
	<tr class="{cycle values="odd,even"}">
		<td align="right">{$plan.x}</td>
		<td align="right">{$plan.y}</td>
		<td align="right">{$plan.z}</td>
		<td>{$plan.ruler_name|napped:$plan.nap}</td>
		<td>{$plan.planet_name|napped:$plan.nap}</td>
		<td class="{$plan.race}">{$plan.race}</td>
		<td align="right">{$plan.size|number_format:"0"}</td>
		<td align="right">{$plan.value|number_format:"0"}</td>
		<td align="right">{$plan.score|number_format:"0"}</td>
		<td align="right">{$plan.xp|number_format:"0"}</td>
		<td>{$plan.planet|scan:"P"} {$plan.unit|scan:"U"} {$plan.jumpgate|scan:"J"} {$plan.military|scan:"M"}</td>
	</tr>
	{/foreach}
	<tr class="datahigh">
		<td colspan="11">Pages: {$count|paginate:$page:"order=$order&dir=$dir"}</td>
	</tr>
</table>
</td>
</tr>
</table>