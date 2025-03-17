//@ts-nocheck
import { transform } from '@/utils'
import Picker from '@/Components/Picker'
import { useMessageStore } from '@/stores/useMessageStore'

export interface PickerItems {
    day: number[],
    hour: number[],
    minute: number[],
}
export interface PickerValue {
    day: number,
    hour: number,
    minute: number,
}

const selections: PickerItems = {
    day: Array.from({ length: 32 }, (_, i) => i),
    hour: Array.from({ length: 61 }, (_, i) => i),
    minute: Array.from({ length: 61 }, (_, i) => i)
}

export default function TimeSelector() {
    const duration = useMessageStore(state => state.duration)
    const setDuration = useMessageStore(state => state.setDuration)
    return (
        <div>
            <div className="my-1 text-gray-800 grid grid-cols-3 gap-2 justify-center *:text-center *:font-bold *:text-md">
                <label>Day</label>
                <label>Hour</label>
                <label>Minute</label>
            </div>
            <Picker value={duration} onChange={setDuration} wheelMode='normal' height={100}>
                {Object.keys(selections).map(name => (
                    <Picker.Column label={transform(name, "title")} key={name} name={name}>
                        {selections[name].map(option => (
                            <Picker.Item key={option} value={option}>
                                {option}
                            </Picker.Item>
                        ))}
                    </Picker.Column>
                ))}
            </Picker>
        </div>
    )
}
