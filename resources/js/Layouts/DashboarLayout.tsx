export default function DashboardLayout({ children }: { children?: JSX.Element | JSX.Element[] }) {
    return (
        <AuthenticatedLayout>
            <SquareBg className="!h-[60%]" />
            <Navbar className="!bg-transparent" />
            <div className="max-w-3xl mx-auto my-3 p-2 max-sm:px-3">
                {children}
            </div>
        </AuthenticatedLayout>
    );
}
