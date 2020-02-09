<?php
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Nav;
use yii\helpers\Html;
/**
 * Created by PhpStorm.
 * User: Vvv
 * Date: 09.02.2020
 * Time: 16:09
 */

//NavBar::begin([
//    'brandImage' => '/img/header-logo.png',
//    'brandUrl' => Yii::$app->homeUrl,
//    'options' => [
//        'class' => 'navbar navbar-expand-md navbar-light bg-light',
//    ],
//]);

//NavBar::end();
//
//NavBar::begin([
//    'options' => [
//        'class' => 'navbar navbar-expand-md navbar-light bg-light',
//    ],
//]);
//echo Nav::widget([
//    'options' => ['class' => 'navbar-nav'],
//    'encodeLabels' => false,
//    'items' => [
//        ['label' => 'Loans', 'url' => ['/site/index']],
//        ['label' => 'Users', 'url' => ['/site/about']],
//    ],
//]);
//NavBar::end();
?>
<nav id="header-menu0" class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container text-white">
        <div class="d-flex">
            <ul class="mr-auto">
                <li>Kliendtieenindus</li>
                <li><i class="fas fa-mobile-alt"></i> 1715</li>
                <li><i class="far fa-clock"></i> E-P 9.00-21.00</li>
            </ul>
        </div>
        <div class="d-flex">
            <ul>
                <li>Tere, Kaupo Kasupaja</li>
                <li><button class="btn btn-dark"><i class="fas fa-lock-open"></i> Log Out</button></li>
            </ul>
        </div>
    </div>
</nav>
<nav id="header-menu1" class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/index.php"><img src="/img/header-logo.png" alt=""></a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#header-menu1-collapse,#header-menu2-collapse" aria-controls="header-menu1-collapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div id="header-menu1-collapse" class="collapse navbar-collapse">
            <?= Nav::widget([
                'options' => ['class' => 'navbar-nav'],
                'encodeLabels' => false,
                'items' => [
                    ['label' => 'Home<span class="arrow-icon"><i class="fas fa-chevron-right"></i></span>', 'url' => ['/site/index']],
                    ['label' => 'About<span class="arrow-icon"><i class="fas fa-chevron-right"></i></span>', 'url' => ['/site/about']],
                    ['label' => 'Contact<span class="arrow-icon"><i class="fas fa-chevron-right"></i></span>', 'url' => ['/site/contact']],
                ],
            ]);?>
        </div>
    </div>
</nav>
<nav id="header-menu2" class="navbar navbar-expand-md navbar-light mb-4">
    <div class="container">
        <div id="header-menu2-collapse" class="collapse navbar-collapse">
            <?= Nav::widget([
                'options' => ['class' => 'navbar-nav'],
                'encodeLabels' => false,
                'items' => [
                    ['label' => 'Loans', 'url' => ['/loans']],
                    ['label' => 'Users', 'url' => ['/users']],
                ],
            ]);?>
        </div>
    </div>
</nav>