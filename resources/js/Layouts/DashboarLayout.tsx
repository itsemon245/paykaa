export default function DashboardLayout({ children }: { children?: JSX.Element | JSX.Element[] }) {
    return (
        <AuthenticatedLayout>
            <SquareBg className="h-full md:!h-[60dvh]" animate={true} />
            <Navbar className="!bg-transparent" />
            <div className="z-20 max-w-3xl mx-auto my-3 p-2 sm:px-3">
                {children}
            </div>
        </AuthenticatedLayout>
    );
}
