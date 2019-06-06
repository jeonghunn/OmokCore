<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AI Omok</title>

    <link href="//fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
    <style>
        html {
            font-family: 'Nanum Gothic', sans-serif;
        }
    </style>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/board.css">
    <link rel="stylesheet" href="assets/css/button.css">

    <script src="assets/js/query.min.js"></script>
    <script src="assets/js/object/math.js"></script>
    <script src="assets/js/object/array.js"></script>
    <script src="assets/js/game/core.js"></script>
    <script src="assets/js/game/stone.js"></script>
    <script src="assets/js/game/ban.js"></script>
    <script src="assets/js/game/win.js"></script>
    <script src="assets/js/canvas/get.js"></script>
    <script src="assets/js/canvas/stone.js"></script>
    <script src="assets/js/canvas/board.js"></script>
    <script src="assets/js/user/select.js"></script>
    <script src="assets/js/user/keyboard.js"></script>
    <script src="assets/js/AI/core.js"></script>
    <script src="assets/js/AI/test.js"></script>
</head>
<body>
<?php echo ""


?>
<br>
<canvas id="board" width="1000" height="1000"></canvas>
<div id="half">
    <div id="stone-color-select">
        <p>선공 또는 후공을 선택하십시오.</p>
        <div id="select-black" class="button">흑돌 (선공) (Q)</div>
        <div id="select-white" class="white button">백돌 (후공) (W)</div>
    </div>
    <div id="control-keys">
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
        <p>
            WASD 또는 방향키로 돌을 놓을 곳을 정하고 스페이스바 또는 엔터키를 눌러 돌을 놓습니다.
        </p>
    </div>
    <p>
        이 게임은 <a href="https://namu.wiki/w/렌주" target="_blank">렌주룰</a>을 따릅니다.
    </p>
    <div id="version"></div>
    <div id="icons">
        <img
                src="assets/img/iconmonstr-github-2-240.png"
                alt="github"
                style="background:white"
                onclick="window.open('https://github.com/hsh-game/omok', '_blank')">
    </div>
</div>

<br><br><br><br><br><br>
</body>
</html>