<?php
// セッション開始（ログイン機能を後で追加）
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minecraft Server Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="sidebar">
        <h2>管理メニュー</h2>
        <ul>
            <li><a href="#">ダッシュボード</a></li>
            <li><a href="#">プレイヤー管理</a></li>
            <li><a href="#">サーバー設定</a></li>
            <li><a href="#">ログ管理</a></li>
        </ul>
    </div>
    
    <div class="main-content">
        <h1>サーバーダッシュボード</h1>
        <div class="server-status">
            <p>サーバーステータス: <span id="server-status">取得中...</span></p>
            <button onclick="fetchServerStatus()">更新</button>
        </div>

        <div id="player-list">
            <h2>オンラインプレイヤー</h2>
            <ul id="players"></ul>
        </div>
    </div>

    <script>
        function fetchServerStatus() {
            $.ajax({
                url: "server.php",
                type: "GET",
                success: function(data) {
                    let response = JSON.parse(data);
                    $("#server-status").text(response.status);
                    $("#players").empty();
                    response.players.forEach(player => {
                        $("#players").append("<li>" + player + "</li>");
                    });
                }
            });
        }
        fetchServerStatus();
    </script>
</body>
</html>
