<?php
declare(strict_types=1);
namespace Wewlc;

use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriverBy as By;
use Facebook\WebDriver\WebDriverExpectedCondition as Condition;
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class DemoTest extends TestCase
{
    private RemoteWebDriver $driver;

    protected function setUp(): void
    {
        parent::setUp();
        $serverUrl = 'http://selenium-chrome:4444';
        // Chrome
        $desiredCapabilities = DesiredCapabilities::chrome();
        // Disable accepting SSL certificates
        $desiredCapabilities->setCapability('acceptSslCerts', false);
        $this->driver = RemoteWebDriver::create($serverUrl, $desiredCapabilities);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        // terminate the session and close the browser
        $this->driver->quit();
    }

    /**
     * [x] Seleniumで要素を絞り込む方法を調べる
     * [x] 全体をダンプしてテストできるか調べる
     * [x] マス目の部分に絞り込んで完全一致のテストを書く
     * [x] 世代数の表示
     * [x] 次世代のリンクをクリックしたら画面遷移すること
     *
     * @test
     * @group characterization
     */
    public function URLにアクセスした時点の初期表示(): void
    {
        // Arrange
        $driver = $this->driver;

        // Act
        $driver->get('http://server/lifegame.php');

        // Assert
        $tableElement = $driver->findElement(By::className('board'));
        $cellElements = $tableElement->findElements(By::tagName('td'));
        $cells = array_map(function (RemoteWebElement $element) {
            return $element->getText();
        }, $cellElements);
        // ライフゲームのマス目の出力の検証
        $this->assertSame([
            "□", "□", "□", "□", "□",
            "□", "□", "□", "□", "□",
            "□", "■", "■", "■", "□",
            "□", "□", "□", "□", "□",
            "□", "□", "□", "□", "□",
        ], $cells);

        // 世代数を表示していることの検証
        $generation_title = $driver->findElement(By::className("generation"))->getText();
        $this->assertSame('GENERATION: 1', $generation_title);
    }


    /**
     * @test
     * @group characterization
     */
    public function 次世代のリンクをクリックしたら次世代の盤面が描画される(): void
    {
        // Arrange
        $driver = $this->driver;
        $driver->get('http://server/lifegame.php');

        // Act
        $driver->findElement(By::linkText('NEXT GENERATION'))->click();
        sleep(1);

        // Assert
        // 世代数を表示していることの検証
        $generation_title = $driver->findElement(By::className("generation"))->getText();
        $this->assertSame('GENERATION: 2', $generation_title);

        $tableElement = $driver->findElement(By::className('board'));
        $cellElements = $tableElement->findElements(By::tagName('td'));
        $cells = array_map(function (RemoteWebElement $element) {
            return $element->getText();
        }, $cellElements);
        // ライフゲームのマス目の出力の検証
        $this->assertSame([
            "□", "□", "□", "□", "□",
            "□", "□", "■", "□", "□",
            "□", "□", "■", "□", "□",
            "□", "□", "■", "□", "□",
            "□", "□", "□", "□", "□",
        ], $cells);
    }


}
