<div class="user-up-content">
    <div class="spot-user">投稿者:<?php echo htmlspecialchars($all_spot_registers['user_name']); ?></div>
    <img src="data:image/jpg;data:image/jpeg;data:image/png;base64,<?php echo $all_spot_registers['spot_file_path']; ?>">
    <div class="spot-name"><?php echo htmlspecialchars($all_spot_registers['spot_name']); ?></div>
    <div class="spot-place"><?php echo htmlspecialchars($all_spot_registers['spot_place']); ?></div>
    <div class="spot-date"><?php echo htmlspecialchars($all_spot_registers['spot_date']); ?></div>
    <div class="spot-thought"><?php echo htmlspecialchars($all_spot_registers['spot_thought']); ?></div>
</div>
