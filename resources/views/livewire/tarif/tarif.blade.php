<div>


    <div class="card recent-sales overflow-auto">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Tariflər </h5>
            <button wire:click="new"   type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#TarifModel"><i class="bi bi-plus"> Yeni  Tarif </i></button>
        </div>

        <div class="card-body">
            <!-- Table with stripped rows -->
            <table class="table datatable table-hover">
                <thead>
                <tr>
                    <th>Kod</th>
                    <th>Ad</th>
                    <th>Məbləğ(m)</th>
                    <th>Məbləğ(q)</th>
                    <th> Texnologiya</th>
                    <th>Category </th>
                    <th>Status</th>
                    <th>*****</th>
                </tr>
                </thead>
                <tbody >
                @forelse($data as $dataItem)
                    <tr>
                        <td class="align-middle">{{\Illuminate\Support\Str::limit($dataItem->kod,15)}}</td>
                        <td class="align-middle">{{\Illuminate\Support\Str::limit($dataItem->name,30)}}</td>
                        <td class="align-middle">{{\Illuminate\Support\Str::limit($dataItem->mebleg,25)}}</td>
                        <td class="align-middle">{{\Illuminate\Support\Str::limit($dataItem->mebleg_q,15)}}</td>
                        <td class="align-middle">{{\Illuminate\Support\Str::limit($dataItem->category,15)}}</td>
                        <td class="align-middle">{{\Illuminate\Support\Str::limit($dataItem->novu,15)}}</td>
                        <td class="align-middle">
                            <div class=" form-switch">
                                <input wire:click="changeStatus({{$dataItem->id}})" class="form-check-input align-middle" type="checkbox" id="flexSwitchCheckChecked" {{$dataItem->status==0 ? 'checked' : ''}}>
                            </div>
                        </td>
                        <td>
                            <a wire:click.prevent="EditData({{$dataItem->id}})" class="btn btn-outline-secondary"  data-bs-toggle="modal" data-bs-target="#TarifModel" href="#"><i class="bi bi-pencil-fill text-primary"></i></a>
                            <a wire:click.prevent="DeleteData({{$dataItem->id}})" class="btn btn-outline-secondary" href="#"><i class="bi bi-trash-fill text-danger"></i></a>

                        </td>


                    </tr>
                @empty
                    <tr><td colspan="7" class="text-danger text-center"><h5>Not found data </h5></td></tr>

                @endforelse


                </tbody>
            </table>
            {{--                <div class="pagination justify-content-center">
                                {{ $data->links() }}
                            </div>--}}
            <!-- End Table with stripped rows -->
        </div>

    </div>



    <div  wire:ignore.self class="modal fade" id="TarifModel" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PositionModel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <label for="kod" class="col-sm-2 col-form-label" >Kod</label>
                            <div class="col-sm-10">
                                <input wire:model="kod" type="text" class="form-control" id="kod">
                                <span>@error('kod') <p class="text-danger">{{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label" >Ad</label>
                            <div class="col-sm-10">
                                <input wire:model="name" type="text" class="form-control" id="name">
                                <span>@error('name') <p class="text-danger">{{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="mebleg" class="col-sm-2 col-form-label" >Mebleğ(m)</label>
                            <div class="col-sm-10">
                                <input wire:model="mebleg" type="text" class="form-control" id="mebleg">
                                <span>@error('mebleg') <p class="text-danger">{{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="mebleg_q" class="col-sm-2 col-form-label" >Mebleğ(q)</label>
                            <div class="col-sm-10">
                                <input wire:model="mebleg_q" type="text" class="form-control" id="mebleg_q">
                                <span>@error('mebleg_q') <p class="text-danger">{{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="category" class="col-sm-2 col-form-label" >Texnologiya</label>
                            <div class="col-sm-10">
                            <select wire:model="category"  class="form-select" id="category" >
                                <option >Seçin</option>
                                        <option value="Adsl">Adsl</option>
                                        <option value="Gpon Kampaniya">Gpon Kampaniya</option>
                                        <option value="Gpon">Gpon</option>
                                        <option value="Ip Tv">İP TV</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="novu" class="col-sm-2 col-form-label"  >Kateqoriya</label>
                            <div class="col-sm-10">
                            <select wire:model="novu"  class="form-select"  id="novu">
                                <option >Seçin</option>
                                        <option value="Mənzil">Əhali</option>
                                        <option value="Qeyri Əhali">Qeyri Əhali</option>
                                        <option value="Hamısı">Hamısı</option>
                                </select>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    @if($editMode == true)
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button wire:click="UpdateData" type="button" class="btn btn-primary">Update</button>
                    @else
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button wire:click="SaveData" type="button" class="btn btn-primary">Save</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('livewire:initialized',()=>{
        @this.on('close-modal',(event)=>{
            var myModalEl=document.querySelector('#TarifModel')
            var modal=bootstrap.Modal.getOrCreateInstance(myModalEl)

            setTimeout(() => {
                modal.hide();
            @this.dispatch('reset-modal');
            }, 1000);
        })

        var mymodal=document.getElementById('TarifModel')
        mymodal.addEventListener('hidden.bs.modal',(event)=>{
        @this.dispatch('reset-modal');
        })
    })
</script>
