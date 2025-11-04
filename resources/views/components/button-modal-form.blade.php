<div
        x-data='buttonModalHandler({
            endpoint: "{{ $endpoint }}",
            label: "{{ $label ?? null }}",
            url: "{{ $url }}",
            modalTitle: "{{ $modalTitle ?? "Nuovo elemento" }}",
            modalClass: "{{ $modalClass ?? "" }}",
            class: "{{ $class ?? "" }}",
            icon: "{{$icon ?? null}}",
        })'
>
    <div>
        <div class="position-relative">
            <button class="btn {{$class}}"
                    @click="openModal"
                    type="button"
            >
                <template x-if="icon">
                    <i class="bi {{$icon}}"></i>
                </template>
                <template x-if="label">
                    <span x-text="label"></span>
                </template>

            </button>
        </div>
    </div>
</div>