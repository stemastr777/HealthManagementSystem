<div>
    <label for="doctor">Pilih dokter</label>
    <select wire:model.change="selectedDoctor" id="doctor" class="form-control">
        <option value="">-- Select Doctor --</option>
        @foreach ($dokters as $dokter)
        <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
        @endforeach
    </select>

    <label for="id_jadwal">Pilih jadwal periksa</label>
    <select wire:model.change="selectedJadwalPeriksa" id="id_jadwal" name="id_jadwal" class="form-control">
        <option value="">-- Select jadwal_periksa --</option>
        @foreach ($jadwal_periksas as $jadwal_periksa)
        <option value="{{ $jadwal_periksa->id }}">{{ $jadwal_periksa->hari }} at {{ $jadwal_periksa->jam_mulai }} - {{ $jadwal_periksa->jam_selesai }}</option>
        @endforeach
    </select>
    <label for="jadwal_periksa">Tanggal periksa</label>
    <input class="form-control" type="hidden" name="tgl_periksa" id="tgl_periksa" value="{{ $tgl_periksa }}" />
    <input class="form-control" type="date" name="tgl_periksa" id="tgl_periksa" value="{{ $tgl_periksa }}" disabled />
</div>