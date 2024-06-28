<div>
    <div class="col-12">
        <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Position List</h5>
                    <button wire:click="new" type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#PositionModel"><i class="bi bi-plus"> Add Position </i></button>
                </div>
            <div class="card-body">
                <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">*****</th>
        </tr>
        </thead>
        <tbody>
        @forelse($positions  as $position)
            <tr class="align-middle">
                <th>{{$loop->iteration}}</th>
                <td style="width: 300px">{{\Illuminate\Support\Str::limit($position->title,30)}}</td>
                <td style="width: 300px">{{\Illuminate\Support\Str::limit($position->category->title,30)}}</td>

                <td style="width: 150px">
                    <a wire:click.prevent="EditData({{$position->id}})" class="btn btn-outline-secondary"  data-bs-toggle="modal" data-bs-target="#PositionModel" href="#"><i class="bi bi-pencil-fill text-primary"></i></a>
                    <a wire:click.prevent="DeleteData({{$position->id}})" class="btn btn-outline-secondary" href="#"><i class="bi bi-trash-fill text-danger"></i></a>

                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-danger text-center"><h5>Not found data </h5></td></tr>

        @endforelse

        </tbody>
    </table>
                <div class="pagination justify-content-center">
         {{ $positions->links() }}

                </div>
            </div>
        </div>
    </div>

    {{--PositionModel--}}
    <div  wire:ignore.self class="modal fade" id="PositionModel" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PositionModel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <label for="select" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10 " id="select">

                                <select wire:model="select"  class="form-select" >
                                    <option >Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>

                                <span>@error('select') <p class="text-danger">{{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="title" class="col-sm-2 col-form-label" >Title</label>
                            <div class="col-sm-10">
                                <input wire:model="title" type="text" class="form-control" id="title">
                                <span>@error('title') <p class="text-danger">{{$message}} @enderror</span>
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
        @this.on('close-mod',(event)=>{
            var myModalEl=document.querySelector('#PositionModel')
            var modal=bootstrap.Modal.getOrCreateInstance(myModalEl)

            setTimeout(() => {
                modal.hide();
            @this.dispatch('reset-modal');
            }, 1000);
        })

        var mymodal=document.getElementById('PositionModel')
        mymodal.addEventListener('hidden.bs.modal',(event)=>{
        @this.dispatch('reset-modal');
        })
    })
</script>
