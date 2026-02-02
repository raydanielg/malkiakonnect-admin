<?php
// This file exists only as a convenience entrypoint when the web server document root
// is pointed at the project root. In production, you should point the document root
// to the /public directory.

$publicIndex = __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'index.php';

if (is_file($publicIndex)) {
    // If you want the Laravel app to boot normally even when docroot is the project root,
    // uncomment the line below and remove the HTML block.
    // require $publicIndex;

    http_response_code(200);
    header('Content-Type: text/html; charset=UTF-8');

    $publicUrl = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? '/'), '/\\') . '/public/';

    echo '<!doctype html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '  <meta charset="utf-8">';
    echo '  <meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '  <title>Malkia Konnect Admin</title>';
    echo '  <style>';
    echo '    :root{--bg:#0b1020;--card:#101a35;--text:#eaf0ff;--muted:#b9c5ff;--accent:#7c5cff;--accent2:#22c55e;}' ;
    echo '    *{box-sizing:border-box} body{margin:0;font-family:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial; background:radial-gradient(1200px 600px at 20% 10%, rgba(124,92,255,.35), transparent 60%),radial-gradient(1000px 600px at 90% 30%, rgba(34,197,94,.22), transparent 55%), var(--bg); color:var(--text);}';
    echo '    .wrap{min-height:100vh; display:flex; align-items:center; justify-content:center; padding:28px;}';
    echo '    .card{width:min(920px, 100%); background:linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.03)); border:1px solid rgba(255,255,255,.10); border-radius:18px; padding:28px; box-shadow:0 20px 60px rgba(0,0,0,.45);}';
    echo '    .top{display:flex; gap:18px; align-items:center; flex-wrap:wrap;}';
    echo '    .badge{display:inline-flex; align-items:center; gap:10px; padding:10px 12px; border-radius:999px; background:rgba(124,92,255,.16); border:1px solid rgba(124,92,255,.35); color:var(--muted); font-weight:600; letter-spacing:.2px;}';
    echo '    .dot{width:10px;height:10px;border-radius:50%; background:var(--accent2); box-shadow:0 0 0 5px rgba(34,197,94,.15);}';
    echo '    h1{margin:14px 0 6px; font-size:clamp(24px, 3.2vw, 38px); line-height:1.15;}';
    echo '    p{margin:10px 0; color:rgba(234,240,255,.82); font-size:16px; line-height:1.6;}';
    echo '    .grid{display:grid; grid-template-columns:1fr; gap:14px; margin-top:18px;}';
    echo '    @media (min-width: 860px){.grid{grid-template-columns:1.2fr .8fr;}}';
    echo '    .panel{background:rgba(16,26,53,.6); border:1px solid rgba(255,255,255,.08); border-radius:14px; padding:16px;}';
    echo '    .actions{display:flex; gap:12px; flex-wrap:wrap; margin-top:14px;}';
    echo '    a.btn{display:inline-flex; align-items:center; justify-content:center; gap:10px; padding:12px 14px; border-radius:12px; text-decoration:none; font-weight:700;}';
    echo '    a.primary{background:linear-gradient(135deg, rgba(124,92,255,1), rgba(124,92,255,.72)); color:white; border:1px solid rgba(255,255,255,.14);}';
    echo '    a.ghost{background:rgba(255,255,255,.06); color:var(--text); border:1px solid rgba(255,255,255,.10);}';
    echo '    code{background:rgba(0,0,0,.25); padding:2px 6px; border-radius:8px; border:1px solid rgba(255,255,255,.08);}';
    echo '    .small{font-size:13px; color:rgba(234,240,255,.68);}';
    echo '  </style>';
    echo '</head>';
    echo '<body>';
    echo '  <div class="wrap">';
    echo '    <div class="card">';
    echo '      <div class="top">';
    echo '        <div class="badge"><span class="dot"></span> Project root entrypoint</div>';
    echo '      </div>';
    echo '      <h1>Malkia Konnect Admin</h1>';
    echo '      <p>Umetengeneza <code>index.php</code> “hapo nje” (project root). Laravel yako iko tayari ndani ya <code>/public</code>.</p>';
    echo '      <div class="grid">';
    echo '        <div class="panel">';
    echo '          <p><strong>Recommended:</strong> weka web server document root kwenye <code>public/</code> ili Laravel ifanye kazi kawaida.</p>';
    echo '          <div class="actions">';
    echo '            <a class="btn primary" href="' . htmlspecialchars($publicUrl, ENT_QUOTES, 'UTF-8') . '">Open App (/public)</a>';
    echo '            <a class="btn ghost" href="' . htmlspecialchars($publicUrl . 'index.php', ENT_QUOTES, 'UTF-8') . '">Open public/index.php</a>';
    echo '          </div>';
    echo '        </div>';
    echo '        <div class="panel">';
    echo '          <p><strong>Alternative:</strong> uki-run site ukiwa docroot ni root, unaweza kufanya Laravel iboot kupitia file hii.</p>';
    echo '          <p class="small">Fungua <code>index.php</code> (root) kisha <strong>uncomment</strong> line ya <code>require $publicIndex;</code>.</p>';
    echo '          <p class="small">Kwa security, production inashauriwa docroot ibaki <code>public/</code>.</p>';
    echo '        </div>';
    echo '      </div>';
    echo '    </div>';
    echo '  </div>';
    echo '</body>';
    echo '</html>';
    exit;
}

http_response_code(500);
header('Content-Type: text/plain; charset=UTF-8');
echo "public/index.php haijapatikana. Hakikisha project iko complete na folder ya public ipo.";
