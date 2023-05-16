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
            'g' => null
        ];
        list($g, $b, $s) = runLifegame($params['prev'], $params['g']);
        $this->assertSame([
            ["□", "□", "□", "□", "□"],
            ["□", "□", "□", "□", "□"],
            ["□", "■", "■", "■", "□"],
            ["□", "□", "□", "□", "□"],
            ["□", "□", "□", "□", "□"],
        ], $b);
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
            'g' => '2'
        ];
        list($g, $b, $s) = runLifegame($params['prev'], $params['g']);
        $this->assertSame([
            ["□", "□", "□", "□", "□"],
            ["□", "□", "■", "□", "□"],
            ["□", "□", "■", "□", "□"],
            ["□", "□", "■", "□", "□"],
            ["□", "□", "□", "□", "□"],
        ], $b);
    }
}
