<?php

header('Content-Type: application/rss+xml; charset=utf-8');

// --- CONFIG ---
$baseUrl = 'https://theoo.dev';
$notesDir = __DIR__.'/public/notes';
$feedUrl = $baseUrl.'/feed.xml';

// --- START XML ---
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
    <title>theoo.dev</title>
    <link><?= htmlspecialchars($baseUrl) ?></link>
    <description>Notes and thoughts from The OO.</description>
    <language>en-us</language>
    <atom:link href="<?= htmlspecialchars($feedUrl) ?>" rel="self" type="application/rss+xml" />

<?php
// --- LOOP THROUGH HTML FILES ---
$files = glob($notesDir . '/*.html');
sort($files); // optional: alphabetical order

foreach ($files as $file) {
    $html = file_get_contents($file);

    // Extract <title>
    if (preg_match('/<title>(.*?)<\/title>/si', $html, $m)) {
        $title = trim($m[1]);
    } else {
        $title = basename($file);
    }

    // Extract <meta name="description" content="...">
    if (preg_match('/<meta\s+name=["\']description["\']\s+content=["\'](.*?)["\']/si', $html, $m)) {
        $description = trim($m[1]);
    } else {
        $description = '';
    }

    // Build URL
    $filename = basename($file);
    $url = "$baseUrl/notes/$filename";

    // Use URL as a stable GUID
    $guid = $url;

    // --- OUTPUT ITEM ---
    ?>
    <item>
      <title><?= htmlspecialchars($title) ?></title>
      <link><?= htmlspecialchars($url) ?></link>
      <guid><?= htmlspecialchars($guid) ?></guid>
      <description><![CDATA[<?= $description ?>]]></description>
    </item>
<?php
}
?>
  </channel>
</rss>
