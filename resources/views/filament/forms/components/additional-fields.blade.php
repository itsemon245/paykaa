<div class="grid md:grid-cols-2 gap-4">
@foreach ($getRecord()->additional_fields as $item)
    <div>
        <label for="{{$item['label']}}" class="block mb-2 text-sm font-medium text-gray-700">{{ $item['label'] }}</label>
        <x-filament::input.wrapper style="background: rgba(var(--gray-50), var(--tw-bg-opacity, 1));">
            <x-filament::input
                id="{{$item['label']}}"
                type="text"
                disabled
                value="{{$item['value']}}"
                />
            </x-filament::input.wrapper>
    </div>
@endforeach
</div>
