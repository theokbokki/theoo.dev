import { Canvas, useFrame, useThree } from "@react-three/fiber";
import { useEffect, useMemo, useRef, useCallback } from "react";
import { Vector2 } from "three";
import fragmentShader from "./template.frag";
import vertexShader from "./template.vert";

const useMousePosition = (canvasElement) => {
    const mousePosition = useRef({ x: 0, y: 0 });

    const updateMousePosition = useCallback(
        (e) => {
            if (!canvasElement) {
                return;
            }

            const rect = canvasElement.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width;
            const y = 1 - (e.clientY - rect.top) / rect.height;

            mousePosition.current = { x, y };
        },
        [canvasElement],
    );

    useEffect(() => {
        if (!canvasElement) {
            return;
        }

        canvasElement.addEventListener("mousemove", updateMousePosition, false);

        return () => {
            canvasElement.removeEventListener("mousemove", updateMousePosition, false);
        };
    }, [canvasElement, updateMousePosition]);

    return mousePosition;
};

const useShaderUniforms = () => {
    const uniforms = useMemo(
        () => ({
            u_time: { value: 0.0 },
            u_mouse: { value: new Vector2(0, 0) },
        }),
        [],
    );
    return uniforms;
};

const Shader = () => {
    const mesh = useRef();
    const { gl } = useThree();
    const mousePosition = useMousePosition(gl.domElement);
    const uniforms = useShaderUniforms();

    useFrame((state) => {
        const { clock } = state;

        if (mesh.current) {
            mesh.current.material.uniforms.u_time.value = clock.getElapsedTime();
            mesh.current.material.uniforms.u_mouse.value.set(mousePosition.current.x, mousePosition.current.y);
        }
    });

    return (
        <mesh ref={mesh} position={[0, 0, 0]}>
            <planeGeometry />
            <shaderMaterial
                fragmentShader={fragmentShader}
                vertexShader={vertexShader}
                uniforms={uniforms}
                wireframe={false}
            />
        </mesh>
    );
};

const Scene = () => (
    <Canvas camera={{ position: [0.0, 0.0, 0.1] }}>
        <Shader />
    </Canvas>
);

export default Scene;
