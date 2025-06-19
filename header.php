<?php
// Start a session to store the language preference
session_start();

// Check if a language has been selected via the URL
if (isset($_GET['lang']) && ($_GET['lang'] == 'en' || $_GET['lang'] == 'ms')) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Set the current language, defaulting to English if none is set
$current_lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';

// Include the correct language file
require_once 'lang_' . $current_lang . '.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $current_lang; ?>">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $lang['form_main_title']; ?></title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header class="main-header">
      <div class="container">
        <div class="logo"><?php echo $lang['app_title']; ?></div>
        <nav class="main-nav">
          <a href="index.php"><?php echo $lang['nav_create_resume']; ?></a>
          <a href="test_resume.php" target="_blank"><?php echo $lang['nav_preview_design']; ?></a>
          <div class="language-switcher">
            <a href="?lang=en" class="<?php if($current_lang == 'en') echo 'active'; ?>">EN</a> | 
            <a href="?lang=ms" class="<?php if($current_lang == 'ms') echo 'active'; ?>">BM</a>
          </div>
        </nav>
      </div>
    </header>

    <div class="container">