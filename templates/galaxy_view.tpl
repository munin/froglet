<table cellspacing="1" cellpadding="3">
	<tr class="datahigh">
		<th colspan="2">Show galaxy</th>
	</tr>
	<tr class="header">
		<th>
			Search by coords:
		</th>
		<td>
			<form action="galaxy.php" method="post">
				<input type="text" name="x" size="4" value="{$gala.x}"/>
				<input type="text" name="y" size="4" value="{$gala.y}"/>
				<input type="submit" value="View"/>&nbsp;&nbsp;
				<input type="submit" name="left" value="<-"/>
				<input type="submit" name="right" value="->"/>
			</form>
		</td>
	</tr>
</table>
<p>&nbsp;</p>
<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="19">{$gala.name} &nbsp; ( {$gala.x}:{$gala.y} ) &nbsp; Score : {$gala.score|number_format:"0"}</th>
	</tr>
	<tr class="header">
		<th colspan="4">Universe Rank</th>
		<th colspan="10">&nbsp;</th>
		<th colspan="3">Growth</th>
		<th colspan="2">Intel</th>
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
		<th>Nick</th>
		<th>Alliance</th>
	</tr>
	{foreach from=$data item="plan"}
	<tr class="{cycle values="odd,even"}">
		<td align="right">{$plan.score_rank} {html_image file=$plan.score_rank_diff|rank_move_image title=$plan.score_rank_diff|growth_rank:$plan.score_rank}</td>
		<td align="right">{$plan.value_rank} {html_image file=$plan.value_rank_diff|rank_move_image title=$plan.value_rank_diff|growth_rank:$plan.value_rank}</td>
		<td align="right">{$plan.size_rank} {html_image file=$plan.size_rank_diff|rank_move_image title=$plan.size_rank_diff|growth_rank:$plan.size_rank}</td>
		<td align="right">{$plan.xp_rank} {html_image file=$plan.xp_rank_diff|rank_move_image title=$plan.xp_rank_diff|growth_rank:$plan.xp_rank}</td>
		<td align="right"><a href="cluster.php?x={$plan.x}">{$plan.x}</a></td>
		<td align="right"><a href="galaxy.php?x={$plan.x}&y={$plan.y}">{$plan.y}</a></td>
		<td align="right"><a href="planet.php?x={$plan.x}&y={$plan.y}&z={$plan.z}">{$plan.z}</a></td>
		<td>{$plan.ruler_name}</td>
		<td>{$plan.planet_name}</td>
		<td class="{$plan.race}">{$plan.race}</td>
		<td align="right">{$plan.size|number_format:"0"}</td>
		<td align="right">{$plan.value|number_format:"0"}</td>
		<td align="right">{$plan.score|number_format:"0"}</td>
		<td align="right">{$plan.xp|number_format:"0"}</td>
		<td align="right">{$plan.size_growth|growth_roid:$plan.size}</td>
		<td align="right">{$plan.value_growth|growth:$plan.value}</td>
		<td align="right">{$plan.score_growth|growth:$plan.score}</td>
		<td>{$plan.nick}</td>
		<td><a href="alliance.php?name={$plan.alliance_long}">{$plan.alliance_long}</a></td>
	</tr>
	{/foreach}
	<tr class="header">
		<td colspan="19" height="6"/>
	</tr>
	<tr class="datahigh">
		<td align="right">{$gala.score_rank} {html_image file=$gala.score_rank_diff|rank_move_image title=$gala.score_rank_diff|growth_rank:$gala.score_rank}</td>
		<td align="right">{$gala.value_rank} {html_image file=$gala.value_rank_diff|rank_move_image title=$gala.value_rank_diff|growth_rank:$gala.value_rank}</td>
		<td align="right">{$gala.size_rank} {html_image file=$gala.size_rank_diff|rank_move_image title=$gala.size_rank_diff|growth_rank:$gala.size_rank}</td>
		<td align="right">{$gala.xp_rank} {html_image file=$gala.xp_rank_diff|rank_move_image title=$gala.xp_rank_diff|growth_rank:$gala.xp_rank}</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right">{$gala.size|number_format:"0"}</td>
		<td align="right">{$gala.value|number_format:"0"}</td>
		<td align="right">{$gala.score|number_format:"0"}</td>
		<td align="right">{$gala.xp|number_format:"0"}</td>
		<td align="right">{$gala.size_growth|growth_roid:$gala.size}</td>
		<td align="right">{$gala.value_growth|growth:$gala.value}</td>
		<td align="right">{$gala.score_growth|growth:$gala.score}</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
</td>
</tr>
</table>