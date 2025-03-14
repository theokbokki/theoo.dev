import React from "react";
import { motion, useDragControls } from "motion/react";

export default function ContextMenu({ title, x, y, children }) {
    const dragControls = useDragControls();

    const childrenWithDrag = React.Children.map(children, (child) =>
        React.isValidElement(child) ? React.cloneElement(child, { dragControls }) : child,
    );

    return (
        <motion.nav
            style={{
                x: Number(x),
                y: Number(y),
                boxShadow: "0 6px 16px 0 rgba(0, 0, 0, 0.2)",
            }}
            whileDrag={{
                boxShadow: "0 20px 40px 0 rgba(0, 0, 0, 0.1)",
                zIndex: 99,
            }}
            transition={{
                duration: 0.2,
            }}
            className="absolute w-30.5 px-1.25 py-1.75 bg-[#EAEAE7] rounded-lg border-[0.5px] border-[#C3C3C3]"
            drag
            dragListener={false}
            dragControls={dragControls}
            dragMomentum={false}
        >
            <h2 className="sr-only">{title}</h2>
            <ul>{childrenWithDrag}</ul>
        </motion.nav>
    );
}
