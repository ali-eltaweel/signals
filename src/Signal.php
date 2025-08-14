<?php

namespace Signals;

/**
 * Posix Signal.
 * 
 * @api
 * @since 1.0.0
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
enum Signal: int {

    // Standard POSIX signals
    case SIGHUP = 1;    // Hangup detected on controlling terminal or death of controlling process
    case SIGINT = 2;    // Interrupt from keyboard (Ctrl+C)
    case SIGQUIT = 3;   // Quit from keyboard (Ctrl+\)
    case SIGILL = 4;    // Illegal Instruction
    case SIGTRAP = 5;   // Trace/breakpoint trap
    case SIGABRT = 6;   // Abort signal from abort(3)
    case SIGBUS = 7;    // Bus error (bad memory access)
    case SIGFPE = 8;    // Floating-point exception
    case SIGKILL = 9;   // Kill signal (cannot be caught or ignored)
    case SIGUSR1 = 10;  // User-defined signal 1
    case SIGSEGV = 11;  // Invalid memory reference
    case SIGUSR2 = 12;  // User-defined signal 2
    case SIGPIPE = 13;  // Broken pipe: write to pipe with no readers
    case SIGALRM = 14;  // Timer signal from alarm(2)
    case SIGTERM = 15;  // Termination signal
    case SIGSTKFLT = 16; // Stack fault on coprocessor (unused)
    case SIGCHLD = 17;  // Child stopped or terminated
    case SIGCONT = 18;  // Continue if stopped
    case SIGSTOP = 19;  // Stop process (cannot be caught or ignored)
    case SIGTSTP = 20;  // Stop typed at terminal (Ctrl+Z)
    case SIGTTIN = 21;  // Background process attempting read
    case SIGTTOU = 22;  // Background process attempting write
    case SIGURG = 23;   // Urgent condition on socket
    case SIGXCPU = 24;  // CPU time limit exceeded
    case SIGXFSZ = 25;  // File size limit exceeded
    case SIGVTALRM = 26; // Virtual alarm clock
    case SIGPROF = 27;  // Profiling timer expired
    case SIGWINCH = 28; // Window resize signal
    case SIGIO = 29;    // I/O now possible (Linux-specific)
    case SIGPWR = 30;   // Power failure (System V)
    case SIGSYS = 31;   // Bad system call (SVr4)
    
    // Real-time signals (Linux-specific, POSIX.1-2001)
    case SIGRTMIN = 34;     // First real-time signal
    case SIGRTMIN_1 = 35;   // Real-time signal 1
    case SIGRTMIN_2 = 36;   // Real-time signal 2
    case SIGRTMIN_3 = 37;   // Real-time signal 3
    case SIGRTMIN_4 = 38;   // Real-time signal 4
    case SIGRTMIN_5 = 39;   // Real-time signal 5
    case SIGRTMIN_6 = 40;   // Real-time signal 6
    case SIGRTMIN_7 = 41;   // Real-time signal 7
    case SIGRTMIN_8 = 42;   // Real-time signal 8
    case SIGRTMIN_9 = 43;   // Real-time signal 9
    case SIGRTMIN_10 = 44;  // Real-time signal 10
    case SIGRTMIN_11 = 45;  // Real-time signal 11
    case SIGRTMIN_12 = 46;  // Real-time signal 12
    case SIGRTMIN_13 = 47;  // Real-time signal 13
    case SIGRTMIN_14 = 48;  // Real-time signal 14
    case SIGRTMIN_15 = 49;  // Real-time signal 15
    case SIGRTMAX_14 = 50;  // Real-time signal (SIGRTMAX-14)
    case SIGRTMAX_13 = 51;  // Real-time signal (SIGRTMAX-13)
    case SIGRTMAX_12 = 52;  // Real-time signal (SIGRTMAX-12)
    case SIGRTMAX_11 = 53;  // Real-time signal (SIGRTMAX-11)
    case SIGRTMAX_10 = 54;  // Real-time signal (SIGRTMAX-10)
    case SIGRTMAX_9 = 55;   // Real-time signal (SIGRTMAX-9)
    case SIGRTMAX_8 = 56;   // Real-time signal (SIGRTMAX-8)
    case SIGRTMAX_7 = 57;   // Real-time signal (SIGRTMAX-7)
    case SIGRTMAX_6 = 58;   // Real-time signal (SIGRTMAX-6)
    case SIGRTMAX_5 = 59;   // Real-time signal (SIGRTMAX-5)
    case SIGRTMAX_4 = 60;   // Real-time signal (SIGRTMAX-4)
    case SIGRTMAX_3 = 61;   // Real-time signal (SIGRTMAX-3)
    case SIGRTMAX_2 = 62;   // Real-time signal (SIGRTMAX-2)
    case SIGRTMAX_1 = 63;   // Real-time signal (SIGRTMAX-1)
    case SIGRTMAX = 64;     // Last real-time signal

    /**
     * Sends this signal to a process.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     * 
     * @param int $pid Process ID to send the signal to.
     * @return bool True on success, false on failure.
     */
    public final function kill(int $pid): bool {

        return posix_kill($pid, $this->value);
    }

    /**
     * Registers a signal handler.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     * 
     * @param callable|ISignalHandler $handler Signal handler callable or an instance of ISignalHandler.
     * @param bool $restart_syscalls Whether to restart system calls interrupted by this signal.
     * @return bool True on success, false on failure.
     */
    public final function handle(callable|ISignalHandler $handler, bool $restart_syscalls = true): bool {

        return pcntl_signal(
            $this->value,
            fn (int $signo, array $siginfo) => $handler(self::from($signo), $siginfo),
            $restart_syscalls
        );
    }
}
