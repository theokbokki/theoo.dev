import logo from "@rsc/icons/logo.svg";
import burger from "@rsc/img/burger.gif";

import FishButton from "@/Components/FishButton"

export default function Nav() {
    return (
        <nav className="flex justify-between items-center max-w-200 mx-auto mt-6">
            <h2 className="sr-only">Main navigation</h2>
            <figure className="h-5">
                <img src={logo} alt="" className="w-full h-full" />
            </figure>
            <div className="flex gap-6">
                <FishButton>Get in touch</FishButton>
                <figure className="h-8 sm:hidden">
                    <img src={burger} alt="A jumping burger" className="w-full h-full" />
                </figure>
            </div>
        </nav>
    );
}
