<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $home = Page::query()->create([
            'title' => 'Home',
            'content' => <<<HEREDOC
                Welcome to my place on the internet!

                My name is Théo, I use this website to share writings, pictures, things I like etc
                <br>
                If any of this resonates with you or you just want to have a chat, you can reach me at [hello@theoo.dev](mailto:hello@theoo.dev).

                If social medias are more your thing, my Instagram is [@theokbokki](https://instagram.com/theokbokki).

                You can find all the code for this website and much more on [my GitHub](https://github.com/theokbokki).
                HEREDOC,
            'draft' => false,
            'private' => false,
        ]);

        $home->updateQuietly(['slug' => '']);

        $notes = Page::query()->create([
            'parent_id' => $home->id,
            'title' => 'Notes',
            'content' => <<<HEREDOC
                This is my notes page. It’s basically a blog but where I write like I would in a notes app. I don’t correct or re-read or anything. I just say whatever I have in mind and try to write it down so it makes sense.

                You might find something interesting, who knows!
                HEREDOC,
            'pinned' => true,
            'draft' => false,
            'private' => false,
        ]);

        Page::query()->create([
            'parent_id' => $notes->id,
            'title' => 'An ode to plaintext',
            'content' => <<<HEREDOC
                I consider myself a simple boring guy, I like ed, I enjoy eating plain pasta, I wear only a few clothes in rotation, and my favourite way of writing and reading text is plaintext.

                There is something appealing about `.txt` files for me, it's only characters that all look mostly the same, none are bold, none are bigger, none have a background.
                Plaintext works everywhere, every computer can render it, it's fast, it's quiet, it's most likely futureproof, it's portable, I love it.

                If I could, I would have everything written in plaintext. It's limitations make it predictable. It doesn't have links or blockquotes, it doesn't render code with fancy colors nor does it bolden or italicize text.
                I might make an exception for images, but other than that, plaintext is all I want.

                But despite it's seemingly perfect simpleness, plaintext has one big flaw for me, it doesn't work quite well on the web.
                I mean, sure your browser can most likely natively render it (in a superb way may I had), and most users will be able to read it with not problems. But that's not how accessibility works, you can't accept 'most users'.

                Web pages rely on semantics to convey meaning. Users with assistive technology can jump to headings and links, are warned when entering a list and know how many items are in it, etc.
                So if you serve them some plaintext, they will only hear a big blob of text being read, with no way to differentiate between different parts of the text.

                And for that people have invented markdown. It's still kinda plaintext, but with some light syntax added so that you can transform it into HTML.
                This way, your users get all the benefits of HTML and you only had to write some slightly more verbose plaintext.
                But generally, markdown doesn't look like plaintext once rendered, titles are bigger, blockquotes are well... quoted, code is rendered in fancy code blocks, lists have a dot in front of them etc.

                And that's why I've written [a small CSS file](https://github.com/theokbokki/txt-css) that takes nice semantic HTML and makes it look like 'enhanced' plaintext!
                You still get your links, your quotes and your images, but the overall vibe is plaintext.

                It was deliberately inspired by the default style browsers apply to plaintext as well as the ways man files format their text to look legible. (I'm a huge fan of man files, but that's a story for another time).

                If you decide to use it for something, don't hesitate to send me [a little email](mailto:hello@theoo.dev) ^^ I'll be super pleased to look at what you wrote with it.
                HEREDOC,
            'pinned' => false,
            'draft' => false,
            'private' => false,
        ]);

        $collections = Page::query()->create([
            'parent_id' => $home->id,
            'title' => 'Collections',
            'content' => <<<HEREDOC
                Kind of like are.na, this is a place where I collect things and group them together.

                There are images, musics, books, websites, etc
                HEREDOC,
            'pinned' => true,
            'draft' => false,
            'private' => false,
        ]);

        Page::query()->create([
            'parent_id' => $collections->id,
            'title' => 'Life with my pets',
            'content' => <<<HEREDOC
                Life with my pets
                HEREDOC,
            'pinned' => false,
            'draft' => false,
            'private' => false,
        ]);
    }
}
