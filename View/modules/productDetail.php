<?php

use Controller\productController;

require_once './Controller/productController.php';

$gameId = $_GET['id'];
$productController = new productController();
$game = $productController->deployment($gameId);

?>

<div class="imgs">
    <div class="img__big">
        <img src="View/img<? echo $game['img'][0]['url'] ?>" class="img__big">
    </div>
    <div class="img__small-box">
        <?php $countImg = count($game['img']);
              $iImg = 1;
              while ($iImg < $countImg) {
        ?>
        <img src="View/img<? echo $game['img'][$iImg]['url'] ?>" class="img__small">
        <?php
                  ++$iImg;
              }
        ?>
    </div>
</div>
<div class="info__detail">
    <div class="info__detail__main">
        <div class="name">
            <h2><?= $game['basic'][0][0] ?></h2>
        </div>
        <div class="price">
            <div class="price__new"><h3><?= $game['basic'][0]['price'] . $game[0][16] ?></h3></div>
            <div class="price__old"><h4><?= $game['basic'][0]['price_old'] ?></h4></div>
        </div>
        <div class="info__detail__consoles">
            <?php
            $i = 0;
            while ($i < count($game)) {
            if($game['basic'][$i-1][7] !== $game['basic'][$i][7] && $game['basic'][$i-2][7] !== $game['basic'][$i][7] && $game['basic'][$i-3][7] !== $game['basic'][$i][7])  { ?>
            <img src="View/img/logos<?= $game['basic'][$i][7] . '_logo.png'?>" class="img__logo" title="<?= $game['basic'][$i][9]?>">
            <?php }
            $i++;
            }?>
        </div>
    </div>
    <div class="info__detail__secondary">
        <p></p>
        <p></p>
    </div>
    <div class="announce">
        <p><?= $game['basic'][0]['content'] ?> </p>
    </div>
</div>
<?php
$countTypes = count($game['basic']);
$iBasic = 0;
while ($iBasic < $countTypes) {
    if ($game['basic'][$iBasic][11] == 'collection') {
        $text = $game['basic'][$iBasic][12] . ' для ' . $game['basic'][$iBasic][8] . ' за ' . $game['basic'][$iBasic][1] * $game['basic'][$iBasic][13] . ' ' . $game['basic'][$iBasic][5];
    }
    else {
        $text = $game['basic'][$iBasic][12] . ' для ' . $game['basic'][$iBasic][8] . ' за ' . $game['basic'][$iBasic][1] . ' ' . $game['basic'][$iBasic][5];
    }
?>
<div class="buy button">
    <p>Купить <?php echo $text; ?></p>
</div>
<?php
    ++$iBasic;
}
?>