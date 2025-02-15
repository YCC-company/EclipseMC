<?php
require 'db.php'; // データベース接続

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // 全プレイヤー情報を取得
    $stmt = $pdo->query("SELECT * FROM players");
    $players = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($players);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // POSTデータを取得
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["uuid"], $data["name"], $data["x"], $data["y"], $data["z"], $data["world"], $data["health"], $data["exp"], $data["inventory"])) {
        echo json_encode(["error" => "必要なデータが不足しています"]);
        exit;
    }

    // データを保存（INSERTまたはUPDATE）
    $stmt = $pdo->prepare("INSERT INTO players (uuid, name, x, y, z, world, health, exp, inventory, last_login)
                           VALUES (:uuid, :name, :x, :y, :z, :world, :health, :exp, :inventory, NOW())
                           ON DUPLICATE KEY UPDATE 
                           name = VALUES(name), x = VALUES(x), y = VALUES(y), z = VALUES(z), 
                           world = VALUES(world), health = VALUES(health), exp = VALUES(exp), 
                           inventory = VALUES(inventory), last_login = NOW()");

    $stmt->execute([
        ":uuid" => $data["uuid"],
        ":name" => $data["name"],
        ":x" => $data["x"],
        ":y" => $data["y"],
        ":z" => $data["z"],
        ":world" => $data["world"],
        ":health" => $data["health"],
        ":exp" => $data["exp"],
        ":inventory" => json_encode($data["inventory"])
    ]);

    echo json_encode(["status" => "success"]);
    exit;
}
?>
