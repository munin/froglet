<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="17">Your current status</th>
	</tr>
	<tr class="header">
		<th colspan="4">Rank</th>
		<th colspan="10">&nbsp;</th>
		<th colspan="3">Growth</th>
	</tr>
	<tr class="header">
		<th>Score</th>
		<th>Value</th>
		<th>Size</th>
		<th>XP</th>
		<th>X</th>
		<th>Y</th>
		<th>Z</th>
		<th>Ruler</th>
		<th>Planet</th>
		<th>Race</th>
		<th>Size</th>
		<th>Value</th>
		<th>Score</th>
		<th>XP</th>
		<th>Size</th>
		<th>Value</th>
		<th>Score</th>
	</tr>
	<tr class="odd">
		<td align="right">{$data.score_rank} {html_image file=$data.score_rank_diff|rank_move_image title=$data.score_rank_diff|growth_rank:$data.score_rank}</td>
		<td align="right">{$data.value_rank} {html_image file=$data.value_rank_diff|rank_move_image title=$data.value_rank_diff|growth_rank:$data.value_rank}</td>
		<td align="right">{$data.size_rank} {html_image file=$data.size_rank_diff|rank_move_image title=$data.size_rank_diff|growth_rank:$data.size_rank}</td>
		<td align="right">{$data.xp_rank} {html_image file=$data.xp_rank_diff|rank_move_image title=$data.xp_rank_diff|growth_rank:$data.xp_rank}</td>
		<td align="right">{$data.x}</td>
		<td align="right">{$data.y}</td>
		<td align="right">{$data.z}</td>
		<td>{$data.ruler_name}</td>
		<td>{$data.planet_name}</td>
		<td class="{$data.race}">{$data.race}</td>
		<td align="right">{$data.size|number_format:"0"}</td>
		<td align="right">{$data.value|number_format:"0"}</td>
		<td align="right">{$data.score|number_format:"0"}</td>
		<td align="right">{$data.xp|number_format:"0"}</td>
		<td align="right">{$data.size_growth|growth_roid:$data.size}</td>
		<td align="right">{$data.value_growth|growth:$data.value}</td>
		<td align="right">{$data.score_growth|growth:$data.score}</td>
	</tr>
</table>
</td>
</tr>
</table>
<p>&nbsp;</p>