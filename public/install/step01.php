<?php

declare(strict_types=1);

$basePath = dirname(__DIR__, 2);

function okBadge(bool $ok): string
{
    $cls = $ok ? 'ok' : 'bad';
    $txt = $ok ? 'OK' : 'Fix';
    return '<span class="pill '.$cls.'">'.$txt.'</span>';
}

function safeRead(string $path, int $maxBytes = 60000): ?string
{
    if (!is_file($path) || !is_readable($path)) {
        return null;
    }

    $size = filesize($path);
    if ($size === false) {
        return null;
    }

    $read = min($size, $maxBytes);
    $fh = fopen($path, 'rb');
    if ($fh === false) {
        return null;
    }

    if ($size > $read) {
        fseek($fh, -$read, SEEK_END);
    }

    $data = stream_get_contents($fh);
    fclose($fh);

    if ($data === false) {
        return null;
    }

    return $data;
}

$checks = [];

$checks[] = ['label' => 'PHP version >= 8.2', 'ok' => version_compare(PHP_VERSION, '8.2.0', '>='), 'hint' => PHP_VERSION];

$extensions = ['openssl', 'pdo', 'mbstring', 'tokenizer', 'xml', 'ctype', 'json'];
foreach ($extensions as $ext) {
    $checks[] = ['label' => 'Extension: '.$ext, 'ok' => extension_loaded($ext), 'hint' => extension_loaded($ext) ? 'enabled' : 'missing'];
}

$paths = [
    $basePath.'/storage',
    $basePath.'/bootstrap/cache',
    $basePath.'/.env',
    $basePath.'/vendor/autoload.php',
    $basePath.'/bootstrap/app.php',
    $basePath.'/public/index.php',
];

foreach ($paths as $p) {
    $isDir = is_dir($p);
    $exists = $isDir ? true : is_file($p);

    $ok = $exists;
    $hint = $exists ? 'found' : 'missing';

    if ($exists && ($p === $basePath.'/storage' || $p === $basePath.'/bootstrap/cache')) {
        $ok = is_writable($p);
        $hint = $ok ? 'writable' : 'not writable';
    }

    $checks[] = ['label' => ($isDir ? 'Directory: ' : 'File: ').$p, 'ok' => $ok, 'hint' => $hint];
}

$logPath = $basePath.'/storage/logs/laravel.log';
$logTail = safeRead($logPath);

$appUrl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http').'://'.($_SERVER['HTTP_HOST'] ?? 'localhost');
$installerUrl = $appUrl.'/install';

?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Installer - Step 01</title>
    <style>
        :root{--bg:#0b1020;--card:#101a35;--text:#eaf0ff;--muted:rgba(234,240,255,.75);--accent:#7c5cff;--ok:#22c55e;--bad:#ef4444;--line:rgba(255,255,255,.10)}
        *{box-sizing:border-box} body{margin:0;font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;background:radial-gradient(1100px 600px at 10% 15%, rgba(124,92,255,.32), transparent 60%),radial-gradient(900px 520px at 90% 30%, rgba(34,197,94,.20), transparent 55%),var(--bg);color:var(--text)}
        .wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:28px}
        .shell{width:min(980px,100%)}
        .brand{display:flex;align-items:center;justify-content:space-between;gap:16px;margin:0 0 12px}
        .logo{display:flex;align-items:center;gap:12px}
        .mark{width:38px;height:38px;border-radius:12px;background:linear-gradient(135deg, rgba(124,92,255,1), rgba(124,92,255,.55));box-shadow:0 18px 40px rgba(0,0,0,.35)}
        .title h1{margin:0;font-size:18px;letter-spacing:.2px}
        .title p{margin:2px 0 0;color:var(--muted);font-size:13px}
        .card{background:linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.03));border:1px solid var(--line);border-radius:18px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,.45)}
        .body{padding:18px 16px 20px}
        h2{margin:0 0 8px;font-size:20px}
        p{margin:8px 0;color:var(--muted);line-height:1.6}
        .list{display:grid;gap:10px;margin:12px 0 0;padding:0;list-style:none}
        .item{display:flex;justify-content:space-between;gap:12px;padding:10px 10px;border-radius:12px;border:1px solid rgba(255,255,255,.10);background:rgba(0,0,0,.20)}
        .pill{font-size:12px;font-weight:800;padding:6px 10px;border-radius:999px;border:1px solid rgba(255,255,255,.12)}
        .pill.ok{color:rgba(224,255,236,1);border-color:rgba(34,197,94,.5);background:rgba(34,197,94,.12)}
        .pill.bad{color:rgba(255,226,226,1);border-color:rgba(239,68,68,.5);background:rgba(239,68,68,.12)}
        .actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:14px}
        .btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;padding:12px 14px;border-radius:12px;text-decoration:none;font-weight:800;border:1px solid rgba(255,255,255,.14);cursor:pointer}
        .btn.primary{background:linear-gradient(135deg, rgba(124,92,255,1), rgba(124,92,255,.72));color:white}
        .btn.ghost{background:rgba(255,255,255,.06);color:var(--text)}
        pre{white-space:pre-wrap;word-break:break-word;background:rgba(0,0,0,.25);border:1px solid rgba(255,255,255,.10);border-radius:14px;padding:12px;color:rgba(234,240,255,.85);margin:12px 0 0;max-height:320px;overflow:auto}
        code{background:rgba(0,0,0,.25);padding:2px 6px;border-radius:8px;border:1px solid rgba(255,255,255,.08)}
        .small{font-size:12px;color:rgba(234,240,255,.68)}
    </style>
