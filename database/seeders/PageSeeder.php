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
                An ode to plaintext
                HEREDOC,
            'pinned' => false,
            'draft' => false,
            'private' => false,
        ]);
    }
}
