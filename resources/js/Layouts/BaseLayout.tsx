export default function BaseLayout({ children }: { children?: any }) {
    return (
        <div className="min-h-screen w-full grid relative">
            <div className="absolute inset-0 bg-base-gradient -z-10"></div>
            <main className="">
                {children}
            </main>
        </div>
    )
}
