// Assets
import miffySticker from "@rsc/img/miffy-sticker.png";
import f1Sticker from "@rsc/img/f1-sticker.png";
import tsukiSticker from "@rsc/img/tsuki-sticker.png";
import matchaSticker from "@rsc/img/matcha-sticker.png";
import ankySticker from "@rsc/img/anky-sticker.png";
import logoSticker from "@rsc/img/logo-sticker.png";

// Components
import { Head } from "@inertiajs/react";
import Sticker from "@/Components/Sticker";
import Nav from "@/Components/Nav";

export default function App() {
    return (
        <>
            <Head title="Théoo's wizard lair" />
            <Nav/>
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
        </>
    );
}
