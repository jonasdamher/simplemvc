<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= Head::getTitle() ?>jonasdamher</title>
    <!-- META -->
    <meta name="description" content="<?= Head::getDescription() ?>" />
    <meta name="keywords" content="<?= Head::getKeyWords() ?>" />
    <meta name="canonical" content="<?= URL_BASE . View::controller() . Head::getCaconical() ?>" />
    <meta name="robots" content="<?= Head::getRobots() ?>" />
    <meta name="googlebot" content="<?= Head::getRobots() ?>" />
    <!-- META Open Graph -->
    <meta name="og:title" content="<?= Head::getTitle() ?>jonasdamher" />
    <meta name="og:description" content="<?= Head::getDescription() ?>" />
    <meta name="og:image" content="<?= URL_BASE ?>public/images/logo/jonasdamher.png" />
    <meta name="og:url" content="<?= URL_BASE . View::controller() . Head::getCaconical() ?>" />
    <meta name="og:site_name" content="jonasdamher" />
    <meta name="og:email" content="jonas.damher@gmail.com" />
    <meta name="og:type" content="blog" />
    <!-- META Twitter Cards -->
    <meta name="twitter:title" content="<?= Head::getTitle() ?>jonasdamher" />
    <meta name="twitter:description" content="<?= Head::getDescription() ?>" />
    <meta name="twitter:image" content="<?= URL_BASE ?>public/images/logo/jonasdamher.png" />
    <meta name="twitter:site" content="@jonasdamher" />
    <meta name="twitter:creator" content="@jonasdamher" />
    <!-- META OTHERS -->
    <meta name="theme-color" content="#2855d1" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#2855d1" />
    <meta name="apple-mobile-web-app-title" content="<?= Head::getTitle() ?>jonasdamher" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- ICONS -->
    <link rel="shortcut icon" type="image/ico" href="<?= URL_BASE ?>public/images/logo/favicon.ico" />
    <link rel="apple-touch-icon" type="image/png" href="<?= URL_BASE ?>public/images/logo/launcher-3.png" />
    <!-- FONTS -->
    <link rel="preload" href="<?= URL_BASE ?>public/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin />
    <!-- MANIFEST -->
    <link rel="manifest" href="<?= URL_BASE ?>manifest.json" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= URL_BASE ?>public/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= URL_BASE ?>public/css/main.css" />
    <?php
    $totalLinksCss = count(Head::getLinksCss());
    if ($totalLinksCss > 0) {
        foreach (Head::getLinksCss() as $linkCss) { ?>
            <link rel="stylesheet" type="text/css" href="<?= URL_BASE ?>public/css/<?= $linkCss ?>.css" />
    <?php }
    } ?>
    <!-- SCRIPTS JS -->
    <script src="<?= URL_BASE ?>public/js/jquery-3.5.1.min.js"></script>
    <?php
    $totalLinksJs = count(Head::getLinksJs());
    if ($totalLinksJs > 0) {
        foreach (Head::getLinksJs() as $linkJs) { ?>
            <script src="<?= URL_BASE ?>public/js/<?= $linkJs ?>.js"></script>
    <?php }
    } ?>
    <script src="<?= URL_BASE ?>public/js/service-worker.js"></script>
</head>

<body>