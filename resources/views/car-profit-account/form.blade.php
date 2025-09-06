<div class="row padding-1 p-1">
    <div class="col-md-12">

        {{-- Informazioni Base --}}
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-info-circle"></i> Informazioni Base
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- Codice --}}
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text"
                                   name="code"
                                   class="form-control @error('code') is-invalid @enderror"
                                   value="{{ old('code', $carProfitAccount?->code) }}"
                                   id="code"
                                   placeholder="Codice"
                                   required
                                   style="text-transform: uppercase;">
                            <label for="code">{{ __('Codice') }} *</label>
                            {!! $errors->first('code', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            <small class="text-muted">Es: CEC0001, AMM001, OPER001</small>
                        </div>
                    </div>

                    {{-- Nome --}}
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $carProfitAccount?->name) }}"
                                   id="name"
                                   placeholder="Nome"
                                   required>
                            <label for="name">{{ __('Nome Centro di Costo') }} *</label>
                            {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                    </div>

                    {{-- Categoria --}}
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <select name="category"
                                    class="form-select @error('category') is-invalid @enderror"
                                    id="category">
                                <option value="">Seleziona categoria...</option>
                                @foreach($categories as $key => $label)
                                    <option value="{{ $key }}" {{ old('category', $carProfitAccount?->category) == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="category">{{ __('Categoria') }}</label>
                            {!! $errors->first('category', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                    </div>

                    {{-- Descrizione --}}
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <textarea name="description"
                                      class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      placeholder="Descrizione"
                                      style="height: 80px">{{ old('description', $carProfitAccount?->description) }}</textarea>
                            <label for="description">{{ __('Descrizione') }}</label>
                            {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Organizzazione --}}
        <div class="card mb-3">
            <div class="card-header bg-info text-white">
                <i class="bi bi-building"></i> Organizzazione
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- Dipartimento --}}
                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <input type="text"
                                   name="department"
                                   class="form-control @error('department') is-invalid @enderror"
                                   value="{{ old('department', $carProfitAccount?->department) }}"
                                   id="department"
                                   placeholder="Dipartimento"
                                   list="department-suggestions">
                            <label for="department">{{ __('Dipartimento/Ufficio') }}</label>
                            {!! $errors->first('department', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            <datalist id="department-suggestions">
                                @foreach($suggestedDepartments as $dept)
                                    <option value="{{ $dept }}">
                                @endforeach
                            </datalist>
                        </div>
                    </div>

                    {{-- Responsabile --}}
                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <input type="text"
                                   name="responsible"
                                   class="form-control @error('responsible') is-invalid @enderror"
                                   value="{{ old('responsible', $carProfitAccount?->responsible) }}"
                                   id="responsible"
                                   placeholder="Responsabile">
                            <label for="responsible">{{ __('Responsabile') }}</label>
                            {!! $errors->first('responsible', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <input type="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $carProfitAccount?->email) }}"
                                   id="email"
                                   placeholder="Email">
                            <label for="email">{{ __('Email Responsabile') }}</label>
                            {!! $errors->first('email', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                    </div>

                    {{-- Telefono --}}
                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <input type="text"
                                   name="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', $carProfitAccount?->phone) }}"
                                   id="phone"
                                   placeholder="Telefono">
                            <label for="phone">{{ __('Telefono Responsabile') }}</label>
                            {!! $errors->first('phone', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                            <small class="text-muted">Formato: +39 012 3456789</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Budget --}}
        <div class="card mb-3">
            <div class="card-header bg-success text-white">
                <i class="bi bi-currency-euro"></i> Budget
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- Budget Annuale --}}
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text">€</span>
                            <div class="form-floating">
                                <input type="number"
                                       name="budget_year"
                                       class="form-control @error('budget_year') is-invalid @enderror"
                                       value="{{ old('budget_year', $carProfitAccount?->budget_year) }}"
                                       id="budget_year"
                                       step="0.01"
                                       min="0"
                                       max="9999999999.99"
                                       placeholder="Budget annuale">
                                <label for="budget_year">{{ __('Budget Annuale') }}</label>
                            </div>
                            {!! $errors->first('budget_year', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                    </div>

                    {{-- Budget Mensile --}}
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text">€</span>
                            <div class="form-floating">
                                <input type="number"
                                       name="budget_month"
                                       class="form-control @error('budget_month') is-invalid @enderror"
                                       value="{{ old('budget_month', $carProfitAccount?->budget_month) }}"
                                       id="budget_month"
                                       step="0.01"
                                       min="0"
                                       max="99999999.99"
                                       placeholder="Budget mensile">
                                <label for="budget_month">{{ __('Budget Mensile') }}</label>
                            </div>
                            {!! $errors->first('budget_month', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                        <small class="text-muted">Calcolato automaticamente se non specificato</small>
                    </div>

                    {{-- Info Budget --}}
                    <div class="col-md-4">
                        <div class="alert alert-info mb-3">
                            <i class="bi bi-info-circle"></i>
                            <strong>Budget mensile indicativo:</strong>
                            <span id="monthly-budget-info">€ 0,00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Validità e Stato --}}
        <div class="card mb-3">
            <div class="card-header bg-warning">
                <i class="bi bi-calendar-check"></i> Validità e Stato
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- Stato Attivo --}}
                    <div class="col-md-3">
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="is_active"
                                   id="is_active"
                                   value="1"
                                   {{ old('is_active', $carProfitAccount?->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                <strong>Centro di Costo Attivo</strong>
                            </label>
                        </div>
                    </div>

                    {{-- Data Inizio Validità --}}
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="date"
                                   name="valid_from"
                                   class="form-control @error('valid_from') is-invalid @enderror"
                                   value="{{ old('valid_from', $carProfitAccount?->valid_from?->format('Y-m-d')) }}"
                                   id="valid_from">
                            <label for="valid_from">{{ __('Valido Dal') }}</label>
                            {!! $errors->first('valid_from', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                    </div>

                    {{-- Data Fine Validità --}}
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="date"
                                   name="valid_to"
                                   class="form-control @error('valid_to') is-invalid @enderror"
                                   value="{{ old('valid_to', $carProfitAccount?->valid_to?->format('Y-m-d')) }}"
                                   id="valid_to">
                            <label for="valid_to">{{ __('Valido Fino Al') }}</label>
                            {!! $errors->first('valid_to', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                    </div>

                    {{-- Alert Scadenza --}}
                    <div class="col-md-3">
                        <div id="expiry-alert" class="alert d-none" role="alert">
                            <i class="bi bi-exclamation-triangle"></i>
                            <span id="expiry-message"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Note --}}
        <div class="card mb-3">
            <div class="card-header">
                <i class="bi bi-file-text"></i> Note
            </div>
            <div class="card-body">
                <div class="form-floating">
                    <textarea name="notes"
                              class="form-control @error('notes') is-invalid @enderror"
                              id="notes"
                              style="height: 100px"
                              placeholder="Note">{{ old('notes', $carProfitAccount?->notes) }}</textarea>
                    <label for="notes">{{ __('Note aggiuntive') }}</label>
                    {!! $errors->first('notes', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
        </div>

        {{-- Info Veicoli Associati (solo in edit) --}}
        @if(isset($carProfitAccount) && $carProfitAccount->exists && $carProfitAccount->cars_count > 0)
            <div class="card mb-3 border-info">
                <div class="card-header bg-info text-white">
                    <i class="bi bi-truck"></i> Veicoli Associati
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i>
                        Questo centro di costo ha <strong>{{ $carProfitAccount->cars_count }} veicoli</strong> associati.
                        @if($carProfitAccount->active_cars_count > 0)
                            ({{ $carProfitAccount->active_cars_count }} attivi)
                        @endif
                    </div>
                    <p class="mb-0">
                        <a href="{{ route('car-profit-accounts.show', $carProfitAccount->id) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i> Visualizza veicoli associati
                        </a>
                    </p>
                </div>
            </div>
        @endif

    </div>
    <div class="col-md-12 mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> {{ __('Salva Centro di Costo') }}
        </button>
        <a href="{{ route('car-profit-accounts.index') }}" class="btn btn-secondary">
            <i class="bi bi-x-circle"></i> {{ __('Annulla') }}
        </a>
    </div>
</div>

{{-- Script per funzionalità dinamiche --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Uppercase automatico per codice
    const codeInput = document.getElementById('code');
    codeInput.addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });

    // Calcolo budget mensile
    const budgetYear = document.getElementById('budget_year');
    const budgetMonth = document.getElementById('budget_month');
    const monthlyInfo = document.getElementById('monthly-budget-info');

    function calculateMonthlyBudget() {
        const yearValue = parseFloat(budgetYear.value) || 0;
        const monthlyCalc = yearValue / 12;
        monthlyInfo.textContent = '€ ' + monthlyCalc.toLocaleString('it-IT', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

        // Se il campo mensile è vuoto, suggerisci il valore calcolato
        if (!budgetMonth.value && yearValue > 0) {
            budgetMonth.placeholder = monthlyCalc.toFixed(2);
        }
    }

    budgetYear.addEventListener('input', calculateMonthlyBudget);
    calculateMonthlyBudget(); // Init

    // Controllo scadenza
    const validTo = document.getElementById('valid_to');
    const expiryAlert = document.getElementById('expiry-alert');
    const expiryMessage = document.getElementById('expiry-message');

    function checkExpiry() {
        if (!validTo.value) {
            expiryAlert.classList.add('d-none');
            return;
        }

        const expiryDate = new Date(validTo.value);
        const today = new Date();
        const diffTime = expiryDate - today;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        if (diffDays < 0) {
            expiryAlert.className = 'alert alert-danger';
            expiryMessage.textContent = 'Centro di costo scaduto!';
        } else if (diffDays <= 30) {
            expiryAlert.className = 'alert alert-warning';
            expiryMessage.textContent = `Scade tra ${diffDays} giorni`;
        } else if (diffDays <= 90) {
            expiryAlert.className = 'alert alert-info';
            expiryMessage.textContent = `Scade tra ${diffDays} giorni`;
        } else {
            expiryAlert.classList.add('d-none');
            return;
        }

        expiryAlert.classList.remove('d-none');
    }

    validTo.addEventListener('change', checkExpiry);
    checkExpiry(); // Init

    // Validazione contatti
    const responsible = document.getElementById('responsible');
    const email = document.getElementById('email');
    const phone = document.getElementById('phone');

    responsible.addEventListener('blur', function() {
        if (this.value && !email.value && !phone.value) {
            email.classList.add('border-warning');
            phone.classList.add('border-warning');
        } else {
            email.classList.remove('border-warning');
            phone.classList.remove('border-warning');
        }
    });
});
</script>
@endpush
