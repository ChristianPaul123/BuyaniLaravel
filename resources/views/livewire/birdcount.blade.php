<div>
    <p>Number of birds seen: <span id="bird-count"> {{ $birdcount }}</span></p>
    {{ $birdcounttext }}
    <button wire:click="incrementCount()">Increment Count</button>

</div>
