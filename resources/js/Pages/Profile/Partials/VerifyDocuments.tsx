import { Button } from "primereact/button";
import { Card } from "primereact/card";

export default function VerifyDocuments() {
    return (<Card className="border-black rounded-lg h-max">
        <div className="flex flex-col gap-3">
            <div className='font-bold text-lg pb-3 border-b'> Verification of documents</div>
            <p>Please upload any of the following documents to verify your identity:</p>
            <ul className='list-disc ps-6'>
                <li>Passport</li>
                <li>Driving license</li>
                <li>National ID card</li>
            </ul>
            <Button className='w-full' label='Upload Documents' />
        </div>
    </Card>
    )
}
