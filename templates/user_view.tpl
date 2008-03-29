<table cellspacing="0" cellpadding="0" class="black">
<tr>
<td>
<form action="user.php" method="post">
<table cellspacing="1" cellpadding="3">
	<tr class="datahigh">
		<th colspan="19">Current status</th>
	</tr>
	<tr class="header">
		<th>Username</th>
		<td><input type="text" name="username" value="{$data.username}"/></td>
	</tr>
	<tr class="header">
		<th>Pnick</th>
		<td><input type="text" name="pnick" value="{$data.pnick}"/></td>
	</tr>
	<tr class="header">
		<th>Timezone</th>
		<td>{html_options name=timezone options=$options selected=$data.timezone}</td>
	</tr>
	<tr class="header">
		<th>Phone</th>
		<td><input type="text" name="phone" value="{$data.phone}"/></td>
	</tr>
	<tr class="header">
		<th>E-mail</th>
		<td><input type="text" name="email" value="{$data.email}" size="30"/></td>
	</tr>
	<tr class="header">
		<th>Force nodef:</th>
		<td>{html_radios name=force_nodef options=$bool selected=$data.force_nodef separator=" "}</td>
	</tr>
	<tr class="header">
		<th colspan="2"><input type="submit" name="update" value="Update details"/></th>
	</tr>
</table>
</form>
</td>
</tr>
</table>