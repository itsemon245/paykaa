import { FilePond, registerPlugin } from 'react-filepond'
import 'filepond/dist/filepond.min.css'
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation'
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview'
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css'
import { FilePondFile } from 'filepond'
import { cn, trimSlashes } from '@/utils'
import { usePage } from '@inertiajs/react'

// Register the plugins
registerPlugin(FilePondPluginImageExifOrientation, FilePondPluginImagePreview, FilePondPluginFileValidateSize, FilePondPluginFileValidateType)

export interface FiledropProps {
    className?: string
    maxFiles?: number
    label?: string
    labelIdle?: string
    onProcessFile?: (path: string, storageUrl: string) => void
    allowMultiple?: boolean
    accept?: string
    path?: string
    setUploading?: (uploading: boolean) => void
}
export default function Filedrop({
    className,
    maxFiles,
    label,
    labelIdle = 'Drag and drop your file here',
    onProcessFile,
    allowMultiple,
    setUploading,
    path = 'completed',
    ...props
}: FiledropProps) {
    const [files, setFiles] = useState<FilePondFile[]>([])
    const { paths } = usePage().props;

    useEffect(() => {
        document.querySelectorAll('.filepond--credits').forEach(el => el.remove())
    }, [])
    return (
        <>
            <InputLabel className="-mb-2" value={label} />
            <FilePond
                className={cn('border-dashed border-2 border-gray-300 rounded-lg overflow-hidden flex items-center justify-center', className)}
                chunkUploads={true}
                allowFileSizeValidation={true}
                acceptedFileTypes={['image/*']}
                labelFileTypeNotAllowed="Only images are allowed"
                maxFileSize="10MB"
                chunkSize={1024 * 1024 * 2}
                chunkForce={true}
                server={{
                    url: '/upload/chunk?path=' + path,
                }}
                onaddfilestart={() => setUploading?.(true)}
                onerror={() => setUploading?.(false)}
                onprocessfileprogress={() => setUploading?.(true)}
                onprocessfile={(_, file) => {
                    const trimmedPath = trimSlashes(path);
                    let filepath = `${paths.storage}/app/public/uploads/${trimmedPath}/${file.serverId}.${file.fileExtension}`;;
                    let storageUrl = `uploads/${trimmedPath}/${file.serverId}.${file.fileExtension}`;
                    onProcessFile?.(filepath, storageUrl);
                    setUploading?.(false)
                }}
                allowMultiple={allowMultiple}
                maxFiles={maxFiles}
                {...props}
                labelIdle={labelIdle + ' or <span class="filepond--label-action">Browse</span>'}
            />
        </>
    )
}
