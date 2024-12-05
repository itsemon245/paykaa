import { Card } from "primereact/card";

export default function Dashboard() {
    return (
        <AuthenticatedLayout>
            <Head title="Dashboard" />
            <Card className="m-2">
                You are browsing the dashboard
            </Card>
        </AuthenticatedLayout>
    );
}
