<?php

function runLifegame($prev, $generation) {
    if (isset ($prev)) {
        $prev = $prev;
        $cells = [];
        $lns = explode('9', $prev);
        for ($i = 0, $len = count($lns); $i < $len; $i++) {
            $ln = $lns[$i];
            $r = [];
            for ($j = 0, $len2 = mb_strlen($ln); $j < $len2; $j++) {
                if ($ln[$j] == 0) {
                    $r[] = '□';
                } else {
                    $r[] = '■';
                }
            }
            $cells[] = $r;
        }
        $bb = [];
        for ($i = 0, $len = count($cells); $i < $len; $i++) {
            $r = [];
            for ($j = 0, $len2 = count($cells[$i]); $j < $len2; $j++) {
                $r[] = '□';
            }
            $bb[] = $r;
        }
        for ($i = 0, $len = count($cells); $i < $len; $i++) {
            for ($j = 0, $len2 = count($cells[$i]); $j < $len2; $j++) {
                if ($cells[$i][$j] === '□') {
                    // 誕生の場合
                    $count = 0;
                    if ($i > 0 && $j > 0 && $cells[$i - 1][$j - 1] === ("■")) $count += 1;
                    if ($i > 0 && $cells[$i - 1][$j] === "■") $count += 1;
                    if ($i > 0 && $j < 4 && $cells[$i - 1][$j + 1] === ("■")) $count += 1;
                    if ($j > 0 && $cells[$i][$j - 1] === ("■")) $count += 1;
                    if ($j < 4 && $cells[$i][$j + 1] === ("■")) $count += 1;
                    if ($i < 4 && $j > 0 && $cells[$i + 1][$j - 1] === ("■")) $count += 1;
                    if ($i < 4 && $cells[$i + 1][$j] === ("■")) $count += 1;
                    if ($i < 4 && $j < 4 && $cells[$i + 1][$j + 1] === ("■")) $count += 1;

                    if ($count >= 3) {
                        $bb[$i][$j] = "■";
                    } else {
                        $bb[$i][$j] = "□";
                    }
                }
                if ($cells[$i][$j] === ("■")) {
                    // 生存・過疎・過密の場合
                    $count = 0;

                    if ($i > 0 && $cells[$i - 1][$j] === ("■")) $count += 1;
                    if ($j > 0 && $cells[$i][$j - 1] === ("■")) $count += 1;
                    if ($j < 4 && $cells[$i][$j + 1] === ("■")) $count += 1;
                    if ($i < 4 && $cells[$i + 1][$j] === ("■")) $count += 1;

                    if ($count == 2) {
                        $bb[$i][$j] = $cells[$i][$j];
                    } else {
                        $bb[$i][$j] = "□";
                    }
                }
            }
        }
        $cells = $bb;
        $n = [];
        for ($i = 0, $len = count($cells); $i < $len; $i++) {
            $nr = [];
            for ($j = 0, $len2 = count($cells[$i]); $j < $len2; $j++) {
                if ($cells[$i][$j] == '□') {
                    $nr[] = '0';
                } else {
                    $nr[] = '1';
                }
            }
            $n[] = implode('', $nr);
        }
        $cellsStringSeparatedByNine = implode('9', $n);
        $generation = (int)$generation;
        return [$generation, $cells, $cellsStringSeparatedByNine];
    } else {
        return getInitial();
    }
}

function getInitial() {
    $cells = array_fill(0, 5, array_fill(0, 5, "□"));
    $cells[2][1] = "■";
    $cells[2][2] = "■";
    $cells[2][3] = "■";

    $n = [];
    for ($i = 0; $i < 5; $i++) {
        $r = $cells[$i];
        $nr = [];
        for ($j = 0; $j < 5; $j++) {
            if ($r[$j] == '□') {
                $nr[] = '0';
            } else {
                $nr[] = '1';
            }
        }
        $n[] = implode('', $nr);
    }
    $cellsStringSeparatedByNine = implode('9', $n);
    $generation = 1;
    return [$generation, $cells, $cellsStringSeparatedByNine];
}
