'use strick';
// Myページを作るボタンを押したらspot.phpへ

function frameClick() {
    document.location.href = "spot.php";
};

// myページ削除確認画面
function spotDelete() {
    document.getElementById("spot-delete").onclick = function(){
        alert('本当に削除しますか？');
    }
}
