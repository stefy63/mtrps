@php($button = $button ?? true)
<div class="row">
    <div class="col-md-12">
        <!-- Dati Principali -->
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni Officina</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="form-floating col-12">
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $maintenanceGarage->name ?? '') }}"
                                   placeholder="Es: Officina Autorizzata Fiat"
                                   required>
                            <label for="name">{{ __('Nome Officina') }} <span class="text-danger">*</span></label>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Nome Officina -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating col-12">
                            <input type="text" name="address" id="address"
                                   class="form-control @error('address') is-invalid @enderror"
                                   value="{{ old('address', $maintenanceGarage->address ?? '') }}"
                                   placeholder="Indirizzo...">
                            <label for="address">{{ __('Indirizzo Officina') }}</label>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Descrizione -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <input type="text" name="description" id="description"
                                   class="form-control @error('description') is-invalid @enderror"
                                   value="{{ old('description', $maintenanceGarage->description ?? '') }}"
                                   placeholder="Es: Specializzata in veicoli commerciali">
                            <label for="description">{{ __('Descrizione (opzionale)') }}</label>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dati Fiscali -->
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-receipt"></i> Dati Fiscali</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- P.IVA -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="piva" id="piva"
                                   class="form-control @error('piva') is-invalid @enderror"
                                   value="{{ old('piva', $maintenanceGarage->piva ?? '') }}"
                                   placeholder="12345678901"
                                   maxlength="11">
                            <label for="piva">{{ __('Partita IVA') }}</label>
                            @error('piva')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="piva-validation" class="mt-1"></div>
                    </div>

                    <!-- Codice Fiscale -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="cf" id="cf"
                                   class="form-control @error('cf') is-invalid @enderror"
                                   value="{{ old('cf', $maintenanceGarage->cf ?? '') }}"
                                   placeholder="RSSMRA85M01H501Z"
                                   maxlength="16"
                                   style="text-transform: uppercase;">
                            <label for="cf">{{ __('Codice Fiscale') }}</label>
                            @error('cf')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- IBAN -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <input type="text" name="iban" id="iban"
                                   class="form-control @error('iban') is-invalid @enderror"
                                   value="{{ old('iban', $maintenanceGarage->iban ?? '') }}"
                                   placeholder="IT60X0542811101000000123456"
                                   maxlength="27"
                                   style="text-transform: uppercase;">
                            <label for="iban">{{ __('IBAN') }}</label>
                            @error('iban')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="text-muted">Formato: IT + 2 cifre + 1 lettera + 22 cifre</small>
                    </div>

                    <!-- PEC -->
                    <div class="col-md-6 mb-3">
                        <div class="form-floating ">
                            <input type="email" name="pec" id="pec"
                                   class="form-control @error('pec') is-invalid @enderror"
                                   value="{{ old('pec', $maintenanceGarage->pec ?? '') }}"
                                   placeholder="officina@pec.it">
                            <label for="pec">{{ __('PEC (Posta Elettronica Certificata)') }}</label>
                            @error('pec')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-floating ">
                            <input type="email" name="mail" id="mail"
                                   class="form-control @error('mail') is-invalid @enderror"
                                   value="{{ old('mail', $maintenanceGarage->mail ?? '') }}"
                                   placeholder="officina@mail.it">
                            <label for="mail">{{ __('MAIL (Posta Elettronica)') }}</label>
                            @error('mail')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <!-- TELEFONI -->
                    <div class="col-md-4 mb-3">
                        <div class="form-floating ">
                            <input type="tel" name="phone1" id="phone1"
                                   class="form-control @error('phone1') is-invalid @enderror"
                                   value="{{ old('phone1', $maintenanceGarage->phone1 ?? '') }}"
                                   placeholder="+39 011455487">
                            <label for="phone1">{{ __('Telefono Ufficio') }}</label>
                            @error('phone1')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-floating ">
                            <input type="tel" name="phone2" id="phone2"
                                   class="form-control @error('phone2') is-invalid @enderror"
                                   value="{{ old('phone2', $maintenanceGarage->phone2 ?? '') }}"
                                   placeholder="+39 011455487">
                            <label for="phone2">{{ __('Telefono Fax') }}</label>
                            @error('phone1')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-floating ">
                            <input type="tel" name="phone3" id="phone3"
                                   class="form-control @error('phone3') is-invalid @enderror"
                                   value="{{ old('phone3', $maintenanceGarage->phone3 ?? '') }}"
                                   placeholder="+39 333 1232321">
                            <label for="phone3">{{ __('Telefono Responsabile') }}</label>
                            @error('phone3')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                </div>

        </div>
    </div>

    <!-- Certificazioni -->
    <div class="card">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="bi bi-shield-check"></i> Certificazioni e Documenti</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Accreditamento -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Accreditamento') }} <span class="text-danger">*</span></label>
                    <div class="btn-group w-100" role="group">
                        <input type="radio" class="btn-check" name="acc" id="acc_yes" value="yes"
                               {{ old('acc', $maintenanceGarage->acc ?? 'no') == 'yes' ? 'checked' : '' }} required>
                        <label class="btn btn-outline-success" for="acc_yes">
                            <i class="bi bi-check-circle"></i> Sì
                        </label>

                        <input type="radio" class="btn-check" name="acc" id="acc_no" value="no"
                               {{ old('acc', $maintenanceGarage->acc ?? 'no') == 'no' ? 'checked' : '' }} required>
                        <label class="btn btn-outline-secondary" for="acc_no">
                            <i class="bi bi-x-circle"></i> No
                        </label>
                    </div>
                    @error('acc')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Certificazione Antimafia -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Certificazione Antimafia') }} <span
                                class="text-danger">*</span></label>
                    <div class="btn-group w-100" role="group">
                        <input type="radio" class="btn-check" name="anti_mafia" id="anti_mafia_yes" value="yes"
                               {{ old('anti_mafia', $maintenanceGarage->anti_mafia ?? 'no') == 'yes' ? 'checked' : '' }} required>
                        <label class="btn btn-outline-success" for="anti_mafia_yes">
                            <i class="bi bi-shield-check"></i> Sì
                        </label>

                        <input type="radio" class="btn-check" name="anti_mafia" id="anti_mafia_no" value="no"
                               {{ old('anti_mafia', $maintenanceGarage->anti_mafia ?? 'no') == 'no' ? 'checked' : '' }} required>
                        <label class="btn btn-outline-secondary" for="anti_mafia_no">
                            <i class="bi bi-shield-x"></i> No
                        </label>
                    </div>
                    @error('anti_mafia')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- DURC -->
                <div class="col-md-4 mb-3">
                    <div class="form-floating">
                        <input type="date" name="durc" id="durc"
                               class="form-control @error('durc') is-invalid @enderror"
                               value="{{ old('durc', isset($maintenanceGarage) && $maintenanceGarage->durc ? $maintenanceGarage->durc : '') }}">
                        <label for="durc">{{ __('Scadenza DURC') }}</label>
                        @error('durc')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div id="durc-alert" class="mt-1"></div>
                </div>
            </div>

            <!-- Note -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-floating">
                            <textarea name="note" id="note"
                                      class="form-control @error('note') is-invalid @enderror"
                                      style="height: 100px"
                                      placeholder="Note aggiuntive...">{{ old('note', $maintenanceGarage->note ?? '') }}</textarea>
                        <label for="note">{{ __('Note (opzionale)') }}</label>
                        @error('note')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if($button)
    <div class="row mt-3">
        <div class="col-12">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> {{ __('Salva Officina') }}
            </button>
            <a href="{{ route('maintenance-garages.index') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> {{ __('Annulla') }}
            </a>
        </div>
    </div>
    @endif
    </div>
