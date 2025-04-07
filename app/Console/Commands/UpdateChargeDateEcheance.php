<?php

namespace App\Console\Commands;

use App\Models\Charges;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateChargeDateEcheance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-charge-date-echeance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mettre la date echance de la charge a jour';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $charges = Charges::all(); // Récupère toutes les charges, tu peux ajuster la condition
        foreach ($charges as $charge) {
            // Supposons que tu as un champ 'periodicite' en mois et une 'date_echeance'
            $dateEcheance = Carbon::parse($charge->date_echeance);
            if ($dateEcheance->lessThanOrEqualTo(Carbon::now())) {
                preg_match('/\d+/', $charge->periodicite,$matches);
                $nombre_mois = (int) $matches[0] ?? 0;
                if($nombre_mois > 0){
                    $nouvelleDateEcheance = $dateEcheance->addMonths($nombre_mois); // Exemple avec une périodicité en mois
                    $charge->update(['date_echeance' => $nouvelleDateEcheance]);
                    $this->info('Echéance mise à jour pour la charge ' . $charge->id);
                }
                // $nouvelleDateEcheance = $dateEcheance->addMonths($dateDebut->diffInMonths($dateFin)); // Exemple avec une périodicité en mois
            }
        }
        return 0;
    }
}
