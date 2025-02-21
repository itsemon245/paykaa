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
                    <div className="font-bold text-lg">{ad.owner?.name}</div>
                </div>
                <div className="text-nowrap text-sm text-gray-400">
                    {ad.updated_at_human}
                </div>
            </div>
        )
    }
    const Footer = ({ ad }: { ad: AddData }) => {
        return (
            <div className="flex items-center pb-3">
                <div className="flex-1">
                    <div className="font-bold">Method: {ad.addMethod?.name}</div>
                </div>
                <Button className="uppercase" label={ad.type} severity={ad.type == 'Buy' ? 'success' : 'danger'} size="small" onClick={() => setSelectedAd(ad)} />
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
    useEffect(() => {
        if (type || walletId) {
            submit()
        }
    }, [type, walletId])
    const [selectedAd, setSelectedAd] = useState<AddData>()
    return (
        <>
            <Head title="Marketplace" />
            <SquareBg />
            <ClassicNav />
            <Dialog header={selectedAd?.type + ' ' + selectedAd?.addMethod?.name}
                pt={{
                    content: {
                        className: "!py-0"
                    },
                    footer: {
                        className: "!pb-0"
                    }
                }}
                footer={
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
                    <form onSubmit={submit} className="flex items-center gap-2 my-3">
                        <label className={cn("cursor-pointer font-bold py-2 px-3 rounded-md transition-colors", type == 'buy' ? 'bg-primary text-white' : 'bg-white text-primary')}>
                            <input type="radio" name="type" value={type as string} checked={type == 'buy'} className="sr-only peer" onChange={() => setType('buy')} />
                            Buy
                        </label>
                        <label className={cn("cursor-pointer font-bold py-2 px-3 rounded-md transition-colors", type == 'sell' ? 'bg-primary text-white' : 'bg-white text-primary')}>
                            <input type="radio" name="type" value={type as string} checked={type == 'sell'} className="sr-only peer" onChange={() => setType('sell')} />

                            Sell
                        </label>
                        <select onChange={(e) => {
                            setWalletId(e.target.value)
                        }} className="mb-2 min-w-[140px] flex gap-2 p-2 rounded-md border-none text-primary font-semibold" defaultValue={walletId}>
                            <option value="" disabled>Select Wallet</option>
                            {wallets.map(item => (
                                <option value={item.id} key={item.id}>{item.name}</option>
                            ))}
                        </select>
                    </form>

                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 3xl:grid-cols-4 gap-3" >
                        {ads.data.map((ad) => (
                            <Card header={<Header ad={ad} />} footer={<Footer ad={ad} />} className="w-full" key={ad.id}>
                                <div className="">
                                    {ad.type === 'Sell' && <div className="flex items-end gap-1 font-semibold">
                                        <span>Tk.</span>
                                        <div className="text-lg sm:text-xl font-bold">{ad.rate}</div>
                                    </div>
                                    }
                                    <div>
                                        Quantity: {ad.amount} USD
                                    </div>
                                    {ad.type === 'Sell' && <div>
                                        Limit: {ad.limit_min} - {ad.limit_max}
                                    </div>
                                    }
                                </div>
                            </Card>
                        ))}
                        {ads.data.length === 0 &&
                            <div className="col-span-full flex justify-center items-center !mt-5 p-3 text-gray-700 font-bold">
                                No ads published yet
                            </div>
                        }
                    </div>
                </div>
            </div >

        </>
    )
}
