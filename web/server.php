<?php
header("Content-Type: application/json");

// 仮のサーバーデータ
$data = [
    "status" => "オンライン",
    "players" => ["Player1", "Player2", "Player3"]
];

echo json_encode($data);
?>
