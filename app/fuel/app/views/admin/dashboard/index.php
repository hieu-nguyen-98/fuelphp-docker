<form action="">
	<select name="team_id" id="">
		<?php foreach($teams  as $team): ?>
			<option value="<?= $team->id ?>" <?= isset($teamId) && $teamId == $team->id ? 'selected' : '' ?>>
				<?= htmlspecialchars($team->name) ?>
			</option>
		<?php endforeach ?> 
	</select>

		<label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" value="<?= htmlspecialchars($start_date) ?>" min=<?php echo $first_day_of_month ?> max="<?php echo $today; ?>">

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" value="<?= htmlspecialchars($end_date) ?>" max="<?php echo $today; ?>" min="<?php echo $first_day_of_month ?>">
	<button type="submit">search</button>
</form>
<table>
    <thead>
        <tr>
            <th>Team</th>
            <th>User</th>
            <?php foreach ($dates as $date): ?>
                <th>Task(<?php echo $date; ?>)</th>
            <?php endforeach; ?>
            <th>Note</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
		<?php if (!empty($report_data_by_user)): ?>
			<?php foreach ($report_data_by_user as $key => $data): ?>
				<tr>
					<td><?= htmlspecialchars($data['team_name']) ?></td> <!-- Hiển thị tên team -->
					<td><?= htmlspecialchars($data['user_id']) ?></td>
					<?php foreach ($dates as $date): ?>
						<td>
							<strong>Tasks:</strong> <?= isset($data['tasks'][$date]) ? htmlspecialchars($data['tasks'][$date]) : 'No tasks' ?><br>
						</td>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="<?= count($dates) + 2 ?>">No data available for the selected date range.</td>
			</tr>
		<?php endif; ?>
    </tbody>
</table>