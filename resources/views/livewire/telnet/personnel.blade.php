<div>
    <!-- Personnel list -->
    <div class="col-12">







        <div class="card recent-sales overflow-auto">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Personnels  List</h5>
                <button wire:click="new"   type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#PersonnelModel"><i class="bi bi-plus"> Add Personnel </i></button>
            </div>

            <div class="card-body">
                <!-- Table with stripped rows -->
                <table class="table datatable table-hover">
                    <thead>
                    <tr>
                         <th>Login</th>
                        <th>Password</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Category </th>
                        <th>Status</th>
                        <th>*****</th>
                    </tr>
                    </thead>
                    <tbody >
                    @forelse($personnels as $personnel)
                    <tr>
                        <td class="align-middle">{{\Illuminate\Support\Str::limit($personnel->login,15)}}</td>
                        <td class="align-middle">{{\Illuminate\Support\Str::limit($personnel->password,15)}}</td>
                        <td class="align-middle">{{\Illuminate\Support\Str::limit($personnel->name,25)}}</td>
                        <td class="align-middle">{{\Illuminate\Support\Str::limit($personnel->position->title,15)}}</td>
                        <td class="align-middle">{{\Illuminate\Support\Str::limit($personnel->category->title,15)}}</td>
                        <td class="align-middle">
                            <div class=" form-switch">
                                <input wire:click="changeStatus({{$personnel->id}})" class="form-check-input align-middle" type="checkbox" id="flexSwitchCheckChecked" {{$personnel->status==1 ? 'checked' : ''}}>
                            </div>
                        </td>
                        <td>
                            <a wire:click.prevent="EditData({{$personnel->id}})" class="btn btn-outline-secondary"  data-bs-toggle="modal" data-bs-target="#PersonnelModel" href="#"><i class="bi bi-pencil-fill text-primary"></i></a>
                            <a wire:click.prevent="DeleteData({{$personnel->id}})" class="btn btn-outline-secondary" href="#"><i class="bi bi-trash-fill text-danger"></i></a>

                        </td>


                    </tr>
                    @empty
                        <tr><td colspan="7" class="text-danger text-center"><h5>Not found data </h5></td></tr>

                    @endforelse


                    </tbody>
                </table>
{{--                <div class="pagination justify-content-center">
                    {{ $personnels->links() }}
                </div>--}}
                <!-- End Table with stripped rows -->
            </div>

        </div>
    </div>
    <!-- End personnel list  -->

    <div  wire:ignore.self class="modal fade" id="PersonnelModel" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PositionModel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10 " id="category_id">
                                <select wire:model="category_id"  class="form-select" >
                                    <option >Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                <span>@error('category_id') <p class="text-danger">{{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="position_id" class="col-sm-2 col-form-label">Position</label>
                            <div class="col-sm-10 " id="position_id">
                                <select wire:model="position_id"  class="form-select" >
                                    <option >Select Position</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->title }}</option>
                                    @endforeach
                                </select>
                                <span>@error('position_id') <p class="text-danger">{{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="login" class="col-sm-2 col-form-label" >Login</label>
                            <div class="col-sm-10">
                                <input wire:model="login" type="text" class="form-control" id="login">
                                <span>@error('login') <p class="text-danger">{{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-sm-2 col-form-label" >Password</label>
                            <div class="col-sm-10">
                                <input wire:model="password" type="text" class="form-control" id="password">
                                <span>@error('password') <p class="text-danger">{{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label" >Name</label>
                            <div class="col-sm-10">
                                <input wire:model="name" type="text" class="form-control" id="name">
                                <span>@error('name') <p class="text-danger">{{$message}} @enderror</span>
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
            var myModalEl=document.querySelector('#PersonnelModel')
            var modal=bootstrap.Modal.getOrCreateInstance(myModalEl)

            setTimeout(() => {
                modal.hide();
            @this.dispatch('reset-modal');
            }, 1000);
        })

        var mymodal=document.getElementById('PersonnelModel')
        mymodal.addEventListener('hidden.bs.modal',(event)=>{
        @this.dispatch('reset-modal');
        })
    })
</script>
