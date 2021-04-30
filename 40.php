<?php

// ジャンケンの手の定数。
const STONE = 0;
const SCISSORS = 1;
const PAPER = 2;

const HAND_TYPE = array(
    STONE => 'グー',
    SCISSORS => 'チョキ',
    PAPER => 'パー',
);

// 結果の定数。
const RESULT = array(
    0 => '引き分け',
    1 => 'あなたの負け。',
    2 => 'あなたの勝ち。',
);
// ジャンケンの手のバリデーション
function checkHand($inputHand)
{
    if (!in_array($inputHand, HAND_TYPE)) {
        return false;
    }
    return true;
}

// 入力
function inputHand()
{
    $inputHand = trim(fgets(STDIN));
    $result = checkHand($inputHand);
    if ($result === false) {
        echo "グー、チョキ、パーの、いづれかの手を入力してください。";
        return inputHand(); // 再帰処理で、正しい文字列を入力してもらう。
    }
    return $inputHand;
}

function getComHand() // 変数名をcomHandに修正。

{
    $comHand = HAND_TYPE[array_rand(HAND_TYPE)]; // ランダムに手を出力する。

    return $comHand;

}

function getIndexFromHand($hand)
{
    $index = array_search($hand, HAND_TYPE);
    return $index;
}

// 判定のみに修正。
function judgeHands($yourHand, $comHand)
{
    // 文字列を数値に変換。
    $yourHand = getIndexFromHand($yourHand);
    $comHand = getIndexFromHand($comHand);

    $result = ($yourHand - $comHand + 3) % 3; // ジャンケンアルゴリズム

    return $result;
}

// 結果を表示する関数
function show($result)
{
    echo RESULT[$result];
}

// 再度ジャンケンをするのか
function replay()
{
    echo "もう一度ジャンケンしますか？(y or n )";
    $input = trim(fgets(STDIN));

    if ($input !== "y" && $input !== "n") {
        echo "y か nを入力してださい。";
        return replay();
    }
    if ($input === "y") {
        echo "ありがとう！";
        return $input;
    }
    if ($input === "n") {
        echo "バイバイ";
        return;
    }
}

function main()
{
    echo "ジャンケンしましょう、グー、チョキ、パーのいづれかを入力してください。";
    $yourHand = inputHand();
    $comHand = getComHand();
    echo sprintf("私は%sで、あなたは%sです。" . "\n", $comHand, $yourHand);

    $result = judgeHands($yourHand, $comHand);
    show($result);

    $input = replay();
    if ($input) {
        return main(); // main関数の再帰はmain関数内で行うよう修正。
    }
}

main();
