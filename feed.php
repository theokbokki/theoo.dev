<?php
header('Content-Type: application/rss+xml; charset=utf-8');

// --- CONFIG ---
$baseUrl = 'https://theoo.dev';
$notesDir = __DIR__.'/public/notes';
$feedUrl = $baseUrl.'/feed.xml';

echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
?>
<rss version="2.0"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:content="http://purl.org/rss/1.0/modules/content/">
  <channel>
    <title>theoo.dev</title>
    <link><?= htmlspecialchars($baseUrl) ?></link>
    <description>Notes and thoughts from The OO.</description>
    <language>en-us</language>
    <atom:link href="<?= htmlspecialchars($feedUrl) ?>" rel="self" type="application/rss+xml" />

<?php
$files = glob($notesDir . '/*.html');
usort($files, fn($a, $b) => filemtime($b) <=> filemtime($a)); // newest first

foreach ($files as $file) {
    $html = file_get_contents($file);

    // Extract title
    preg_match('/<title>(.*?)<\/title>/si', $html, $m);
    $title = isset($m[1]) ? trim($m[1]) : basename($file);

    // Extract meta description
    preg_match('/<meta\s+name=["\']description["\']\s+content=["\'](.*?)["\']/si', $html, $m);
    $summary = $m[1] ?? '';

    // Extract content between comment markers
    if (preg_match('/<!--\s*START OF CONTENT\s*-->(.*?)<!--\s*END OF CONTENT\s*-->/si', $html, $m)) {
        $content = trim($m[1]);
    } else {
        $content = '<p><em>No content found between comments.</em></p>';
    }

    $filename = basename($file);
    $url = "$baseUrl/notes/$filename";
    $guid = $url;

    // Add a footer link for people who view it in readers
    $footer = '<p><a href="' . htmlspecialchars($url) . '">Read on theoo.dev →</a></p>';
    $content .= "\n" . $footer;
?>
    <item>
      <title><?= htmlspecialchars($title) ?></title>
      <link><?= htmlspecialchars($url) ?></link>
      <guid><?= htmlspecialchars($guid) ?></guid>
      <description><?= $summary ?></description>
      <content:encoded><![CDATA[<?= $content ?>]]></content:encoded>
    </item>
<?php
}
?>
  </channel>
</rss>
