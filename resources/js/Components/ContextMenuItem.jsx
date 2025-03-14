import React from "react";
import { Link } from "@inertiajs/react";
import { motion } from "motion/react";

export default function ContextMenuItem({ disabled, draggable, children, href, dragControls, ...props }) {
    const currentOrigin = typeof window !== "undefined" ? window.location.origin : "";
    const isAbsoluteUrl = href && href.startsWith("http");
    const isExternal = href && (props.target === "_blank" || (isAbsoluteUrl && !href.startsWith(currentOrigin)));

    const Component = disabled || !href ? "p" : isExternal ? "a" : Link;

    const handlePointerDown = (e) => {
        if (draggable && dragControls) {
            dragControls.start(e);
        }
    };

    return (
        <motion.li
            onPointerDown={handlePointerDown}
            className={`px-2.25 py-1.25 text-[0.8125rem]/[100%] rounded-sm
                ${disabled ? "text-[#AAABA9]" : "text-[#232323] hover:bg-[#59A2FF] hover:text-white"}
                ${draggable ? "cursor-grab active:cursor-grabbing select-none" : ""}
            `}
        >
            <Component {...(href && !disabled ? { href } : {})} {...props} className="flex">
                {children}
            </Component>
        </motion.li>
    );
}
