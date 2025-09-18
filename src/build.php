<?php

$content = file_get_contents('./src/assets/notes/content-sync.md');

file_put_contents('./src/assets/notes/content.bak.md', $content);

$start = preg_quote('@startPost');
$end = preg_quote('@endPost');
$pattern = "~$start(.+)$end~misU";

preg_match_all($pattern, $content, $matches);

$articles = $matches[1];

    
$dir = './src/assets/notes';
$leave_files = [
    'content-sync.md',
    'content.bak.md',
    'old',
];

foreach (glob($dir.'/*') as $file) {
    if (in_array(basename($file), $leave_files)) {
        continue;
    }

    unlink($file);
}

foreach($articles as $article) {
    $title = slug(strtok($article, "\n"));
    
    file_put_contents('./src/assets/notes/'.$title.'.md', trim($article));
}

// Taken from laravel and simplified a bunch
function slug($title)
{
    $separator = '-';

    // Convert all dashes/underscores into separator
    $flip = $separator === '-' ? '_' : '-';

    $title = preg_replace('!['.preg_quote($flip).']+!u', $separator, $title);

    // Remove all characters that are not the separator, letters, numbers, or whitespace
    $title = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', strtolower($title));

    // Replace all separator characters and whitespace by a single separator
    $title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);

    return trim($title, $separator);
}
