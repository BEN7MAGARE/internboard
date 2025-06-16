<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Translation Demo with Swahili</title>
    <style>
        #translation-controls {
            margin: 20px 0;
            padding: 15px;
            background: #f5f5f5;
            border-radius: 5px;
        }
        select, button {
            padding: 8px 12px;
            margin-right: 10px;
            font-size: 16px;
        }
        .translatable {
            border-left: 3px solid #4285F4;
            padding-left: 10px;
            margin: 15px 0;
            transition: all 0.3s ease;
        }
        .language-flag {
            margin-right: 5px;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div id="translation-controls">
        <select id="language-select">
            <option value="en" data-flag="🇺🇸">English</option>
            <option value="sw" data-flag="🇹🇿">Swahili (Kiswahili)</option>
            <option value="es" data-flag="🇪🇸">Spanish</option>
            <option value="fr" data-flag="🇫🇷">French</option>
            <option value="de" data-flag="🇩🇪">German</option>
            <option value="zh-CN" data-flag="🇨🇳">Chinese</option>
            <option value="ja" data-flag="🇯🇵">Japanese</option>
        </select>
        <button id="translate-btn">Translate</button>
    </div>
    
    <div class="content">
        <h1 class="translatable">Welcome to our website</h1>
        <p class="translatable">This content can be translated to Swahili and other languages.</p>
        <p class="translatable">Click the translate button to see it in Kiswahili.</p>
    </div>

    
</body>
</html>