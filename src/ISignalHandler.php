<?php

namespace Signals;

/**
 * Posix Signal Handler Interface.
 * 
 * @api
 * @abstract
 * @since 1.0.0
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
interface ISignalHandler {

    /**
     * Handle the signal.
     * 
     * @api
     * @abstract
     * @since 1.0.0
     * @version 1.0.0
     * 
     * @param Signal $signal The signal that was received.
     * @param array $siginfo Additional signal information.
     * @return void
     */
    function __invoke(Signal $signal, array $siginfo): void;
}
