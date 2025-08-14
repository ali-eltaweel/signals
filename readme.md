# Signals

**Posix Signals**

## Installation

```bash
composer require ali-eltaweel/signals
```

## Usage

```php
declare(ticks=1);

use Signals\Signal;

Signal::SIGILL->handle(function(Signal $signal, array $siginfo) {
    
    // ...
});

Signal::SIGILL->kill(getmypid());
```
