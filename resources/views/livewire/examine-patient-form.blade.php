<div>
    <div class="form-group">
        <label for="exampleInputEmail1">Rekomendasi obat</label>
        <div>
            <div style="
                overflow-y: scroll; 
                width:fit-content; 
                height: 200px; 
                border:1px solid black; 
                padding:8px;">
                @foreach ($obats as $obat)
                <div style="
                    display: flex; 
                    flex-direction: row;
                    justify-content: space-between;
                    gap: 10px;
                ">
                    <p>{{$obat->nama_obat}}</p>
                    <button
                        type="button"
                        wire:click="addObat( {{$obat->id}} )"
                        style="
                            width: 24px;
                            height: 24px; 
                            display: flex;
                            justify-content: center;
                            align-items: center;
                        ">+
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div
        style="
            width:100%;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            gap: 8px 4px;
        ">
        @foreach ($selectedObats as $selectedObat)
            <div style="
                background-color: gray;
                display: flex;
                justify-items:space-between;
                align-content:center;
                gap: 24px;
                padding: 4px 8px;
            "> 
                <span>{{ $selectedObat->nama_obat }}</span>
                <button
                        type="button"
                        wire:click="deleteObat( {{$selectedObat->id}} )"
                        style="
                            width: 24px;
                            height: 24px; 
                            display: flex;
                            justify-content: center;
                            align-items: center;
                        ">x
                </button>
            </div>
            <input type="hidden" name="obats[]" value="{{$selectedObat->id}}">
        @endforeach
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Harga</label>
        <input type="number" name="biaya_periksa" wire:model="fee" class="form-control" id="exampleInputEmail1"
            placeholder="Masukkan biaya periksa" required readonly />
    </div>
</div>