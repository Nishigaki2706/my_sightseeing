<div class="up-content">
    <?php if(isset($spot_registers['spot_image'])):?>
        <p class="no_picture">写真が登録されていません。</p>
    <?php else:?>
        <img src="<?php echo htmlspecialchars($spot_registers['spot_file_path']); ?>" alt="">
    <?php endif;?>
    <div class="spot-name"><?php echo htmlspecialchars($spot_registers['spot_name']); ?></div>
    <div class="spot-place"><?php echo htmlspecialchars($spot_registers['spot_place']); ?></div>
    <div class="spot-date"><?php echo htmlspecialchars($spot_registers['spot_date']); ?></div>
    <div class="spot-thought"><?php echo htmlspecialchars($spot_registers['spot_thought']); ?></div>
    <div class="other">
        <div class="edit"><a href="edit.php?id=<?php echo $spot_registers["id"] ;?>">編集</a></div>
        <div class="delete"><a href="spot-delete.php?id=<?php echo $spot_registers["id"] ;?>">削除</a></div>
    </div>
</div>