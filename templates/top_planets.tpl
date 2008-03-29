<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="header">
		<th colspan="6"><a href="planet.php" class="gray">Top Planets</a></th>
		<th>Size</th>
		<th>Score</th>
		<th colspan="2">Growth</th>
		<th>Alliance</th>
	</tr>
	{foreach from=$data item="plan"}
	<tr class="{cycle values="odd,even"}">
		<td align="right">{$plan.score_rank} {html_image file=$plan.score_rank_diff|rank_move_image title=$plan.score_rank_diff|growth_rank:$plan.score_rank}</td>
		<td align="right"><a href="cluster.php?x={$plan.x}">{$plan.x}</a></td>
		<td align="right"><a href="galaxy.php?x={$plan.x}&y={$plan.y}">{$plan.y}</a></td>
		<td align="right"><a href="planet.php?x={$plan.x}&y={$plan.y}&z={$plan.z}">{$plan.z}</a></td>
		<td>{$plan.planet_name}</td>
		<td class="{$plan.race}">{$plan.race}</td>
		<td align="right">{$plan.size|number_format:"0"}</td>
		<td align="right">{$plan.score|number_format:"0"}</td>
		<td align="right">{$plan.size_growth|growth_roid:$plan.size}</td>
		<td align="right">{$plan.score_growth|growth:$plan.score}</td>
		<td>{$plan.alliance}</td>
	</tr>
	{/foreach}
</table>
</td>
</tr>
</table>