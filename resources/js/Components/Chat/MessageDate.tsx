import { format, isThisWeek, isToday, isYesterday, parseISO } from 'date-fns';

export default function MessageDate({ date, prev }: { date?: string, prev?: string }) {
    const getVisualDate = (date: Date) => {
        const DATE_FORMAT = 'MMMM dd, yyyy';
        let visualDate = format(date, DATE_FORMAT);
        if (isToday(date)) {
            visualDate = "Today"
        } else if (isYesterday(date)) {
            visualDate = "Yesterday"
        } else if (isThisWeek(date)) {
            visualDate = format(date, 'eeee, MMMM dd, yyyy');
        } else {
            visualDate = format(date, DATE_FORMAT);
        }
        return visualDate;
    }

    const parsedDate = parseISO(date as string);
    let visualDate = getVisualDate(parsedDate);
    if (prev) {
        const getPrevVisualDate = getVisualDate(parseISO(prev));
        if (getPrevVisualDate === visualDate) {
            return null;
        }
    }

    return (
        <div className="flex items-center gap-2 justify-center font-normal text-sm my-2">
            <div className="w-[20%] max-w-[100px] h-px bg-gray-400"></div>
            <div className="text-nowrap" >{visualDate}</div>
            <div className="w-[20%] max-w-[100px] h-px bg-gray-400"></div>
        </div>
    )
}
