import { Button } from "@/components/ui/button"
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog"
import { cn } from "@/lib/utils";
import { useConfirmStore } from "@/stores/useConfirmStore"
export default function ConfirmationDialog() {
    const open = useConfirmStore((state) => state.open);
    const description = useConfirmStore((state) => state.description);
    const variant = useConfirmStore((state) => state.variant);
    const setOpen = useConfirmStore((state) => state.setOpen);
    const onConfirm = useConfirmStore((state) => state.onConfirm);
    const onCancel = useConfirmStore((state) => state.onCancel);

    return <Dialog open={open} onOpenChange={setOpen} >
        <DialogContent>
            <DialogHeader>
                <DialogTitle className={cn("!text-lg !font-semibold !leading-none !tracking-tight !text-dark", `!text-black`)}>Are you absolutely sure?</DialogTitle>
                <DialogDescription>
                    {description}
                </DialogDescription>
            </DialogHeader>
            <DialogFooter className="flex flex-row justify-center sm:justify-end gap-2 flex-wrap">
                <Button variant="outline" onClick={() => {
                    setOpen(false)
                    onCancel()
                }}>Cancel</Button>
                <Button variant={variant} onClick={() => {
                    setOpen(false)
                    onConfirm()
                }}>Confirm</Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
}
