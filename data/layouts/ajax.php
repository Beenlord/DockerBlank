<?php
    header('Content-Type: application/json');

    $this -> html = file_get_contents(getFilePath('layouts', 'pages', $this -> pageName . '.php'));

    echo json_encode($this);
?>