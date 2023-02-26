<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $this -> data -> title ?? $this -> dataCommon -> siteName ?></title>
    <meta name="description" content="<?= $this -> data -> title ?>"/>
</head>
<body>
    <? include_once getFilePath('layouts', 'snippets', 'header.php'); ?>
    <div id="main">
        <div id="frame">
            <? include_once getFilePath('layouts', 'pages', $this -> pageName . '.php'); ?>
        </div>
    </div>
    <script src="/assets/script.js"></script>
</body>
</html>