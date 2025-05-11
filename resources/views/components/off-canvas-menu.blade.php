@props(['id' => 'offcanvasExample', 'label' => 'Offcanvas'])
<div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="{{$id}}" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">{{$label}}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="dropdown mt-3">
                <ul class="nav flex-column">
                    <x-menu-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-menu-link>
                    <x-menu-link :href="route('users.index')" :active="request()->routeIs('dashboard')">
                        {{ __('Utenti') }}
                    </x-menu-link>
                    <x-menu-link :href="route('cars.index')" :active="request()->routeIs('dashboard')">
                        {{ __('Vetture') }}
                    </x-menu-link>
                    <x-menu-link :href="route('car-plates.index')" :active="request()->routeIs('car-plates.index')">
                        {{ __('Targhe Vetture') }}
                    </x-menu-link>
                    <x-menu-link :href="route('car-types.index')" :active="request()->routeIs('car-types.index')">
                        {{ __('Tipo Vettura') }}
                    </x-menu-link>
                    <x-menu-link :href="route('car-owners.index')" :active="request()->routeIs('dashboard')">
                        {{ __('Proprietari') }}
                    </x-menu-link>
                    <x-menu-link :href="route('car-brands.index')" :active="request()->routeIs('dashboard')">
                        {{ __('Marca') }}
                    </x-menu-link>
                    <x-menu-link :href="route('car-powers.index')" :active="request()->routeIs('dashboard')">
                        {{ __('Alimentazioni') }}
                    </x-menu-link>
                    <x-menu-link :href="route('car-assignees.index')" :active="request()->routeIs('dashboard')">
                        {{ __('Uffici') }}
                    </x-menu-link>
                    <x-menu-link :href="route('assignee-offices.index')" :active="request()->routeIs('dashboard')">
                        {{ __('Sezioni') }}
                    </x-menu-link>
                    <x-menu-link :href="route('car-equipments.index')" :active="request()->routeIs('dashboard')">
                        {{ __('Dotazioni') }}
                    </x-menu-link>
                    <x-menu-link :href="route('car-setups.index')" :active="request()->routeIs('dashboard')">
                        {{ __('Allestimenti') }}
                    </x-menu-link>
                    <x-menu-link :href="route('movements.index')" :active="request()->routeIs('dashboard')">
                        {{ __('Movimenti') }}
                    </x-menu-link>
                    <x-menu-link :href="route('car-fuels.index')" :active="request()->routeIs('dashboard')">
                        {{ __('Rifornimenti') }}
                    </x-menu-link>
                    <x-menu-link :href="route('maintenance-garages.index')" :active="request()->routeIs('dashboard')">
                        {{ __('Officine') }}
                    </x-menu-link>
                    <x-menu-link :href="route('maintenance-types.index')" :active="request()->routeIs('dashboard')">
                        {{ __('Tipi di intervento') }}
                    </x-menu-link>
                    <x-menu-link :href="route('cigs.index')" :active="request()->routeIs('dashboard')">
                        {{ __('CIG') }}
                    </x-menu-link>
                </ul>
            </div>
        </div>
    </div>
</div>
