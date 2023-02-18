<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $this -> data -> title ?></title>
    <meta name="description" content="<?= $this -> data -> title ?>"/>
</head>
<body>
    <? include_once getFilePath('layouts', 'assets', 'header.php'); ?>
    <div class="frame-container">
        <? include_once getFilePath('layouts', 'pages', $this -> pageName . '.php'); ?>
    </div>
    <script>
        console.time();
        document.addEventListener('DOMContentLoaded', (e) => {
            const hrefs = document.querySelectorAll('a[data-ssr]');
            hrefs.forEach((a) => {
                a.addEventListener('click', (e) => {
                    e.preventDefault();
                    asyncLoadPage(a.getAttribute('href'));
                });
            });
        });
        function asyncLoadPage(uri, cb) {
            const frameContainer = document.querySelector('.frame-container');
            fetch(`${uri}?ssr`)
                .then(async (response) => {
                    window.history.pushState({}, '', uri);
                    frameContainer.innerHTML = await response.text();
                });
        }
    </script>
</body>
</html>