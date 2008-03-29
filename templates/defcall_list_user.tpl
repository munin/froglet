<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="13">Your defence calls</th>
	</tr>
	<tr class="header">
		<th>ID</th>
		<th>Target</th>
		<th>Attacker</th>
		<th>Fleet</th>
		<th>Race</th>
		<th>Ships</th>
		<th>ETA</th>
		<th>Roids</th>
		<th>DC</th>
		<th>Bcalc</th>
		<th>Priority</th>
		<th>Status</th>
		<th>Reported by</th>
	</tr>
	{foreach from=$data item="call"}
		<tr class="{cycle values="odd,even"}">
			<td align="right">{$call.defcall_id}</td>
			<td align="right">{$call.tx}:{$call.ty}:{$call.tz}</td>
			<td align="right">{$call.ox}:{$call.oy}:{$call.oz}</td>
			<td>{$call.fleet}</td>
			<td class="{$call.race}">{$call.race}</td>
			<td align="right">{$call.ships|number_format:"0"}</td>
			<td align="right">{$call.eta_now} ({$call.eta})</td>
			<td align="right">{$call.size} <span class="red">(-{$call.roids_lost|number_format:"0"})</span></td>
			<td>{$call.claimed_by}</td>
			<td><a href="{$call.bcalc}" target="_blank">{$call.bcalc}</a></td>
			<td>{$call.priority}</td>
			<td class="{$call.status}">{$call.status}</td>
			<td>{$call.added_by}</td>
		</tr>
	{/foreach}
</table>
</td>
</tr>
</table>