</head>
<body>
<div class="wrap">
    <div class="shell">
        <div class="brand">
            <div class="logo">
                <div class="mark"></div>
                <div class="title">
                    <h1>Malkia Konnect Admin</h1>
                    <p>Fallback Installer (Step 01)</p>
                </div>
            </div>
            <div class="small"><?php echo htmlspecialchars($appUrl, ENT_QUOTES, 'UTF-8'); ?></div>
        </div>

        <div class="card">
            <div class="body">
                <h2>Server Requirements & Diagnostics</h2>
                <p>Ukipata <code>500 Server Error</code> kwenye cPanel, hii page inakusaidia kuona nini kinakosekana kabla ya kuingia Laravel installer.</p>

                <ul class="list">
                    <?php foreach ($checks as $c): ?>
                        <li class="item">
                            <div>
                                <div style="font-weight:800"><?php echo htmlspecialchars($c['label'], ENT_QUOTES, 'UTF-8'); ?></div>
                                <?php if (!empty($c['hint'])): ?>
                                    <div class="small"><?php echo htmlspecialchars((string) $c['hint'], ENT_QUOTES, 'UTF-8'); ?></div>
                                <?php endif; ?>
                            </div>
                            <?php echo okBadge((bool) $c['ok']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="actions">
                    <a class="btn primary" href="<?php echo htmlspecialchars($installerUrl, ENT_QUOTES, 'UTF-8'); ?>">Open Laravel Installer (/install)</a>
                    <a class="btn ghost" href="/">Back Home</a>
                </div>

                <p class="small" style="margin-top:14px">Kama bado ina-500, mara nyingi ni permissions za <code>storage</code> au <code>bootstrap/cache</code>, au `.env` haipo/haijasomeka.</p>

                <h2 style="margin-top:18px">Laravel Log Tail</h2>
                <p class="small">Hii ni sehemu ya mwisho ya <code>storage/logs/laravel.log</code> (kama inasomeka).</p>

                <?php if ($logTail === null): ?>
                    <pre>Log file not readable: <?php echo htmlspecialchars($logPath, ENT_QUOTES, 'UTF-8'); ?></pre>
                <?php else: ?>
                    <pre><?php echo htmlspecialchars($logTail, ENT_QUOTES, 'UTF-8'); ?></pre>
                <?php endif; ?>
            </div>
        </div>

        <div class="small" style="margin-top:12px; text-align:center">Step 01 imekamilika. Ukisharekebisha errors zilizoonyesha <strong>Fix</strong>, fungua <code>/install</code>.</div>
    </div>
</div>
</body>
</html>
