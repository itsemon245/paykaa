export default function BaseLayout({ children }: { children?: any }) {
    return (
        <div className="grid min-h-screen w-full">
            <main className="bg-base-gradient -z-10">
                {children}
            </main>
        </div>
    )
}
