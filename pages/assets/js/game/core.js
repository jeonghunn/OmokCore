/*
  게임의 내부적인 작동을 위한 스크립트.
*/
const game = {
    version: "v0.5.8-Beta"
};

//편의를 위해 빈칸은 0, 흰색은 1, 검은색은 2로 취급한다.
const EMPTY = 0,
    WHITE = 2,
    BLACK = 1,
    X = 0,
    Y = 1;


var tick = 0;

var API_URL = "http://unopenedbox.com/develop/omok/api.php";
