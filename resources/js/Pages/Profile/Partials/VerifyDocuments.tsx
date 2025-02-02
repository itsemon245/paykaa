import { KycData, KycDocType } from "@/types/_generated";
import { cn } from "@/utils";
import { useForm, usePage } from "@inertiajs/react";
import { Button } from "primereact/button";
import { Card } from "primereact/card";
import { Dialog } from "primereact/dialog";
import { RadioButton } from "primereact/radiobutton";
import toast from "react-hot-toast";

export default function VerifyDocuments() {
    const kyc = usePage().props.kyc as KycData | undefined;
    const { user } = useAuth();
    const [showUploadDocDialog, setShowUploadDocDialog] = useState(false);
    const docTypes = ["Passport", "Driving License", "National ID"] as KycDocType[];
    const { data, setData, post, errors, processing, recentlySuccessful } = useForm({
        doc_type: undefined,
        front_image: '',
        back_image: '',
    })
    const submit = async (e: React.FormEvent<HTMLFormElement> | React.MouseEvent<HTMLButtonElement>) => {
        e.preventDefault()
        if (!data.doc_type) {
            toast.error('Please select a document type')
            return;
        }
        const toastId = toast.loading('Submitting Documents...')
        post(route('kyc.store'), {
            onSuccess: (data) => {
                console.log(data);
                if (data.props.error) {
                    toast.error(data.props.error)
                    return;
                }
                toast.success('Documents Submitted Successfully!')
                setShowUploadDocDialog(false)
            },
            onError: (err) => {
                console.error('Error while submitting KYC', err)
                toast.error('Failed to submit documents!')
            },
            onFinish: () => {
                toast.dismiss(toastId)
            }
        })
    }
    const Footer = () => {
        return (
            <div className="flex justify-end md:flex-row-reverse gap-2">
                <Button outlined label="Cancel" onClick={() => setShowUploadDocDialog(false)} />
                <Button label="Submit" onClick={submit} loading={processing} disabled={processing} />
            </div>
        )
    }
    return (<Card className="border-black rounded-lg h-max">
        <div className="flex flex-col gap-3">
            <div className={cn('font-bold text-lg pb-3 border-b', kyc?.approved_at ? 'text-green-500' : kyc?.rejected_at ? 'text-red-500' : '')}>{
                kyc ?
                    kyc?.approved_at ?
                        'Documents Verified' :
                        kyc?.rejected_at ?
                            'Documents Rejected' :
                            'Documents Processing...'
                    : 'Verification of documents'
            }</div>
            {kyc && !kyc.rejected_at && <>
                <p className="text-green-500 font-bold">{
                    kyc.approved_at ? 'Your documents have been verified.' : 'Hold up we are processing your documents...'
                }</p>
            </>}
            {kyc?.rejected_at &&
                <>
                    <p className='text-red-500 font-bold'>Your documents have been rejected.</p>
                    <p className=''>Please re-upload your documents to try again.</p>
                </>
            }
            {!kyc && <p>Please upload any of the following documents to verify your identity:</p>}
            {(!kyc || kyc.rejected_at) && <>
                <ul className='list-disc ps-6'>
                    <li>Passport</li>
                    <li>Driving license</li>
                    <li>National ID card</li>
                </ul>
                <Button className='w-full flex justify-center' label={kyc?.rejected_at ? 'Re-Upload Documents' : 'Upload Documents'} onClick={() => setShowUploadDocDialog(true)} />
            </>
            }
        </div>
        <Dialog visible={showUploadDocDialog} footer={<Footer />} onHide={() => setShowUploadDocDialog(false)} header="Upload Documents" position="top" className="w-[90vw] sm:w-max sm:min-w-[500px] md:min-w-[600px]">
            <div className="flex flex-col gap-3">
                {docTypes.map(docType => (
                    <div key={docType} className="flex align-items-center">
                        <RadioButton inputId={docType} name="doc_type" value={docType} onChange={(e) => setData('doc_type', e.target.value)} checked={data.doc_type === docType} />

                        <InputLabel htmlFor={docType} className="ms-2 cursor-pointer">{docType}</InputLabel>
                    </div>
                ))}
                {data.doc_type && <div className="flex flex-col gap-3 w-full">
                    <Filedrop label="Upload Front Image" className="min-h-[180px]" labelIdle={"Drop your front image of your " + data.doc_type} onProcessFile={(path, storageUrl) => setData('front_image', storageUrl)} />
                    <InputError message={errors.front_image} className="-mt-4" />
                    <Filedrop label="Upload Back Image" className="min-h-[180px]" labelIdle={"Drop your back image of your " + data.doc_type} onProcessFile={(path, storageUrl) => setData('back_image', storageUrl)} />
                    <InputError message={errors.back_image} className="-mt-4" />
                </div>}


            </div>


        </Dialog>
    </Card>
    )
}
