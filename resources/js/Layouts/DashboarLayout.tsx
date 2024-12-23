export default function DashboardLayout({ children, animate }: { children?: JSX.Element | JSX.Element[], animate?: boolean }) {
    return (
        <AuthenticatedLayout>
            <SquareBg animate={animate} />
            <div className="z-20 max-w-5xl mx-auto p-2 sm:px-3">
                <Navbar className="!bg-transparent mb-6" />
                {children}
            </div>
            <div className="z-[-1] fixed blur-lg -bottom-5 left-0 w-full h-[18vh] bg-gradient-to-t from-primary-200 to-transparent"></div>
        </AuthenticatedLayout>
    );
}
