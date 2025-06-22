<?php

namespace App\Livewire;

use App\Models\Obat;
use Livewire\Component;

class ExaminePatientForm extends Component
{
    const INITIAL_FEE = 100000;

    public $obats;
    public $selectedObats = [];
    public $fee = ExaminePatientForm::INITIAL_FEE;

    public function render()
    {
        return view('livewire.examine-patient-form');
    }

    public function mount($obats, $selectedDetailPeriksas) {
        $this->obats = $obats;

        foreach ($selectedDetailPeriksas as $detailPeriksa) {
            $this->selectedObats = [...$this->selectedObats, $detailPeriksa->obat];
        }
    }

    public function addObat($id_obat) {
        $new_obat = Obat::where('id', $id_obat)->first();
        $this->selectedObats = [...$this->selectedObats, $new_obat];
        $this->fee += Obat::where('id', $id_obat)->pluck('harga')->first();
    }

    public function deleteObat($id_obat) {

        $this->selectedObats = array_values(
            array_filter($this->selectedObats, fn($obat) => $obat->id !== $id_obat)
        );
        
        $this->fee -= Obat::where('id', $id_obat)->pluck('harga')->first();
    }
}
