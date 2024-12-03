export default function BaseLayout({ children }: { children?: any }) {
    return (
        <div className="">
            <main className="">
                {children}
            </main>
        </div>
    )
}
