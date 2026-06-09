<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>
        <title><![CDATA[ theoo.dev ]]></title>
        <link><![CDATA[ https://theoo.dev/feed ]]></link>
        <description><![CDATA[ All the things I think and like to share ]]></description>
        <language>en</language>
        <pubDate>{{ now()->toRssString() }}</pubDate>

        @foreach($pages as $page)
            <item>
                <title>{{ $page->title }}</title>
                <link>{{ route('page.show', ['page' => $page]) }}</link>
                <description><![CDATA[{!! str()->markdown($page->content) !!}]]></description>
                <author>Théoo</author>
                <guid>{{ $page->id }}</guid>
            </item>
        @endforeach
    </channel>
</rss>
