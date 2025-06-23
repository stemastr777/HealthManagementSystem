<div>
    <label for="poli">Pilih poli</label>
    <select wire:model.change="selectedPoli" id="poli" class="form-control">
        <option value="">-- Select Poli --</option>
        @foreach ($polis as $poli)
        <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
        @endforeach
    </select>
    <label for="jadwal_periksa">Pilih jadwal periksa</label>
    <select wire:model.change="selectedJadwalPeriksa" id="jadwal_periksa" name="jadwal_periksa" class="form-control" <?php echo empty($selectedPoli) ? 'readonly' : '' ?>>
        <option value="">-- Select Jadwal Periksa --</option>
        @foreach ($availableJadwalPeriksas as $jadwal_periksa)
        <option value="{{ $jadwal_periksa->hari . ' ' . $jadwal_periksa->jam_mulai . ' ' . $jadwal_periksa->jam_selesai }}">{{ $jadwal_periksa->hari }} at {{ $jadwal_periksa->jam_mulai }} - {{ $jadwal_periksa->jam_selesai }}</option>
        @endforeach
    </select>
    <label for="id_dokter">Pilih dokter</label>
    <select id="doctor" name="id_dokter" class="form-control" 
        <?php echo empty($selectedJadwalPeriksa) ? 'readonly' : '' ?>
    >
        <option value="">-- Select Doctor --</option>
        @foreach ($availableDoctor as $dokter)
        <option value="{{ $dokter->user_id }}">{{ $dokter->user->nama }}</option>
        @endforeach
    </select>
    <label for="jadwal_periksa">Tanggal periksa</label>
    <input class="form-control" type="hidden" name="tgl_periksa" id="tgl_periksa" value="{{ $tgl_periksa }}" />
    <input class="form-control" type="date" name="tgl_periksa" id="tgl_periksa" value="{{ $tgl_periksa }}" disabled />
</div>