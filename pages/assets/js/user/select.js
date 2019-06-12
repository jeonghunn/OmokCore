const user = {
    color: EMPTY,
    focus: {
        coord: [7, 7],
        set() {
            //user.focus.set
            const X = 0, Y = 1;
            let board = game.getCanvas(),
                ctx = board.ctx,
                banedPosition = game.getBanedPosition(user.color),
                x = board.padding + board.blockWidth * user.focus.coord[0],
                y = board.padding + board.blockWidth * user.focus.coord[1],
                r = board.width / 35;

            game.stone.update();
            ctx.lineWidth = 7;
            ctx.strokeStyle = '#fa6060';
            ctx.beginPath();
            ctx.arc(x, y, r, 0, 2 * Math.PI);
            ctx.moveTo(x - board.blockWidth / 1.5, y);
            ctx.lineTo(x + board.blockWidth / 1.5, y);
            ctx.moveTo(x, y - board.blockWidth / 1.5);
            ctx.lineTo(x, y + board.blockWidth / 1.5);
            ctx.stroke();

            if (!game.checkWin())
                for (i = 0; i < banedPosition.length; i++) {
                    const BX = board.padding + board.blockWidth * banedPosition[i][X],
                        BY = board.padding + board.blockWidth * banedPosition[i][Y],
                        LEN = board.blockWidth / 3;
                    ctx.strokeStyle = '#7c1b1b';
                    ctx.lineWidth = 15;
                    ctx.beginPath();
                    ctx.moveTo(BX - LEN, BY - LEN);
                    ctx.lineTo(BX + LEN, BY + LEN);
                    ctx.moveTo(BX - LEN, BY + LEN);
                    ctx.lineTo(BX + LEN, BY - LEN);
                    ctx.stroke();
                }
        }
    },

    set() {
        //user.set
        const AI_COLOR = (user.color == BLACK) ? WHITE : BLACK,
            X = 0, Y = 1;

        if (!user.color || game.stone.isStone(...user.focus.coord)) return;

        const IS_BANED = game.getBanedPosition(user.color)
            .map(JSON.stringify)
            .includes(
                JSON.stringify(user.focus.coord)
            );

        if (IS_BANED)
            return alert("그곳에는 돌을 놓을 수 없습니다. 룰을 확인해주세요.");

        game.stone.set(user.color, ...user.focus.coord);


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

        // game.stone.set(AI_COLOR, ...AI(AI_COLOR, game.stone.list));
        user.focus.set();

        let winner = game.checkWin();
        if (winner) {
            setTimeout(() => {
                alert("당신의 " + ((winner == user.color) ? "승리" : "패배") + "입니다.");
            }, 100);
        }
    }
};

window.addEventListener('DOMContentLoaded', () => {
    user.focus.set();

    $('#set-btn').addEventListener('click', user.set, false);
    $('#version').innerHTML = game.version;


    user.color = BLACK;
        $('#game-explain').style.display = 'block';
        $('#stone-color-select').style.display = 'none';
        $('#control-keys').style.display = 'grid';


    // $('#select-white').addEventListener('click', () => {
    //     initGame(WHITE);
    //     game.stone.set(BLACK, ...AI(BLACK, game.stone.list));
    //     user.focus.set();
    // }, false);
    //
    // $('#select-black').addEventListener('click', () => {
    //     initGame(BLACK);
    // }, false);

    function checkFocus() {
        user.focus.coord.forEach(
            (val, i, coord) => coord[i] = Math.min(14, Math.max(val, 0))
        );
        user.focus.set();
    }

    [
        ['up', Y, -1],
        ['down', Y, +1],
        ['left', X, -1],
        ['right', X, +1]
    ].forEach(([dir, target, change]) => {
        $(`#move-${dir}-btn`).addEventListener('click', () => {
            user.focus.coord[target] += change;
            checkFocus();
        }, false);
    });

    window.addEventListener('keydown', e => {
        switch (e.key.toLowerCase().replace('arrow', '')) {
            case 'down':
            case 's':
                user.focus.coord[Y]++;
                break;
            case 'up':
            case 'w':
                user.focus.coord[Y]--;
                break;
            case 'left':
            case 'a':
                user.focus.coord[X]--;
                break;
            case 'right':
            case 'd':
                user.focus.coord[X]++;
                break;
            case ' ':
            case 'enter':
                user.set();
                break;
            default:
                return;
        }
        e.preventDefault();
        checkFocus();
    }, false);
}, false);
