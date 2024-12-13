import { format, isThisWeek, isToday, isYesterday, parseISO } from 'date-fns';

export default function Date({ date, prev }: { date: string, prev?: string }) {
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

    const parsedDate = parseISO(date);
    let visualDate = getVisualDate(parsedDate);
    if (prev) {
        const getPrevVisualDate = getVisualDate(parseISO(prev));
        if (getPrevVisualDate === visualDate) {
            return null;
        }
    }

    return (
        <div className="date">
            <hr />
            <span className="text-nowrap">{visualDate}</span>
            <hr />
        </div>
    )
}
