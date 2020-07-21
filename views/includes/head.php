<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= Head::getTitle() ?>simplymvcphp</title>
    <meta name="description" content="<?= Head::getDescription() ?>" />
    <meta name="keywords" content="<?= Head::getKeyWords() ?>" />
    <meta name="author" content="jonasdamher" />
    <meta name="copyright" content="jonasdamher" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/png" href="<?= URL_BASE ?>public/img/favicon-simplymvcphp.png" />
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
    <script src="<?= URL_BASE ?>public/js/ckeditor/ckeditor.js"></script>
    <?php
    $totalLinksJs = count(Head::getLinksJs());
    if ($totalLinksJs > 0) {
        foreach (Head::getLinksJs() as $linkJs) { ?>
            <script src="<?= URL_BASE ?>public/js/<?= $linkJs ?>.js"></script>
    <?php }
    } ?>
</head>

<body>