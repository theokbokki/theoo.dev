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
import ShaderContainer from "@/Components/ShaderContainer";
import Template from "@/Shaders/Template/Template";

export default function App() {
    return (
        <>
            <Head title="Théoo's wizard lair" />
            <div className="px-4">
                <h1 className="sr-only">Théoo's wizard lair</h1>
                <Nav />
                <div className="h-150 max-w-150 bg-[#005598] mx-auto mt-20  rounded-lg">
                    <div className="relative flex items-center justify-center w-full h-full overflow-hidden rounded-lg">
                        <div className="absolute bottom-0 w-full h-50 bg-[#257032] border-t-6 border-black"></div>
                        <div className="absolute -top-25 -right-25 rounded-full w-65 h-65 border-6 border-black bg-[#FFC809]"></div>
                        <div
                            className={`absolute top-35 z-0 h-104 w-45 bg-[url('../img/spin.svg')] animate-spin bg-[110]`}
                        ></div>
                    </div>
                    <Sticker src={tsukiSticker} alt="A sticker of Tsuki, my tuxedo cat." x="428" y="-124" />
                    <ContextMenu title="Page navigation" x="432" y="-506">
                        <ContextMenuItem disabled draggable>
                            Pages
                        </ContextMenuItem>
                        <ContextMenuSeparator />
                        <ContextMenuItem href="/home">Home</ContextMenuItem>
                        <ContextMenuItem href="/links">Links</ContextMenuItem>
                        <ContextMenuItem href="/writings">Writings</ContextMenuItem>
                        <ContextMenuItem href="/snippets">Snippets</ContextMenuItem>
                        <ContextMenuItem href="/trinkets">Trinkets</ContextMenuItem>
                        <ContextMenuItem href="/recipes">Recipes</ContextMenuItem>
                        <ContextMenuItem href="/shaders">Shaders</ContextMenuItem>
                    </ContextMenu>
                    <ContextMenu title="Social links navigation" x="38" y="-230">
                        <ContextMenuItem disabled draggable>
                            Socials
                        </ContextMenuItem>
                        <ContextMenuSeparator />
                        <ContextMenuItem href="maito:hello@theoo.dev" target="_blank">
                            Email
                        </ContextMenuItem>
                        <ContextMenuItem href="https://github.com/theokbokki" target="_blank">
                            Github
                        </ContextMenuItem>
                        <ContextMenuItem href="https://x.com/theokbokki_" target="_blank">
                            Twitter
                        </ContextMenuItem>
                        <ContextMenuItem href="https://bsky.app/profile/theokbokki.bsky.social" target="_blank">
                            Bluesky
                        </ContextMenuItem>
                        <ContextMenuItem href="https://instagram.com/theokbokki" target="_blank">
                            Instagram
                        </ContextMenuItem>
                    </ContextMenu>
                    <Sticker
                        src={matchaSticker}
                        alt="A sticker of Matcha, my small tabby cat sleeping."
                        x="-96"
                        y="-686"
                    />
                </div>
            </div>

            <ShaderContainer>
                <Template />
            </ShaderContainer>
        </>
    );
}
