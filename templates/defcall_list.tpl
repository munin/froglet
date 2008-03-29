<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="datahigh">
		<th colspan="18">Defence calls</th>
	</tr>
	<tr class="header">
		<th><a href="defcall.php?order=defcall_id">ID</a></th>
		<th><a href="defcall.php?order=tx,ty,tz">Target</a></th>
		<th><a href="defcall.php?order=ox,oy,oz">Attacker</a></th>
		<th>Fleet</th>
		<th><a href="defcall.php?order=race">Race</a></th>
		<th>Ships</th>
		<th>Mission</th>
		<th><a href="defcall.php?order=eta_now">ETA</a></th>
		<th>Attacker</th>
		<th><a href="defcall.php?order=alliance">Alliance</a></th>
		<th><a href="defcall.php?order=roids_lost&dir=desc">Roids</a></th>
		<th><a href="defcall.php?order=claimed_by">DC</a></th>
		<th>Bcalc</th>
		<th><a href="defcall.php?order=status">Status</a></th>
		<th>Scan</th>
	</tr>
	{foreach from=$data item="call"}
		<tr class="{cycle values="odd,even"}">
			<td align="right"><a href="defcall.php?id={$call.defcall_id}">{$call.defcall_id}</a></td>
			<td align="right">{$call.tx}:{$call.ty}:{$call.tz}</td>
			<td align="right">{$call.ox}:{$call.oy}:{$call.oz}</td>
			<td>{$call.fleet}</td>
			<td class="{$call.race}">{$call.race}</td>
			<td align="right">{$call.ships|number_format:"0"}</td>
			<td>{$call.type}</td>
			<td align="right">{$call.eta_now} ({$call.eta})</td>
			<td>{$call.nick}</td>
			<td>{$call.name}</td>
			<td align="right">{$call.size} <span class="red">(-{$call.roids_lost|number_format:"0"})</span></td>
			<td>{$call.claimed_by}</td>
			<td>{$call.bcalc|bcalc:$call.bcalc}</td>
			<td class="{$call.status}">{$call.status}</td>
			<td>{$call.unit|scan:"U"} {$call.military|scan:"A"}</td>
		</tr>
	{/foreach}
</table>
</td>
</tr>
</table>