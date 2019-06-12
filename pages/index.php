<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Omok</title>

    <link href="//fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
    <style>
        html {
            font-family: 'Nanum Gothic', sans-serif;
        }
    </style>
    <link rel="stylesheet" href="pages/assets/css/reset.css">
    <link rel="stylesheet" href="pages/assets/css/board.css">
    <link rel="stylesheet" href="pages/assets/css/button.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="pages/assets/js/query.min.js"></script>
    <script src="pages/assets/js/object/math.js"></script>
    <script src="pages/assets/js/object/array.js"></script>
    <script src="pages/assets/js/game/core.js"></script>
    <script src="pages/assets/js/game/stone.js"></script>
    <script src="pages/assets/js/game/ban.js"></script>
    <script src="pages/assets/js/game/win.js"></script>
    <script src="pages/assets/js/canvas/get.js"></script>
    <script src="pages/assets/js/canvas/stone.js"></script>
    <script src="pages/assets/js/canvas/board.js"></script>
    <script src="pages/assets/js/user/select.js"></script>
    <script src="pages/assets/js/user/keyboard.js"></script>
    <script src="pages/assets/js/AI/core.js"></script>
    <script src="pages/assets/js/AI/test.js"></script>
</head>
<body>
<?php
$game_result = PostAct(getAPISUrl(), array(array('a', 'omok_tick'), array('apiv', getAPIVersion()), array('api_key', getAPIKey()), true));
//$game_result_array = json_decode($game_result);
$grexplode = explode('/', $game_result);
$tick = $grexplode[0];
$map_json = $grexplode[1];
$result = $grexplode[2];


//if null
if ($game_result == "//") {
    echo "활성화된 게임이 없습니다. 게임이 시작되면 새로고침하여 시작하세요.";
    exit();
}

//if null
if ($result == "1") {
    echo "<h1>당신의 승리로 게임이 종료되었습니다.</h1>";
    exit();
}

if ($result == "2") {
    echo "<h1>당신의 패배로 게임이 종료되었습니다.</h1>";
    exit();
}


?>
<br>
<canvas id="board" width="1000" height="1000"></canvas>
<div id="half">
    <div id="stone-color-select">
        <p>선공 또는 후공을 선택하십시오.</p>
        <div id="select-black" class="button">흑돌 (선공) (Q)</div>
        <div id="select-white" class="white button">백돌 (후공) (W)</div>
    </div>
    <div id="control-keys" style="grid">
        <div class="fake move button"></div>
        <div class="move button" id="move-up-btn"></div>
        <div class="fake move button"></div>
        <div class="move button" id="move-left-btn"></div>
        <div class="move button" id="set-btn"></div>
        <div class="move button" id="move-right-btn"></div>
        <div class="fake move button"></div>
        <div class="move button" id="move-down-btn"></div>
        <div class="fake move button"></div>
    </div>
    <div id="game-explain">
        <p id="game-explainp">
            WASD 또는 방향키로 돌을 놓을 곳을 정하고 스페이스바 또는 엔터키를 눌러 돌을 놓습니다.
        </p>
    </div>

    <div id="version"></div>

</div>

<br><br><br><br><br><br>
</body>
</html>
