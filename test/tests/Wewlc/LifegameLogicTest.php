<?php
namespace Wewlc;

use PHPUnit\Framework\TestCase;
require __DIR__ . '/../../src/html/lifegame_logic.php';

class LifegameLogicTest extends TestCase
{
    /**
     * @test
     * @small
     * @group characterization
     */
    public function 初期表示(): void
    {
        $params = [
            'prev' => null,
            'generation' => null
        ];
        [$generation, $cells, $cellsStringSeparatedByNine] = runLifegame($params['prev'], $params['generation']);
        $this->assertSame([
            ["□", "□", "□", "□", "□"],
            ["□", "□", "□", "□", "□"],
            ["□", "■", "■", "■", "□"],
            ["□", "□", "□", "□", "□"],
            ["□", "□", "□", "□", "□"],
        ], $cells);
    }

    /**
     * @test
     * @small
     * @group characterization
     */
    public function 二回目の表示(): void
    {
        $params = [
            'prev' => '00000900000901110900000900000',
            'generation' => '2'
        ];
        [$generation, $cells, $cellsStringSeparatedByNine] = runLifegame($params['prev'], $params['generation']);
        $this->assertSame([
            ["□", "□", "□", "□", "□"],
            ["□", "□", "■", "□", "□"],
            ["□", "□", "■", "□", "□"],
            ["□", "□", "■", "□", "□"],
            ["□", "□", "□", "□", "□"],
        ], $cells);
    }

    /**
     * @test
     * @small
     * @group characterization
     */
    public function 三回目の表示(): void
    {
        $params = [
            'prev' => '00000900100900100900100900000',
            'generation' => '3'
        ];
        [$generation, $cells, $cellsStringSeparatedByNine] = runLifegame($params['prev'], $params['generation']);
        $this->assertSame([
            ["□", "□", "□", "□", "□"],
            ["□", "□", "□", "□", "□"],
            ["□", "■", "■", "■", "□"],
            ["□", "□", "□", "□", "□"],
            ["□", "□", "□", "□", "□"],
        ], $cells);
    }
}
