import { PropsWithChildren } from 'react';
import { Gradient } from '@/utils/stripeCanvasGradient';

export default function Guest({ children }: PropsWithChildren) {
    const canvasRef = useRef<HTMLCanvasElement>(null);
    useEffect(() => {
        if (!canvasRef.current) return;
        const gradient = new Gradient();
        //@ts-ignore
        gradient.initGradient("#gradient-canvas");
    }, [canvasRef])
    return (
        <div className="relative min-h-screen overflow-hidden">
            <canvas className="absolute" ref={canvasRef} id="gradient-canvas">
            </canvas>
            <div className="gradient-clip"></div>
            <div className="">
                {children}
            </div>
        </div>
    );
}
