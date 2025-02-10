import { usePage } from "@inertiajs/react";

export default function useNotification() {
    const { config } = usePage().props;
    const playSound = (src?: string) => {
        if (config.app.env === 'local') return;
        try {
            if (!src) src = "/assets/chat/audio/notification.wav";
            const audio = new Audio(src);
            audio.volume = 1;
            audio.loop = false;
            audio.play();
        } catch (error) {
            console.log("Error while playing notification sound.", error);
        }
    }
    return { playSound }
}
