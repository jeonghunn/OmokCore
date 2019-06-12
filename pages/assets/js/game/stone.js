//바둑돌 객체.
game.stone = {};

//바둑돌의 위치를 담을 2차원 배열.
game.stone.list = [ /*[...],[...],...*/];

//바둑판에 변화가 생길때마다 1씩 증가하는 식별자.
game.stone.id = 0;

//바둑돌들의 위치를 모두 초기화할 함수.
game.stone.reset = () => {
    game.stone.id++;
    for (let i = 0; i < 15; i++) {
        game.stone.list[i] = Array(15).fill(EMPTY);
    }
}

//바둑돌들의 위치를 모두 초기화한다.
game.stone.reset();

//x, y좌표에 착수하는 함수.
game.stone.set = (color, x, y) => {
    game.stone.id++;
    if (game.checkWin() || !game.getCanvas().elem) return;

    game.stone.list[x][y] = color;
    //game.stone.update will define in
    // [ assets/js/canvas/stone.js ]
    game.stone.update();
}

//x,y 좌표에 돌이 존재하는지 불리언값으로 리턴하는 함수.
game.stone.isStone = (x, y, board) => {
    board = board || game.stone.list;
    return board[x] && board[x][y];
}

//x,y 좌표에 돌의 색이 매칭되는지 확인.
game.stone.is = (color, x, y, board) => {
    board = board || game.stone.list;
    return board[x] && board[x][y] === color;
}

//x,y 좌표에 돌의 색이 매칭되는지 확인.
game.stone.isValid = (x, y, board) => {
    board = board || game.stone.list;
    return board[x] && y in board[x];
}

game.stone.requestDol = () => {

    $.ajax({
        type: "POST",
        url: API_URL,
        data: {
            "a": "omok_tick",
            "apiv": "1",
            "api_key": "xT3FP4AuctM-",
            "x": user.focus.coord[0],
            "y": user.focus.coord[1],
            "team": "1",
            "tick": tick
        },
        success: function (data) {

            //setProcessing(false);
            if (data.indexOf('//') >= 0) {
                alert('내 차례가 아닙니다. 아쉽게도 다른 분이 먼저 돌을 두셨습니다.');


            } else {
                var jbSplit = data.split(',');
                tick = jbsplit[0];
                if (tick % 2 != 0) tick++;
                var Map = JSON.parse(jbSplit[1]);
                game.stone.list = Map;

            }


        },
        error: function (jqXHR) {

            alert('서버와의 통신 중 오류가 발생했습니다. 새로고침하여 다시 시도하세요.');

        }


    });
}
