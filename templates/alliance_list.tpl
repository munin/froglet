<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="15">Alliance listing</th>
	</tr>
	<tr class="header">
		<th colspan="5">Rank</th>
		<th colspan="6">&nbsp;</th>
		<th colspan="4">Growth</th>
	</tr>
	<tr class="header">
		<th>#</th>
		<th><a href="alliance.php?order=score_rank&dir=asc">Score</a></th>
		<th><a href="alliance.php?order=size_rank&dir=asc">Size</a></th>
		<th><a href="alliance.php?order=avg_score_rank&dir=asc">Av. Score</a></th>
		<th><a href="alliance.php?order=avg_size_rank&dir=asc">Av. Size</a></th>
		<th>Alliance</th>
		<th><a href="alliance.php?order=members&dir=desc">Members</a></th>
		<th><a href="alliance.php?order=avg_size&dir=desc">Av. Size</a></th>
		<th><a href="alliance.php?order=avg_score&dir=desc">Av. Score</a></th>
		<th><a href="alliance.php?order=size&dir=desc">Size</a></th>
		<th><a href="alliance.php?order=score&dir=desc">Score</a></th>
		<th>Av. Size</th>
		<th>Av. Score</th>
		<th>Size</th>
		<th>Score</th>
	</tr>
	{counter start=$page*50-50 print=false}
	{foreach from=$data item="alli"}
	<tr class="{cycle values="odd,even"}">
		<td>{counter}</td>
		<td align="right">{$alli.score_rank} {html_image file=$alli.score_rank_diff|rank_move_image title=$alli.score_rank_diff|growth_rank:$alli.score_rank}</td>
		<td align="right">{$alli.size_rank} {html_image file=$alli.size_rank_diff|rank_move_image title=$alli.size_rank_diff|growth_rank:$alli.size_rank}</td>
		<td align="right">{$alli.avg_score_rank} {html_image file=$alli.avg_score_rank_diff|rank_move_image title=$alli.avg_score_rank_diff|growth_rank:$alli.avg_score_rank}</td>
		<td align="right">{$alli.avg_size_rank} {html_image file=$alli.avg_size_rank_diff|rank_move_image title=$alli.avg_size_rank_diff|growth_rank:$alli.avg_size_rank}</td>
		<td><a href="alliance.php?name={$alli.name}" class="gray">{$alli.name}</a></td>
		<td align="right">{$alli.members}</td>
		<td align="right">{$alli.avg_size|number_format:"0"}</td>
		<td align="right">{$alli.avg_score|number_format:"0"}</td>
		<td align="right">{$alli.size|number_format:"0"}</td>
		<td align="right">{$alli.score|number_format:"0"}</td>
		<td align="right">{$alli.avg_size_growth|growth_roid:$alli.avg_size}</td>
		<td align="right">{$alli.avg_score_growth|growth:$alli.avg_score}</td>
		<td align="right">{$alli.size_growth|growth_roid:$alli.size}</td>
		<td align="right">{$alli.score_growth|growth:$alli.score}</td>
	</tr>
	{/foreach}
	<tr class="datahigh">
		<td colspan="15">Pages: {$count|paginate:$page:"order=$order&dir=$dir"}</td>
	</tr>
</table>
</td>
</tr>
</table>