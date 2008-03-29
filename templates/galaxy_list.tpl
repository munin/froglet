<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="15">Galaxy listing</th>
	</tr>
	<tr class="header">
		<th colspan="5">Rank</th>
		<th colspan="7">&nbsp;</th>
		<th colspan="3">Growth</th>
	</tr>
	<tr class="header">
		<th>#</th>
		<th><a href="galaxy.php?order=score_rank&dir=asc">Score</a></th>
		<th><a href="galaxy.php?order=value_rank&dir=asc">Value</a></th>
		<th><a href="galaxy.php?order=size_rank&dir=asc">Size</a></th>
		<th><a href="galaxy.php?order=xp_rank&dir=asc">XP</a></th>
		<th>X</th>
		<th>Y</th>
		<th>Name</th>
		<th><a href="galaxy.php?order=size&dir=desc">Size</a></th>
		<th><a href="galaxy.php?order=value&dir=desc">Value</a></th>
		<th><a href="galaxy.php?order=score&dir=desc">Score</a></th>
		<th><a href="galaxy.php?order=xp&dir=desc">XP</a></th>
		<th>Size</th>
		<th>Value</th>
		<th>Score</th>
	</tr>
	{counter start=$page*50-50 print=false}
	{foreach from=$data item="gala"}
	<tr class="{cycle values="odd,even"}">
		<td>{counter}</td>
		<td align="right">{$gala.score_rank} {html_image file=$gala.score_rank_diff|rank_move_image title=$gala.score_rank_diff|growth_rank:$gala.score_rank}</td>
		<td align="right">{$gala.value_rank} {html_image file=$gala.value_rank_diff|rank_move_image title=$gala.value_rank_diff|growth_rank:$gala.value_rank}</td>
		<td align="right">{$gala.size_rank} {html_image file=$gala.size_rank_diff|rank_move_image title=$gala.size_rank_diff|growth_rank:$gala.size_rank}</td>
		<td align="right">{$gala.xp_rank} {html_image file=$gala.xp_rank_diff|rank_move_image title=$gala.xp_rank_diff|growth_rank:$gala.xp_rank}</td>
		<td align="right"><a href="cluster.php?x={$gala.x}">{$gala.x}</a></td>
		<td align="right"><a href="galaxy.php?x={$gala.x}&y={$gala.y}">{$gala.y}</a></td>
		<td>{$gala.name}</td>
		<td align="right">{$gala.size|number_format:"0"}</td>
		<td align="right">{$gala.value|number_format:"0"}</td>
		<td align="right">{$gala.score|number_format:"0"}</td>
		<td align="right">{$gala.xp|number_format:"0"}</td>
		<td align="right">{$gala.size_growth|growth_roid:$gala.size}</td>
		<td align="right">{$gala.value_growth|growth:$gala.value}</td>
		<td align="right">{$gala.score_growth|growth:$gala.score}</td>
	</tr>
	{/foreach}
	<tr class="datahigh">
		<td colspan="15">Pages: {$count|paginate:$page:"order=$order&dir=$dir"}</td>
	</tr>
</table>
</td>
</tr>
</table>