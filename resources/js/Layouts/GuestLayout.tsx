import { PropsWithChildren } from 'react';
import { Gradient } from '@/utils/stripeCanvasGradient';
import { cookie, getQuery } from '@/utils';

export default function Guest({ children }: PropsWithChildren) {
    const canvasRef = useRef<HTMLCanvasElement>(null);
    const auth = useAuth();
    //poll to toggle auth users active status every 2 minutes
    useEffect(() => {
        if (!auth.user) {
            const referId = getQuery('r');
            if (referId) {
                cookie.set('referId', referId);
            }
        }
    }, [])

    useEffect(() => {
        if (!canvasRef.current) return;
        const gradient = new Gradient();
        //@ts-ignore
        gradient.initGradient("#gradient-canvas");
    }, [canvasRef])
    return (
        <div className="relative min-h-screen overflow-hidden">
            <canvas className="!fixed" ref={canvasRef} id="gradient-canvas">
            </canvas>
            <div className="top-6 md:top-8 left-0 absolute w-full">
                <div className="flex items-center px-3 md:max-w-[760px] max-lg:mx-auto lg:ms-[120px]">
                    <Logo className="!w-[140px]" />
                </div>
            </div>
            <div className="gradient-clip"></div>
            <div className="">
                {children}
            </div>
        </div>
    );
}
