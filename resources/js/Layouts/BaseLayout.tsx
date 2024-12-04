export default function BaseLayout({ children }: { children?: any }) {
    return (
        <main className="bg-base-gradient">
            {children}
        </main>
    )
}
