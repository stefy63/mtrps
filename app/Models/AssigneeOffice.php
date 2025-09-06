<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class AssigneeOffice
 *
 * @property $id
 * @property $car_assignee_id
 * @property $name
 * @property $description
 * @property $note
 * @property $created_at
 * @property $updated_at
 *
 * @property CarAssignee $carAssignee
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AssigneeOffice extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['car_assignee_id', 'name', 'description', 'note'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name', 'assignee_info'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carAssignee()
    {
        return $this->belongsTo(\App\Models\CarAssignee::class, 'car_assignee_id', 'id');
    }

    /**
     * Get the full name including assignee info
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        $assigneeName = $this->carAssignee ? $this->carAssignee->name : 'N/A';
        return "{$this->name} - {$assigneeName}";
    }

    /**
     * Get formatted assignee info
     *
     * @return string
     */
    public function getAssigneeInfoAttribute(): string
    {
        if (!$this->carAssignee) {
            return 'Nessun assegnatario';
        }

        $car = $this->carAssignee->car;
        if (!$car) {
            return $this->carAssignee->name;
        }

        $plate = $car->carPlates()
            ->whereNull('date_to')
            ->orWhere('date_to', '>=', now())
            ->orderBy('date_from', 'desc')
            ->first();

        $plateName = $plate ? $plate->name : 'Senza targa';

        return "{$this->carAssignee->name} ({$plateName})";
    }

    /**
     * Scope per uffici attivi (con assegnatario attivo)
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereHas('carAssignee', function ($q) {
            $q->where(function ($query) {
                $query->whereNull('date_to')
                      ->orWhere('date_to', '>=', now());
            });
        });
    }

    /**
     * Scope per ricerca
     *
     * @param Builder $query
     * @param string $search
     * @return Builder
     */
    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhereHas('carAssignee', function ($query) use ($search) {
                  $query->where('name', 'like', "%{$search}%");
              });
        });
    }

    /**
     * Scope per assegnatario
     *
     * @param Builder $query
     * @param int $assigneeId
     * @return Builder
     */
    public function scopeForAssignee(Builder $query, int $assigneeId): Builder
    {
        return $query->where('car_assignee_id', $assigneeId);
    }

    /**
     * Get uffici tipici per suggerimenti
     *
     * @return array
     */
    public static function getTypicalOffices(): array
    {
        return [
            // Ministeri
            'Ufficio di Gabinetto',
            'Segreteria Generale',
            'Segreteria Particolare',
            'Ufficio Legislativo',
            'Ufficio Stampa',
            'Direzione Generale del Personale',
            'Direzione Generale Bilancio',
            'Servizio Ispettivo',
            'Ufficio Relazioni con il Pubblico',

            // Forze dell'Ordine
            'Comando Provinciale',
            'Comando Regionale',
            'Questura',
            'Commissariato',
            'Compagnia',
            'Stazione',
            'Nucleo Operativo',
            'Nucleo Investigativo',
            'Squadra Mobile',
            'Squadra Volante',
            'Polizia Stradale',
            'Polizia Postale',
            'Reparto Mobile',
            'Nucleo Antisofisticazioni',
            'Nucleo Ecologico',

            // Comuni/Regioni
            'Ufficio del Sindaco',
            'Ufficio del Presidente',
            'Assessorato',
            'Direzione Generale',
            'Area Tecnica',
            'Area Amministrativa',
            'Area Finanziaria',
            'Settore Lavori Pubblici',
            'Settore Urbanistica',
            'Settore Ambiente',
            'Settore Servizi Sociali',
            'Settore Cultura',
            'Settore Sport',
            'Polizia Municipale',
            'Protezione Civile',

            // Altri Enti
            'Presidenza',
            'Direzione Centrale',
            'Direzione Territoriale',
            'Ufficio Legale',
            'Ufficio Tecnico',
            'Ufficio Acquisti',
            'Ufficio Patrimonio',
            'Servizio Prevenzione e Protezione',
            'Servizio Informatico',
            'Servizio Manutenzione',
        ];
    }

    /**
     * Verifica se l'ufficio è attualmente attivo
     *
     * @return bool
     */
    public function isActive(): bool
    {
        if (!$this->carAssignee) {
            return false;
        }

        return $this->carAssignee->date_to === null ||
               $this->carAssignee->date_to >= now();
    }
}
