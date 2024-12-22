export default function DashboardLayout({ children, animate }: { children?: JSX.Element | JSX.Element[], animate?: boolean }) {
    return (
        <AuthenticatedLayout>
            <SquareBg animate={animate} />
            <div className="z-20 max-w-5xl mx-auto p-2 sm:px-3">
                <Navbar className="!bg-transparent mb-6" />
                {children}
            </div>
        </AuthenticatedLayout>
    );
}
