<header>
    <div class="head">
        <nav>
            <div class="menu">メニュー</div>
        </nav>
        <div class="left">
            <div class="title">My観光ページ</div>
        </div>
        <?php 
                echo "<div class=user_name>";
                echo htmlspecialchars($session_name) . 'さんこんにちは';
                echo "</div>";
            ?>
    </div>
</header>