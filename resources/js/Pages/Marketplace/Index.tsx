import { PaginatedCollection, RouteName } from "@/types"
import { AddData, AddMethodData } from "@/types/_generated"
import { cn, getQuery, image } from "@/utils"
import { Link, router, useForm, usePage } from "@inertiajs/react"
import { Button } from "primereact/button"
import { Card } from "primereact/card"
import { Dialog } from "primereact/dialog"


export default function Index() {
    const initialAds = usePage().props.ads as PaginatedCollection<AddData>
    const [ads, setAds] = useState(initialAds)
    const wallets = usePage().props.wallets as AddMethodData[]
    const Header = ({ ad }: { ad: AddData }) => {
        return (
            <div className="flex py-4 px-3 items-center border-b">
                <div className="flex-1 flex items-center gap-2">
                    <img src={image(ad.owner?.avatar)} className="w-10 h-10 rounded-full" />
                    <h2 className="font-bold">{ad.owner?.name}</h2>
                </div>
                <div className="text-nowrap text-sm text-gray-400">
                    {ad.updated_at_human}
                </div>
            </div>
        )
    }
    const Footer = ({ ad }: { ad: AddData }) => {
        return (
            <div className="flex items-center pb-3 -mt-6">
                <div className="flex-1">
                    <h2 className="font-bold">Method: {ad.addMethod?.name}</h2>
                </div>
                <Button label="Sell" severity="success" size="small" onClick={() => setSelectedAd(ad)} />
            </div>
        )
    }
    const [type, setType] = useState(getQuery('type'))
    const [walletId, setWalletId] = useState(getQuery('wallet_id') || '')
    const submit = () => {
        router.visit(route('marketplace.index', {
            type,
            wallet_id: walletId,
        }), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: (data) => {
                setAds(data.props.ads as PaginatedCollection<AddData>)
            },
        })
    }
    const [selectedAd, setSelectedAd] = useState<AddData>()
    return (
        <>
            <Head title="Marketplace" />
            <SquareBg />
            <ClassicNav />
            <Dialog header={selectedAd?.type + ' ' + selectedAd?.addMethod?.name} footer={
                <div className="flex flex-row-reverse sm:flex-row gap-1 items-center">
                    {selectedAd?.owner?.uuid &&
                        <Link href={route('chat.receiver-chat', {
                            receiver: selectedAd?.owner?.uuid,
                        })}>
                            <Button label="Chat" />
                        </Link>
                    }
                    <Button label="Cancel" onClick={() => setSelectedAd(undefined)} className="bg-white text-primary border-primary" text />
                </div>
            } visible={selectedAd !== undefined} onHide={() => setSelectedAd(undefined)}>
                <div className="">
                    <h2 className="font-lg font-semibold">Start chatting with {selectedAd?.owner?.name}</h2>
                    <h2 className="font-lg font-semibold">Contact: {selectedAd?.contact}</h2>
                </div>
            </Dialog>
            <div className="flex flex-col h-full w-full">
                <div className="w-full max-w-7xl mx-auto mt-3 px-3">
                    <div className="flex items-center gap-2 my-3">
                        <button onClick={() => {
                            setType('buy')
                            submit()
                        }} className={cn("font-bold py-2 px-3 rounded-md transition-colors", type == 'buy' ? 'bg-primary text-white' : 'bg-white text-primary')}>
                            Buy
                        </button>
                        <button onClick={() => {
                            setType('sell')
                            submit()
                        }} className={cn("font-bold py-2 px-3 rounded-md transition-colors", type == 'sell' ? 'bg-primary text-white' : 'bg-white text-primary')}>
                            Sell
                        </button>
                        <select onChange={(e) => {
                            setWalletId(e.target.value)
                            submit()
                        }} className="p-2 rounded-md border-none text-primary font-semibold" defaultValue={walletId}>
                            <option value="" disabled>Select Wallet</option>
                            {wallets.map(item => (
                                <option value={item.id} key={item.id}>{item.name}</option>
                            ))}
                        </select>
                    </div>

                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 3xl:grid-cols-4 gap-3">
                        {ads.data.map((ad) => (
                            <Card header={<Header ad={ad} />} footer={<Footer ad={ad} />} className="w-full" key={ad.id}>
                                <div className="">
                                    <div className="flex items-end gap-1 font-semibold">
                                        <span>Tk.</span>
                                        <h2 className="text-xl font-bold">{ad.rate}</h2>
                                    </div>
                                    <div>
                                        Quantity: {ad.amount}
                                    </div>
                                    <div>
                                        Limit: {ad.limit_min} - {ad.limit_max}
                                    </div>
                                </div>
                            </Card>
                        ))}
                        {ads.data.length === 0 &&
                            <div className="col-span-full flex justify-center items-center mt-5 p-3 text-gray-700 font-bold">
                                No ads published yet
                            </div>
                        }
                    </div>
                </div>
            </div >

        </>
    )
}
