<div class="up-content">
    <img src= "data:image/jpg;data:image/jpeg;data:image/png;base64,<?php echo $spot_registers['spot_file_path'] ;?>">
    <div class="spot-name"><?php echo htmlspecialchars($spot_registers['spot_name']); ?></div>
    <div class="spot-place"><?php echo htmlspecialchars($spot_registers['spot_place']); ?></div>
    <div class="spot-date"><?php echo htmlspecialchars($spot_registers['spot_date']); ?></div>
    <div class="spot-thought"><?php echo htmlspecialchars($spot_registers['spot_thought']); ?></div>
    <div class="other">
        <div class="edit"><a href="edit.php?id=<?php echo $spot_registers["id"] ;?>">編集</a></div>
        <div class="delete" id="spot-delete"><a href="spot-delete.php?id=<?php echo $spot_registers["id"] ;?>" onclick="spotDelete()">削除</a></div>
    </div>
</div>