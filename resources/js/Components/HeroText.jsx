import { Canvas, useFrame } from "@react-three/fiber";
import { Text } from "@react-three/drei";
import { useRef, useMemo } from "react";

import picnic from "@rsc/fonts/PicNic-Regular.woff";
import fragmentShader from "@rsc/shaders/HeroText/hero-text.frag";
import vertexShader from "@rsc/shaders/HeroText/hero-text.vert";

function TextShader() {
    const materialRef = useRef();

    const uniforms = useMemo(
        () => ({
            u_time: { value: 0.0 },
        }),
        [],
    );

    useFrame((state) => {
        if (materialRef.current) {
            materialRef.current.uniforms.u_time.value = state.clock.getElapsedTime();
        }
    });

    return (
        <Text font={picnic} fontSize={1.6} maxWidth={12} textAlign="center" position={[0, 0, 0]}>
            Welcome to Théoo's wizard lair
            <shaderMaterial
                ref={materialRef}
                fragmentShader={fragmentShader}
                vertexShader={vertexShader}
                uniforms={uniforms}
            />
        </Text>
    );
}

function HeroText() {
    return (
        <div id="hero-text-container" className="h-63">
            <Canvas camera={{ position: [0, 0, 5] }}>
                <TextShader />
            </Canvas>
        </div>
    );
}

export default HeroText;
