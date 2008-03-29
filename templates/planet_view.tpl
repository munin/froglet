<table cellspacing="1" cellpadding="3">
	<tr class="datahigh">
		<th colspan="2">Show planet</th>
	</tr>
	<tr class="header">
		<th>
			Search by coords:
		</th>
		<td>
			<form action="planet.php" method="post">
				<input type="text" name="x" size="4" value="{$data.x}"/>
				<input type="text" name="y" size="4" value="{$data.y}"/>
				<input type="text" name="z" size="4" value="{$data.z}"/>
				<input type="submit" value="View"/>
			</form>
		</td>
	</tr>
	<tr class="header">
		<th>
			Search by nick:
		</th>
		<td>
			<form action="planet.php" method="post">
				<input type="text" name="nick_search" size="10" value="{$data.nick}"/>
				<input type="submit" value="Find"/>
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
		<th colspan="19">Current status</th>
	</tr>
	<tr class="header">
		<th colspan="4">Rank</th>
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
	<tr class="odd">
		<td align="right">{$data.score_rank} {html_image file=$data.score_rank_diff|rank_move_image title=$data.score_rank_diff|growth_rank:$data.score_rank}</td>
		<td align="right">{$data.value_rank} {html_image file=$data.value_rank_diff|rank_move_image title=$data.value_rank_diff|growth_rank:$data.value_rank}</td>
		<td align="right">{$data.size_rank} {html_image file=$data.size_rank_diff|rank_move_image title=$data.size_rank_diff|growth_rank:$data.size_rank}</td>
		<td align="right">{$data.xp_rank} {html_image file=$data.xp_rank_diff|rank_move_image title=$data.xp_rank_diff|growth_rank:$data.xp_rank}</td>
		<td align="right"><a href="cluster.php?x={$data.x}">{$data.x}</a></td>
		<td align="right"><a href="galaxy.php?x={$data.x}&y={$data.y}">{$data.y}</a></td>
		<td align="right"><a href="planet.php?x={$data.x}&y={$data.y}&z={$data.z}">{$data.z}</a></td>
		<td>{$data.ruler_name|napped:$data.nap}</td>
		<td>{$data.planet_name|napped:$data.nap}</td>
		<td class="{$data.race}">{$data.race}</td>
		<td align="right">{$data.size|number_format:"0"}</td>
		<td align="right">{$data.value|number_format:"0"}</td>
		<td align="right">{$data.score|number_format:"0"}</td>
		<td align="right">{$data.xp|number_format:"0"}</td>
		<td align="right">{$data.size_growth|growth_roid:$data.size}</td>
		<td align="right">{$data.value_growth|growth:$data.value}</td>
		<td align="right">{$data.score_growth|growth:$data.score}</td>
		<td>{$data.nick}</td>
		<td>{$data.alliance}</td>
	</tr>
</table>
</td>
</tr>
</table>
<p>&nbsp;</p>
<center><img src="planet_graph.php?x={$data.x}&y={$data.y}&z={$data.z}"></center>
<p>&nbsp;</p>
<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="6">Outgoing fleets</th>
	</tr>
	<tr class="header">
		<th>Target</th>
		<th>Alliance</th>
		<th>Fleet</th>
		<th>Ships</th>
		<th>Mission</th>
		<th>Landing Tick</th>
	</tr>
	{foreach from=$outgoing item="action"}
	<tr class="{$action.mission}">
		<td><a href="planet.php?x={$action.x}&y={$action.y}&z={$action.z}" class="gray">{$action.x}:{$action.y}:{$action.z}</a></td>
		<td>{$action.name}</td>
		<td>{$action.fleet_name}</td>
		<td>{$action.fleet_size}</td>
		<td>{$action.mission}</td>
		<td>{$action.landing_tick}</td>
	</tr>
	{/foreach}
</table>
</td>
</tr>
</table>
<p>&nbsp;</p>
<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="6">Incoming fleets</th>
	</tr>
	<tr class="header">
		<th>Origin</th>
		<th>Alliance</th>
		<th>Fleet</th>
		<th>Ships</th>
		<th>Mission</th>
		<th>Landing Tick</th>
	</tr>
	{foreach from=$incoming item="action"}
	<tr class="{$action.mission}">
		<td><a href="planet.php?x={$action.x}&y={$action.y}&z={$action.z}" class="gray">{$action.x}:{$action.y}:{$action.z}</a></td>
		<td>{$action.name}</td>
		<td>{$action.fleet_name}</td>
		<td>{$action.fleet_size}</td>
		<td>{$action.mission}</td>
		<td>{$action.landing_tick}</td>
	</tr>
	{/foreach}
</table>
</td>
</tr>
</table>