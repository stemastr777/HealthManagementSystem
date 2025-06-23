<?php

namespace App\Livewire;

use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use Carbon\Carbon;
use Livewire\Component;

class AppointmentForm extends Component
{

    public $polis;
    public $selectedPoli;

    public $availableJadwalPeriksas = [];
    public $selectedJadwalPeriksa;
    
    public $availableDoctor = [];

    public $tgl_periksa = 'Pilih jadwal dulu';

    
    public function render()
    {
        return view('livewire.appointment-form');
    }

    public function mount($polis)
    {
        $this->polis = $polis;
    }

    public function updatedSelectedPoli($id_poli)
    {

        if (!empty($this->selectedJadwalPeriksa)) {
            $this->selectedJadwalPeriksa = null;
            $this->updatedSelectedJadwalPeriksa('');
        }

        $this->availableJadwalPeriksas = JadwalPeriksa::with('dokter')
                                    ->whereHas('dokter', function ($query) use ($id_poli) {
                                        $query->where('id_poli', $id_poli);
                                    })
                                    ->where('is_active', 'true')
                                    ->orderBy('hari', 'asc')
                                    ->orderBy('jam_mulai', 'asc')
                                    ->orderBy('jam_selesai', 'asc')
                                    ->get();
    }

    public function updatedSelectedJadwalPeriksa($jadwal_periksa) {

        if (empty($jadwal_periksa)) {
            $this->availableDoctor = [];
            return;
        }

        $hariMap = [
            'Minggu' => Carbon::SUNDAY,
            'Senin' => Carbon::MONDAY,
            'Selasa' => Carbon::TUESDAY,
            'Rabu' => Carbon::WEDNESDAY,
            'Kamis' => Carbon::THURSDAY,
            'Jumat' => Carbon::FRIDAY,
            'Sabtu' => Carbon::SATURDAY,
        ];

        $target_hari = explode(' ', $jadwal_periksa)[0];
        $target_jam_mulai = explode(' ', $jadwal_periksa)[1];
        $target_jam_selesai = explode(' ', $jadwal_periksa)[2];

        $this->tgl_periksa = Carbon::now()->next($hariMap[$target_hari])->format('Y-m-d');

        $this->availableDoctor = Dokter::with('jadwalPeriksas')
                                    ->whereHas( 'jadwalPeriksas', function ($query) use ($target_hari, $target_jam_selesai, $target_jam_mulai) {
                                        $query->where([
                                            'hari' => $target_hari,
                                            'jam_mulai' => $target_jam_mulai,
                                            'jam_selesai' => $target_jam_selesai,
                                            'is_active' => 'true'
                                        ]);
                                    })
                                    ->get();
    }


}
