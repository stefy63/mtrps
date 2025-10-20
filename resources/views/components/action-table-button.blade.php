@props(['item' => '', 'itemRoute' => '', 'label' => ''])

@php
    $itemRoute = $itemRoute ?: mb_strtolower(class_basename($item)).'s';
    $id = $item->id;
@endphp
<div>
    <a data-bs-toggle="tooltip" title="Visualizza dati {{$label}}" class="ms-2"
       href="{{ route($itemRoute.'.show', $item->id) }}"><i
                class="bi bi-search"></i></a>
    <a data-bs-toggle="tooltip" title="Modifica  {{$label}}" class="ms-2"
       href="{{ route($itemRoute.'.edit', $item->id) }}"><i
                class="bi bi-pencil-square text-success"></i></a>
    <a data-bs-toggle="tooltip" title="Cancella  {{$label}}" class="ms-2" data-confirm-delete="true"
       href="{{ route($itemRoute.'.destroy', $item->id) }}"><i
                class="bi bi-trash text-danger"></i></a>
</div>