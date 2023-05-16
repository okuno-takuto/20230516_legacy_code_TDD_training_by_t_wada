<?php

function run_lifegame($prev, $g) {
    if (isset ($prev)) {
        $prev = $prev;
        $b = [];
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
            $b[] = $r;
        }
        $bb = [];
        for ($i = 0, $len = count($b); $i < $len; $i++) {
            $r = [];
            for ($j = 0, $len2 = count($b[$i]); $j < $len2; $j++) {
                $r[] = '□';
            }
            $bb[] = $r;
        }
        for ($i = 0, $len = count($b); $i < $len; $i++) {
            for ($j = 0, $len2 = count($b[$i]); $j < $len2; $j++) {
                if ($b[$i][$j] === '□') {
                    // 誕生の場合
                    $count = 0;
                    if ($i > 0 && $j > 0 && $b[$i - 1][$j - 1] === ("■")) $count += 1;
                    if ($i > 0 && $b[$i - 1][$j] === "■") $count += 1;
                    if ($i > 0 && $j < 4 && $b[$i - 1][$j + 1] === ("■")) $count += 1;
                    if ($j > 0 && $b[$i][$j - 1] === ("■")) $count += 1;
                    if ($j < 4 && $b[$i][$j + 1] === ("■")) $count += 1;
                    if ($i < 4 && $j > 0 && $b[$i + 1][$j - 1] === ("■")) $count += 1;
                    if ($i < 4 && $b[$i + 1][$j] === ("■")) $count += 1;
                    if ($i < 4 && $j < 4 && $b[$i + 1][$j + 1] === ("■")) $count += 1;

                    if ($count >= 3) {
                        $bb[$i][$j] = "■";
                    } else {
                        $bb[$i][$j] = "□";
                    }
                }
                if ($b[$i][$j] === ("■")) {
                    // 生存・過疎・過密の場合
                    $count = 0;

                    if ($i > 0 && $b[$i - 1][$j] === ("■")) $count += 1;
                    if ($j > 0 && $b[$i][$j - 1] === ("■")) $count += 1;
                    if ($j < 4 && $b[$i][$j + 1] === ("■")) $count += 1;
                    if ($i < 4 && $b[$i + 1][$j] === ("■")) $count += 1;

                    if ($count == 2) {
                        $bb[$i][$j] = $b[$i][$j];
                    } else {
                        $bb[$i][$j] = "□";
                    }
                }
            }
        }
        $b = $bb;
        $n = [];
        for ($i = 0, $len = count($b); $i < $len; $i++) {
            $nr = [];
            for ($j = 0, $len2 = count($b[$i]); $j < $len2; $j++) {
                if ($b[$i][$j] == '□') {
                    $nr[] = '0';
                } else {
                    $nr[] = '1';
                }
            }
            $n[] = implode('', $nr);
        }
        $s = implode('9', $n);
        $g = (int)$g;
        return [$g, $b, $s];
    } else {
        $b = [];
        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $b[$i][$j] = "□";
            }
        }
        $b[2][1] = "■";
        $b[2][2] = "■";
        $b[2][3] = "■";
        $n = [];
        for ($i = 0; $i < 5; $i++) {
            $r = $b[$i];
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
        $s = implode('9', $n);
        $g = 1;
        return [$g, $b, $s];
    }
}
