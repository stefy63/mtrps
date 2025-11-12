@php($button = $button ?? true)
<div class="row padding-1 p-1">
    <div class="col-md-12">
        {{-- Nome Equipaggiamento --}}
        <div class="form-floating mb-3">
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $carEquipment->name) }}"
                   placeholder="Nome Equipaggiamento"
                   list="equipment-suggestions">
            <label for="name" class="form-label">{{ __('Equipaggiamento') }} <span class="text-danger">*</span></label>
            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}

            {{-- Suggerimenti dinamici --}}
            <datalist id="equipment-suggestions">
                {{-- Popolato dinamicamente via JS --}}
            </datalist>
        </div>

        {{-- Descrizione --}}
        <div class="form-floating mb-3">
            <input type="text" name="description" id="description"
                   class="form-control @error('description') is-invalid @enderror"
                   value="{{ old('description', $carEquipment->description) }}"
                   placeholder="Descrizione">
            <label for="description" class="form-label">{{ __('Descrizione') }}</label>
            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    @if($button)
        <div class="col-md-12 mt-3">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> {{ __('Salva') }}
            </button>
            <a href="{{ route('equipments.index') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> {{ __('Annulla') }}
            </a>
        </div>
    @endif
</div>
