import { motion } from "motion/react";

export default function App({ src, alt, width = 80 }) {
    return (
        <>
            <motion.img
                drag
                style={{
                    scale: 0.7,
                }}
                whileDrag={{
                    scale: 0.8,
                    rotateX: "10deg",
                    filter: "drop-shadow(0 5px 2px rgba(0, 0, 0, 0.2))",
                    zIndex: 99,
                }}
                dragMomentum={false}
                src={src}
                alt={alt}
                className="absolute cursor-grab active:cursor-grabbing drop-shadow-[0_1.5px_0.5px_rgba(0,0,0,0.3)]"
            />
        </>
    );
}
