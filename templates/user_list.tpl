<table cellspacing="0" cellpadding="0" width="100%" class="black">
<tr>
<td>
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="header">
		<th><a href="user.php?order=pnick">Pnick</a></th>
		<th><a href="user.php?order=timezone">Timezone</a></th>
	</tr>
	{foreach from=$data item="user"}
	<tr class="{cycle values="odd,even"}">
		<td><a href="user.php?pnick={$user.pnick}">{$user.pnick}</a></td>
		<td>{$user.pnick}</td>
	</tr>
	{/foreach}
	<tr class="datahigh">
		<td colspan="19">Pages: {$count|paginate:$page}</td>
	</tr>
</table>
</td>
</tr>
</table>