import fish1 from "@rsc/img/🐟.png";
import fish2 from "@rsc/img/🐠.png";
import fish3 from "@rsc/img/🐡.png";
import bubbles from "@rsc/img/🫧.png";

import { motion } from "motion/react";

export default function FishButton(props) {
    return (
        <motion.button
            initial="rest"
            whileHover="hover"
            whileTap="active"
            animate="rest"
            className="relative px-4 py-1 transition-[box-shadow] overflow-hidden rounded-full bg-linear-to-b from-[#0084D1] to-[#3285B7] shadow-xl group cursor-pointer hover:shadow-sm focus-visible:shadow-xs"
        >
            <motion.div
                variants={{
                    rest: {
                        background: "linear-gradient(to bottom, #0084D1, #00BCFF)",
                        boxShadow: "0px -1px 5px 0px rgba(255, 255, 255, 1) inset",
                    },
                    hover: {
                        background: "linear-gradient(to bottom, #0084D1, #0084D1)",
                        boxShadow: "0px -.5 5px 0px rgba(255, 255, 255, 1) inset",
                    },
                    active: {
                        boxShadow: "0px -0px 0px 0px rgba(255, 255, 255, 0) inset",
                    },
                }}
                className="absolute inset-[1px] z-0 rounded-full"
            ></motion.div>
            <div className="absolute inset-[1px] overflow-hidden rounded-full">
                <motion.img
                    variants={{
                        rest: { x: 0, y: 0, rotate: 35 },
                        hover: { x: 4, y: 4, rotate: 45 },
                        active: { x: 10, y: 10, rotate: 320 },
                    }}
                    transition={{ duration: 0.3 }}
                    src={fish1}
                    alt=""
                    className="absolute w-6 h-6 right-0 top-4 opacity-80"
                />
                <motion.img
                    variants={{
                        rest: { x: 0, y: 0, rotate: -40 },
                        hover: { x: 8, y: -8, rotate: -60 },
                        active: { x: 16, y: -16, rotate: 320 },
                    }}
                    transition={{ duration: 0.3 }}
                    src={fish2}
                    alt=""
                    className="absolute w-6 h-6 left-10 -top-2 -scale-x-100 opacity-80"
                />
                <motion.img
                    variants={{
                        rest: { x: 0, y: 0, rotate: -10 },
                        hover: { x: 10, y: 10, rotate: 30 },
                        active: { x: 18, y: 20, rotate: -320 },
                    }}
                    transition={{ duration: 0.3 }}
                    src={fish3}
                    alt=""
                    className="absolute w-6 h-6 left-1 top-1 -scale-x-100 opacity-80"
                />
                <img src={bubbles} alt="" className="absolute w-3 h-3 transition-all right-5 top-2" />
                <img
                    src={bubbles}
                    alt=""
                    className="absolute w-3 h-3 transition-all left-15 bottom-1 -scale-x-100 -scale-y-100"
                />
                <img src={bubbles} alt="" className="absolute w-3 h-3 transition-all left-7 top-1 -scale-x-100" />
            </div>
            <motion.div
                variants={{
                    rest: {
                        scale: 1,
                    },
                    hover: {
                        scale: 0.95,
                    },
                    active: {
                        scale: 0.9,
                    },
                }}
                className="absolute top-[.125rem] left-2 w-[calc(100%-1rem)] h-4.5 bg-linear-to-b from-white/90 to-white/0 rounded-full"
            ></motion.div>
            <span className="relative z-1 text-white">{props.children}</span>
        </motion.button>
    );
}
