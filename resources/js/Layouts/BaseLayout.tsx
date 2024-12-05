export default function BaseLayout({ children }: { children?: any }) {
    return (
        <div className="grid min-h-screen w-full">
            <main className="bg-base-gradient">
                {children}
            </main>
        </div>
    )
}
