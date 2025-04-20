<x-layout title="Links">
    <x-slot name="metas">
        <meta name="description" content="The links page of Théoo's personal website. This is a page for me to share all the links to stuff I like or want to remember in some way. There is no categorization or defined order." />
    </x-slot>

    <section>
        <h2 class="sro">Links</h2>
        <ul class="list">
            @foreach($links as $item)
                <li class="list__item">
                    <x-link :$item :external="true"/>
                </li>
            @endforeach
        </ul>
    </section>
</x-layout>
