<?php
require './now.php';
require './lifegame_logic.php';

$params = [
    'prev' => isset($_GET['prev']) ? $_GET['prev'] : null,
    'generation' => isset($_GET['g']) ? $_GET['g'] : null,
];

[$generation, $cells, $cellsStringSeparatedByNine] = runLifegame($params['prev'], $params['generation']);
?>
<!doctype html>
<head>
    <title>LIFEGAME</title>
</head>
<body>
<h3 class="generation">GENERATION: <?php echo htmlspecialchars($generation) ?></h3>
<table class="board">
    <?php foreach ($cells as $row): ?>
        <tr>
            <?php foreach ($row as $cell): ?>
                <td>
                    <?php echo htmlspecialchars($cell) ?>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>
<a href="/lifegame.php?g=<?php echo rawurldecode($generation + 1) ?>&prev=<?php echo rawurldecode($cellsStringSeparatedByNine) ?>">NEXT GENERATION</a>
<br/>
<?php echo htmlspecialchars($tstp) ?>
</body>
