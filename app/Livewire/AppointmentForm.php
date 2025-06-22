<?php

namespace App\Livewire;

use App\Models\JadwalPeriksa;
use Carbon\Carbon;
use Livewire\Component;

class AppointmentForm extends Component
{

    public $dokters;

    public $selectedDoctor;
    public $selectedJadwalPeriksa;
    public $jadwal_periksas = [];

    public $tgl_periksa = 'Pilih jadwal dulu';

    public function render()
    {
        return view('livewire.appointment-form');
    }

    public function mount($dokters)
    {
        $this->dokters = $dokters;
    }

    public function updatedSelectedDoctor($doctorId)
    {
        $this->jadwal_periksas = JadwalPeriksa::where('id_dokter', $doctorId)->get();
    }

    public function updatedSelectedJadwalPeriksa($id_jadwal) {

        $hariMap = [
            'Minggu' => Carbon::SUNDAY,
            'Senin' => Carbon::MONDAY,
            'Selasa' => Carbon::TUESDAY,
            'Rabu' => Carbon::WEDNESDAY,
            'Kamis' => Carbon::THURSDAY,
            'Jumat' => Carbon::FRIDAY,
            'Sabtu' => Carbon::SATURDAY,
        ];

        $target_hari = JadwalPeriksa::where('id', $id_jadwal)->value('hari');

        $this->tgl_periksa = Carbon::now()->next($hariMap[$target_hari])->format('Y-m-d');
    }

    
}
