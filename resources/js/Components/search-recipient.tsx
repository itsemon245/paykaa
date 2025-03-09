"use client"

import { useState, useEffect, useRef } from "react"
import { Search } from "lucide-react"
import { defaultAvatar, image } from "@/utils"
import { UserData } from "@/types/_generated"

interface SearchRecipientProps {
    onSelectRecipient: (recipient: UserData) => void
}

export default function SearchRecipient({ onSelectRecipient }: SearchRecipientProps) {
    const { users, searchString, setSearchString } = useUsers()
    const [results, setResults] = useState<UserData[]>([])
    const [isDropdownOpen, setIsDropdownOpen] = useState(false)
    const dropdownRef = useRef<HTMLDivElement>(null)

    useEffect(() => {
        if (searchString.trim() === "") {
            setIsDropdownOpen(false)
            return
        }
        if (users.length > 0) {
            setResults(users)
        } else {
            setResults([])
        }
        setIsDropdownOpen(users.length > 0)
    }, [users, searchString])

    useEffect(() => {
        // Close dropdown when clicking outside
        function handleClickOutside(event: MouseEvent) {
            if (dropdownRef.current && !dropdownRef.current.contains(event.target as Node)) {
                setIsDropdownOpen(false)
            }
        }

        document.addEventListener("mousedown", handleClickOutside)
        return () => {
            document.removeEventListener("mousedown", handleClickOutside)
        }
    }, [])

    return (
        <div className="relative w-full" ref={dropdownRef}>
            <div className="relative !flex items-center *:w-full grow rounded-lg border border-primary">
                <Input
                    type="text"
                    label={undefined}
                    className="w-full border-none outline-none ring-0 !ps-8"
                    placeholder="Search by UID"
                    value={searchString}
                    onChange={(e) => setSearchString(e.target.value)}
                />
                <Search className="absolute left-2 transform  text-gray-400 h-5 !w-5" />
            </div>

            {isDropdownOpen && (
                <div className="absolute mt-1 w-full bg-white rounded-md shadow-lg max-h-60 overflow-auto z-10">
                    {results.map((recipient) => (
                        <div
                            key={recipient.id}
                            className="flex items-center p-3 hover:bg-gray-100 cursor-pointer"
                            onClick={() => onSelectRecipient(recipient)}
                        >
                            <div className="h-10 w-10 rounded-full overflow-hidden bg-gray-200 flex-shrink-0">
                                <img
                                    src={image(recipient.avatar)}
                                    onError={(e) => {
                                        //@ts-ignore
                                        e.target.src = defaultAvatar
                                    }}
                                    alt={recipient.name}
                                    className="h-full w-full object-cover"
                                />
                            </div>
                            <div className="ml-3">
                                <p className="font-medium">{recipient.name}</p>
                                <p className="text-sm text-gray-500">UID: {recipient.id}</p>
                            </div>
                        </div>
                    ))}
                </div>
            )}
        </div>
    )
}

