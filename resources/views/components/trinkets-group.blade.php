<section class="note">
    <h3 class="as-text">{{ $title }}</h3>
    @foreach($group as $trinket)
        <img class="small" src="{{ $src($trinket) }}" alt="{{ $trinket->alt }}">
    @endforeach
</section>
<hr>
