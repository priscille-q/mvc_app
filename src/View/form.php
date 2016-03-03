<!doctype html>
<html lang="en">
	<head>
		<title>Job role</title>
	</head>
	<form action="?c=index&a=index" method="post">
	    <table>
	        <tr>
	            <th>First name</th>
	            <th>Last name</th>
	            <th>Email Address</th>
	            <th>Job Role</th>
	            <th>Delete</th>
	        </tr>
			<?php
			for ($count = 1; 11 > $count; $count++)
			{
				if (empty($people[$count]['firstName']) && empty($people[$count]['lastName']) && empty($people[$count]['email']))
				{
					$required = '';
				}
				else
				{
					$required = 'required';
				}
			?>
				<tr>
					<td><input type="text" name="people[<?php echo $count; ?>][firstName]" value="<?php echo (isset($people[$count])) ? $people[$count]['firstName'] : ''; ?>" placeholder="Add new..." <?php echo $required; ?> /></td>
					<td><input type="text" name="people[<?php echo $count; ?>][lastName]" value="<?php echo (isset($people[$count])) ? $people[$count]['lastName'] : ''; ?>" placeholder="Add new..." <?php echo $required; ?> /></td>
					<td><input type="email" name="people[<?php echo $count; ?>][email]" value="<?php echo (isset($people[$count])) ? $people[$count]['email'] : ''; ?>" placeholder="Add new..." <?php echo $required; ?> /></td>
					<td>
						<select name="people[<?php echo $count; ?>][jobRoleId]" <?php echo $required; ?>>
							<?php
							 foreach ($jobRoleList as $role): ?>
								<option value="<?php echo $role->jobRoleId; ?>"
									<?php
										if (!empty($required))
										{
											if ($role->jobRoleId == $people[$count]['jobRoleId'])
											{
												echo 'selected';
											}
										}
									?> >
									<?php echo $role->role; ?>
								</option>
							<?php endforeach; ?>
						</select>
					<?php
						if ($required)
						{
					?>
							<td><input type="checkbox" name="people[<?php echo $count; ?>][delete]" value="1" /></td>
					<?php
						}
					?>

				</tr>
			<?php
			}
			?>
	    </table>
	    <input type="submit" value="Submit!" />
	</form>
</html>
