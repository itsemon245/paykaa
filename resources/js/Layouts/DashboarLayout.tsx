import { Card } from "primereact/card";

export default function DashboardLayout({ children }: { children?: JSX.Element | JSX.Element[] }) {
    return (
        <AuthenticatedLayout>
            <Navbar />
            <div className="max-w-3xl mx-auto my-3">
                {children}
            </div>
        </AuthenticatedLayout>
    );
}
