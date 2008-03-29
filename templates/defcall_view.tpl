<table cellspacing="0" cellpadding="0" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3">
	<tr class="datahigh">
		<th colspan="7">Attacked planet</th>
	</tr>
	<tr class="header">
		<th>Target</th>
		<th>Race</th>
		<th>Size</th>
		<th>Value</th>
		<th>Score</th>
		<th>XP</th>
		<th>Nick</th>
	</tr>
	<tr class="odd">
		<td>{$call.x}:{$call.y}:{$call.z}</td>
		<td class="{$call.race}">{$call.race}</td>
		<td>{$call.size|number_format:"0"}</td>
		<td>{$call.value|number_format:"0"}</td>
		<td>{$call.score|number_format:"0"}</td>
		<td>{$call.xp|number_format:"0"}</td>
		<td>{$call.nick}</td>
	</tr>
</table>
</td>
</tr>
</table>
<p>&nbsp;</p>
<table cellspacing="0" cellpadding="0" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3">
	<tr class="datahigh">
		<th colspan="13">Attacking fleets</th>
	</tr>
	<tr class="header">
		<th colspan="6">Attacker</th>
		<th colspan="3">Intel</th>
		<th colspan="4">Stats</th>
	</tr>
	<tr class="header">
		<th>Origin</th>
		<th>Fleet</th>
		<th>Race</th>
		<th>Ships</th>
		<th>ETA</th>
		<th>Reported by</th>
		<th>Nick</th>
		<th>Alliance</th>
		<th>Status</th>
		<th>Size</th>
		<th>Value</th>
		<th>Score</th>
		<th>XP</th>
	</tr>
	{foreach from=$data item="fleet"}
	<tr class="{cycle values="odd,even"}">
		<td>{$fleet.ox}:{$fleet.oy}:{$fleet.oz}</td>
		<td>{$fleet.fleet}</td>
		<td class="{$fleet.race}">{$fleet.race}</td>
		<td>{$fleet.ships}</td>
		<td>{$fleet.eta_now} ({$fleet.eta})</td>
		<td>{$fleet.added_by}</td>
		<td>{$fleet.nick}</td>
		<td>{$fleet.alliance}</td>
		<td>{$fleet.status}</td>
		<td>{$fleet.size|number_format:"0"}</td>
		<td>{$fleet.value|number_format:"0"}</td>
		<td>{$fleet.score|number_format:"0"}</td>
		<td>{$fleet.xp|number_format:"0"}</td>
	</tr>
	{/foreach}	
</table>
</td>
</tr>
</table>