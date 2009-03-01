<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="21">Alliance intel</th>
	</tr>
	<tr class="header">
		<th>&nbsp;</th>
		<th colspan="9">Rank</th>
		<th colspan="10">&nbsp;</th>
		<th colspan="3">Growth</th>
		<th colspan="1">Intel</th>
	</tr>
	<tr class="header">
		<th>#</th>
		<th><a href="alliance.php?name={$alli}&order=score_rank&dir=asc">Score</a></th>
		<th><a href="alliance.php?name={$alli}&order=value_rank&dir=asc">Value</a></th>
		<th><a href="alliance.php?name={$alli}&order=size_rank&dir=asc">Size</a></th>
		<th><a href="alliance.php?name={$alli}&order=xp_rank&dir=asc">XP</a></th>
		<th><a href="alliance.php?name={$alli}&order=galvaluerank&dir=desc>G. Value</a></th>
		<th><a href="alliance.php?name={$alli}&order=galsizerank&dir=desc>G. Size</a></th>
		<th><a href="alliance.php?name={$alli}&order=x,y,z&dir=asc">X</a></th>
		<th><a href="alliance.php?name={$alli}&order=y,x,z&dir=asc">Y</a></th>
		<th><a href="alliance.php?name={$alli}&order=z,x,y&dir=asc">Z</a></th>
		<th>Ruler</th>
		<th>Planet</th>
		<th><a href="alliance.php?name={$alli}&order=race,size&dir=desc">Race</a></th>
		<th><a href="alliance.php?name={$alli}&order=size&dir=desc">Size</a></th>
		<th><a href="alliance.php?name={$alli}&order=value&dir=desc">Value</a></th>
		<th><a href="alliance.php?name={$alli}&order=score&dir=desc">Score</a></th>
		<th><a href="alliance.php?name={$alli}&order=xp&dir=desc">XP</a></th>
		<th><a href="alliance.php?name={$alli}&order=size_growth&dir=desc">Size</a></th>
		<th><a href="alliance.php?name={$alli}&order=value_growth&dir=desc">Value</a></th>
		<th><a href="alliance.php?name={$alli}&order=score_growth&dir=desc">Score</a></th>
		<th><a href="alliance.php?name={$alli}&order=nick&dir=asc">Nick</a></th>
	</tr>
	{counter start=$page*50-50 print=false}
	{foreach name="p" from=$data item="plan"}
	<tr class="{cycle values="odd,even"}">
		<td><!--{$smarty.foreach.p.iteration}-->{counter}</td>
		<td align="right">{$plan.score_rank} {html_image file=$plan.score_rank_diff|rank_move_image title=$plan.score_rank_diff|growth_rank:$plan.score_rank}</td>
		<td align="right">{$plan.value_rank} {html_image file=$plan.value_rank_diff|rank_move_image title=$plan.value_rank_diff|growth_rank:$plan.value_rank}</td>
		<td align="right">{$plan.size_rank} {html_image file=$plan.size_rank_diff|rank_move_image title=$plan.size_rank_diff|growth_rank:$plan.size_rank}</td>
		<td align="right">{$plan.xp_rank} {html_image file=$plan.xp_rank_diff|rank_move_image title=$plan.xp_rank_diff|growth_rank:$plan.xp_rank}</td>
		<td align="right">{$plan.galvaluerank}</td>
		<td align="right">{$plan.galsizerank}</td>
		<td align="right"><a href="cluster.php?x={$plan.x}">{$plan.x}</a></td>
		<td align="right"><a href="galaxy.php?x={$plan.x}&y={$plan.y}">{$plan.y}</a></td>
		<td align="right"><a href="planet.php?x={$plan.x}&y={$plan.y}&z={$plan.z}">{$plan.z}</a></td>
		<td>{$plan.ruler_name|napped:$plan.nap}</td>
		<td>{$plan.planet_name|napped:$plan.nap}</td>
		<td class="{$plan.race}">{$plan.race}</td>
		<td align="right">{$plan.size|number_format:"0"}</td>
		<td align="right">{$plan.value|number_format:"0"}</td>
		<td align="right">{$plan.score|number_format:"0"}</td>
		<td align="right">{$plan.xp|number_format:"0"}</td>
		<td align="right">{$plan.size_growth|growth_roid:$plan.size}</td>
		<td align="right">{$plan.value_growth|growth:$plan.value}</td>
		<td align="right">{$plan.score_growth|growth:$plan.score}</td>
		<td>{$plan.nick}</td>
	</tr>
	{/foreach}
	<tr class="datahigh">
		<td colspan="19">Pages: {$count|paginate:$page:"name=$alli&order=$order&dir=$dir"}</td>
	</tr>
</table>
</td>
</tr>
</table>