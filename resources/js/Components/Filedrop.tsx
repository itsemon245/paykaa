import { FilePond, registerPlugin } from 'react-filepond'
import 'filepond/dist/filepond.min.css'
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation'
import FilePondPluginImagePreview from 'filepond-plugin-image-preview'
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css'
import { FilePondFile } from 'filepond'
import { cn } from '@/utils'
import { usePage } from '@inertiajs/react'

// Register the plugins
registerPlugin(FilePondPluginImageExifOrientation, FilePondPluginImagePreview)

export interface FiledropProps {
    className?: string
    maxFiles?: number
    label?: string
    labelIdle?: string
    onProcessFile?: (path: string, storageUrl: string) => void
    allowMultiple?: boolean
}
export default function Filedrop({
    className,
    maxFiles,
    label,
    labelIdle,
    onProcessFile,
    allowMultiple,
    ...props
}: FiledropProps) {
    const [files, setFiles] = useState<FilePondFile[]>([])
    const { paths } = usePage().props;

    useEffect(() => {
        document.querySelectorAll('.filepond--credits').forEach(el => el.remove())
    }, [])
    return (
        <>
            <InputLabel value={label} />
            <FilePond
                className={cn('border-dashed border-2 border-gray-300 rounded-lg overflow-hidden flex items-center justify-center', className)}
                chunkUploads={true}
                chunkSize={1024 * 1024 * 2}
                chunkForce={true}
                server={{
                    url: '/upload/chunk',
                }}
                onprocessfile={(_, file) => {
                    let path = `${paths.storage}/app/public/temp/completed/${file.serverId}.${file.fileExtension}`;;
                    let storageUrl = "temp/completed/" + file.serverId + "." + file.fileExtension;
                    onProcessFile?.(path, storageUrl);
                }}
                allowMultiple={allowMultiple}
                maxFiles={maxFiles}
                {...props}
                labelIdle={labelIdle + ' or <span class="filepond--label-action">Browse</span>'}
            />
        </>
    )
}
