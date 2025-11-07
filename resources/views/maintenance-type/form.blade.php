@php($button = $button ?? true)
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni Intervento</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Tipo Intervento -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $maintenanceType->name ?? '') }}"
                                   placeholder="Es: Cambio Olio Motore"
                                   required>
                            <label for="name">{{ __('Tipo Intervento') }} <span class="text-danger">*</span></label>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="name-suggestions" class="mt-2"></div>
                    </div>

                    <!-- Descrizione -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <input type="text" name="description" id="description"
                                   class="form-control @error('description') is-invalid @enderror"
                                   value="{{ old('description', $maintenanceType->description ?? '') }}"
                                   placeholder="Es: Cambio olio motore 5W30 e filtro olio">
                            <label for="description">{{ __('Descrizione (opzionale)') }}</label>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Note -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <textarea name="note" id="note"
                                      class="form-control @error('note') is-invalid @enderror"
                                      style="height: 100px"
                                      placeholder="Note aggiuntive...">{{ old('note', $maintenanceType->note ?? '') }}</textarea>
                            <label for="note">{{ __('Note (opzionale)') }}</label>
                            @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($button)
            <div class="row mt-3">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> {{ __('Salva Tipo Intervento') }}
                    </button>
                    <a href="{{ route('maintenance-types.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> {{ __('Annulla') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
