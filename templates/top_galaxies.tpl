<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="header">
		<th colspan="4"><a href="galaxy.php" class="gray">Top Galaxies</a></th>
		<th>Size</th>
		<th>Score</th>
		<th colspan="2">Growth</th>
	</tr>
	{foreach from=$data item="gala"}
	<tr class="{cycle values="odd,even"}">
		<td align="right">{$gala.score_rank} {html_image file=$gala.score_rank_diff|rank_move_image title=$gala.score_rank_diff|growth_rank:$gala.score_rank}</td>
		<td align="right"><a href="cluster.php?x={$gala.x}">{$gala.x}</a></td>
		<td align="right"><a href="galaxy.php?x={$gala.x}&y={$gala.y}">{$gala.y}</a></td>
		<td>{$gala.name}</td>
		<td align="right">{$gala.size|number_format:"0"}</td>
		<td align="right">{$gala.score|number_format:"0"}</td>
		<td align="right">{$gala.size_growth|growth_roid:$gala.size}</td>
		<td align="right">{$gala.score_growth|growth:$gala.score}</td>
	</tr>
	{/foreach}
</table>
</td>
</tr>
</table>