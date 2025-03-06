"use client"
import { useState, useRef, useEffect } from "react"

interface HoldToSendButtonProps {
    onComplete: (success?: () => void) => void
    holdTime?: number
}

export default function HoldToSendButton({ onComplete, holdTime = 3000 }: HoldToSendButtonProps) {
    const [isHolding, setIsHolding] = useState(false)
    const [processing, setProcessing] = useState<boolean | null>(null)
    const [progress, setProgress] = useState(0)
    const buttonRef = useRef<HTMLButtonElement>(null)
    const intervalRef = useRef<any>(null)

    // Start holding function
    const startHold = () => {
        setIsHolding(true)
        setProgress(0)

        // Clear any existing interval
        if (intervalRef.current) {
            clearInterval(intervalRef.current)
        }

        // Set start time
        const startTime = Date.now()

        // Create interval to update progress
        intervalRef.current = setInterval(() => {
            const elapsedTime = Date.now() - startTime
            const newProgress = Math.min((elapsedTime / holdTime) * 100, 100)
            setProgress(newProgress)

            //start processing at 90% progress
            if (newProgress >= 90) {
                if (!processing) {
                    setProcessing(true)
                }
            }

            // If progress reaches 100%, complete the action
            if (newProgress >= 100) {
                clearInterval(intervalRef.current!)
                setIsHolding(false)
            }
        }, 50) // Update every 50ms for smooth animation
    }

    // Stop holding function
    const stopHold = () => {
        if (intervalRef.current) {
            clearInterval(intervalRef.current)
            intervalRef.current = null
        }
        setIsHolding(false)
        setProgress(0)
    }
    useEffect(() => {
        if (processing !== null) {
            if (isHolding && processing) {
                onComplete(() => {
                    setProcessing(false)
                })
            }
        }
    }, [isHolding, processing])

    // Clean up on unmount
    useEffect(() => {
        return () => {
            if (intervalRef.current) {
                clearInterval(intervalRef.current)
            }
        }
    }, [])

    return (
        <div className="w-full">
            <button
                ref={buttonRef}
                className="relative select-none w-full py-4 rounded-lg font-medium text-white bg-primary overflow-hidden"
                onMouseDown={startHold}
                onMouseUp={stopHold}
                onMouseLeave={stopHold}
                onTouchStart={startHold}
                onTouchEnd={stopHold}
                onTouchCancel={stopHold}
                onPointerDown={(e) => e.preventDefault()} // Prevents context menu on various input types
                onContextMenu={(e) => e.preventDefault()} // Disables right-click menu
                type="button"
            >
                {/* Button text */}
                <span className="relative z-10">{processing ? "Processing..." : "Hold to Send Money"}</span>

                {/* Progress animation */}
                <div
                    className="absolute left-0 top-0 h-full bg-white/30"
                    style={{
                        width: `${progress}%`,
                        transition: "width 0.05s linear",
                        backgroundImage: "linear-gradient(to right, rgba(255,255,255,0.2), rgba(255,255,255,0.4))",
                    }}
                />

                {/* Animated gradient overlay for better visual effect */}
                {isHolding && (
                    <div
                        className="absolute left-0 top-0 h-full w-full"
                        style={{
                            background: "linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent)",
                            backgroundSize: "200% 100%",
                            animation: "shimmer 1.5s infinite",
                        }}
                    />
                )}
            </button>
        </div>
    )
}

