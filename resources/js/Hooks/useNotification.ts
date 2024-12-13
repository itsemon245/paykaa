export default function useNotification() {
    const playSound = (src?: string) => {
        if (!src) src = "/assets/chat/audio/notification.wav";
        const audio = new Audio(src);
        audio.volume = 1;
        audio.loop = false;
        audio.play();
    }
    return { playSound }
}
