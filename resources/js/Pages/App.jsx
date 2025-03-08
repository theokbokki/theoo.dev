// Assets
import miffySticker from "@img/miffy-sticker.png";
import f1Sticker from "@img/f1-sticker.png";
import tsukiSticker from "@img/tsuki-sticker.png";
import matchaSticker from "@img/matcha-sticker.png";
import ankySticker from "@img/anky-sticker.png";
import logoSticker from "@img/logo-sticker.png";
import painting from "@img/painting.jpg";

// Components
import { Head } from "@inertiajs/react";
import Sticker from "@/Components/Sticker";

export default function App() {
    return (
        <>
            <Head title="Théoo's wizard lair" />
            <h1 className="sr-only">Théoo's wizard lair</h1>
            <main className="relative flex items-center justify-center">
                <Sticker src={miffySticker} alt="A sticker of miffy riding a scooter." />
                <Sticker src={f1Sticker} alt="A sticker of a ferrari formula one car." />
                <Sticker src={tsukiSticker} alt="A sticker of Tsuki, my tuxedo cat." />
                <Sticker src={matchaSticker} alt="A sticker of Matcha, my small tabby cat sleeping." />
                <Sticker
                    src={logoSticker}
                    alt="A sticker of my logo. 2 cartoon eyes representing the two Os of Théoo"
                />
                <Sticker src={ankySticker} alt="A sticker of an Ankylosaurus." />
            </main>
        </>
    );
}
