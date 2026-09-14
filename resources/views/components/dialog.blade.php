<dialog id="{{ $id }}" closedby="any" class="dialog">
    <x-button type="button" commandfor="{{ $id }}" command="close" icon="x" modifiers="transparent icon">Close</x-button>
    {{ $slot }}
</dialog>
