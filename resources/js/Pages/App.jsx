// Assets
import miffySticker from "@rsc/img/miffy-sticker.png";
import f1Sticker from "@rsc/img/f1-sticker.png";
import tsukiSticker from "@rsc/img/tsuki-sticker.png";
import matchaSticker from "@rsc/img/matcha-sticker.png";
import ankySticker from "@rsc/img/anky-sticker.png";
import logoSticker from "@rsc/img/logo-sticker.png";

// Components
import { Head } from "@inertiajs/react";
import ContextMenu from "@/Components/ContextMenu";
import ContextMenuItem from "@/Components/ContextMenuItem";
import ContextMenuSeparator from "@/Components/ContextMenuSeparator";
import Sticker from "@/Components/Sticker";
import Nav from "@/Components/Nav";

export default function App() {
    return (
        <>
            <Head title="Théoo's wizard lair" />
            <h1 className="sr-only">Théoo's wizard lair</h1>
            <main className="relative flex items-center justify-center">
                {/* <Sticker src={miffySticker} alt="A sticker of miffy riding a scooter." />
                <Sticker src={f1Sticker} alt="A sticker of a ferrari formula one car." />
                <Sticker src={tsukiSticker} alt="A sticker of Tsuki, my tuxedo cat." />
                <Sticker src={matchaSticker} alt="A sticker of Matcha, my small tabby cat sleeping." />
                <Sticker
                    src={logoSticker}
                    alt="A sticker of my logo. 2 cartoon eyes representing the two Os of Théoo"
                />
                <Sticker src={ankySticker} alt="A sticker of an Ankylosaurus." /> */}
            </main>
            <ContextMenu title="Page navigation">
                <ContextMenuItem disabled draggable>Pages</ContextMenuItem>
                <ContextMenuSeparator />
                <ContextMenuItem href="/home">Home</ContextMenuItem>
                <ContextMenuItem href="/links">Links</ContextMenuItem>
                <ContextMenuItem href="/writings">Writings</ContextMenuItem>
                <ContextMenuItem href="/snippets">Snippets</ContextMenuItem>
                <ContextMenuItem href="/trinkets">Trinkets</ContextMenuItem>
                <ContextMenuItem href="/recipes">Recipes</ContextMenuItem>
                <ContextMenuItem href="/shaders">Shaders</ContextMenuItem>
            </ContextMenu>

            <ContextMenu title="Social links navigation">
                <ContextMenuItem disabled draggable>Socials</ContextMenuItem>
                <ContextMenuSeparator />
                <ContextMenuItem href="maito:hello@theoo.dev" target="_blank">Email</ContextMenuItem>
                <ContextMenuItem href="https://github.com/theokbokki" target="_blank">Github</ContextMenuItem>
                <ContextMenuItem href="https://x.com/theokbokki_" target="_blank">Twitter</ContextMenuItem>
                <ContextMenuItem href="https://bsky.app/profile/theokbokki.bsky.social" target="_blank">Bluesky</ContextMenuItem>
                <ContextMenuItem href="https://instagram.com/theokbokki" target="_blank">Instagram</ContextMenuItem>
            </ContextMenu>
        </>
    );
}
