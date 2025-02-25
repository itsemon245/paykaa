import { PaginatedCollection, RouteName } from "@/types"
import { AddData, AddMethodData } from "@/types/_generated"
import { cn, getQuery, image } from "@/utils"
import { Link, router, useForm, usePage } from "@inertiajs/react"
import { Button } from "primereact/button"
import { Card } from "primereact/card"
import { Dialog } from "primereact/dialog"


export default function Index() {
    const initialAds = usePage().props.ads as PaginatedCollection<AddData>
    const { user } = useAuth()
    const [ads, setAds] = useState(initialAds)
    const wallets = usePage().props.wallets as AddMethodData[]
    const Header = ({ ad }: { ad: AddData }) => {
        return (
            <div className="flex py-2 md:py-3 px-3 items-center border-b">
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
            <div className="flex items-center pb-2">
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
                    header: {
                        className: "!text-base"
                    }
                }}
                className="max-w-max"
                visible={selectedAd !== undefined} onHide={() => setSelectedAd(undefined)}>
                <div className="md:px-5">
                    <h2 className="heading text-center">Are you interested in the deal?</h2>
                    <div className="font-medium text-base">Start chatting with <span className="font-bold">{selectedAd?.owner?.name}</span></div>
                    <div className="text-base font-semibold">User ID: #{selectedAd?.owner_id}</div>
                    <div className="text-base font-semibold">Contact: {selectedAd?.contact}</div>

                    <div className="flex items-center justify-center my-3">
                        {
                            selectedAd?.owner?.uuid &&
                            <>
                                {
                                    user?.uuid !== selectedAd?.owner?.uuid ?
                                        <Link href={route('chat.receiver-chat', {
                                            receiver: selectedAd?.owner?.uuid,
                                        })}>
                                            <Button label="Open Chat" />
                                        </Link>
                                        :
                                        <Button label="This is Your Ad" disabled />
                                }
                            </>
                        }
                    </div>

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
                            <Card pt={{
                                content: {
                                    className: "!py-0"
                                },
                                body: {
                                    className: "flex flex-col justify-between grow"
                                },
                                footer: {
                                    className: "!pt-0 mt-auto"
                                }
                            }} header={<Header ad={ad} />} footer={<Footer ad={ad} />} className="w-full flex flex-col" key={ad.id}>
                                <div className="py-2 flex flex-col gap-1">
                                    {ad.type === 'Sell' && <div className="flex items-end gap-0 font-semibold mb-2">
                                        <span className="me-2">Rate:</span>
                                        <span>Tk.</span>
                                        <div className="text-lg sm:text-xl font-bold">{ad.rate}</div>/
                                        <span className="text-sm">USD</span>
                                    </div>
                                    }
                                    <div className="font-medium">
                                        <span>Quantity:</span> <span className="font-semibold">{ad.amount} USD</span>
                                    </div>
                                    {ad.type === 'Sell' &&
                                        <div className="font-medium">
                                            <span>Limit:</span> <span className="font-semibold">
                                                {ad.limit_min} BDT - {ad.limit_max} BDT
                                            </span>
                                        </div>
                                    }
                                    <div className="font-medium">
                                        <span>Contact:</span> <span className="font-semibold">{ad.contact}</span>
                                    </div>
                                </div>
                            </Card>
                        ))}
                        {ads.data.length === 0 &&
                            <div className="col-span-full flex justify-center items-center !mt-5 p-3 text-gray-700 font-bold">
                                No ads published
                            </div>
                        }
                    </div>
                </div>
            </div >

        </>
    )
}
