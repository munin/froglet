<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="header">
		<th colspan="2"><a href="alliance.php" class="gray">Top Alliances</a></th>
		<th>Members</th>
		<th>Av. Size</th>
		<th>Av. Score</th>
		<th>Size</th>
		<th>Score</th>
		<th colspan="2">Growth</th>
	</tr>
	{foreach from=$data item="alli"}
	<tr class="{cycle values="odd,even"}">
		<td align="right">{$alli.score_rank} {html_image file=$alli.score_rank_diff|rank_move_image title=$alli.score_rank_diff|growth_rank:$alli.score_rank}</td>
		<td><a href="alliance_view.php?name={$alli.name}" class="gray">{$alli.name}</a></td>
		<td align="right">{$alli.members|number_format:"0"}</td>
		<td align="right">{$alli.avgsize|number_format:"0"}</td>
		<td align="right">{$alli.avgscore|number_format:"0"}</td>
		<td align="right">{$alli.size|number_format:"0"}</td>
		<td align="right">{$alli.score|number_format:"0"}</td>
		<td align="right">{$alli.size_growth|growth_roid:$alli.size}</td>
		<td align="right">{$alli.score_growth|growth:$alli.score}</td>
	</tr>
	{/foreach}
</table>
</td>
</tr>
</table>