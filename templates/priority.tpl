<table cellspacing="0" cellpadding="0" class="black">
<tr>
<td>
<form action="priority.php" method="post">
<table cellspacing="1" cellpadding="3" width="100%">
	<tr class="header">
		<th>High:</th>
		<td><input type="text" name="high" value="{$data.high}"/></td>
	</tr>
	<tr class="header">
		<th>Medium:</th>
		<td><input type="text" name="medium" value="{$data.medium}"/></td>
	</tr>
	<tr class="header">
		<th>Low:</th>
		<td><input type="text" name="low" value="{$data.low}"/></td>
	</tr>
	<tr class="header">
		<th colspan="2"><input type="submit" value="Change priorities"/></th>
	</tr>
</table>
</form>
</td>
</tr>
</table>