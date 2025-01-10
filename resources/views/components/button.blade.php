
<div>
    <button {{ $attributes->merge(['class' => 'bg-' . $color . ' text-white']) }}>
        {{ $slot }}
    </button>
</div>