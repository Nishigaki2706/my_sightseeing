<div class="user-up-content">
    <div class="spot-user">投稿者:<?php echo htmlspecialchars($all_spot_registers['user_name']); ?></div>
    <?php if(isset($all_spot_registers['spot_image'])):?>
        <p class="no_picture">写真が登録されていません。</p>
    <?php else:?>
        <img src="<?php echo htmlspecialchars($all_spot_registers['spot_file_path']); ?>" alt="">
    <?php endif;?>
    <div class="spot-name"><?php echo htmlspecialchars($all_spot_registers['spot_name']); ?></div>
    <div class="spot-place"><?php echo htmlspecialchars($all_spot_registers['spot_place']); ?></div>
    <div class="spot-date"><?php echo htmlspecialchars($all_spot_registers['spot_date']); ?></div>
    <div class="spot-thought"><?php echo htmlspecialchars($all_spot_registers['spot_thought']); ?></div>
</div>