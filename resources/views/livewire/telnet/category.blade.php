<div>
    <!-- Top Categoty  -->
    <div class="col-12">

            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Category List</h5>
                    <button type="button" wire:click="new" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CategoryModel"><i class="bi bi-plus"> Add Category </i></button>
                </div>

                <!-- Table with hoverable rows -->
              <div class="card-body">

                  <table class="table table-hover">
                      <thead>
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col" >Title</th>
                          <th scope="col"  >*****</th>
                      </tr>
                      </thead>
                      <tbody>
                      @forelse($data as $categoryItem)
                          <tr class="align-middle">
                              <th scope="row">{{$loop->iteration}}</th>
                              <td style="width: 600px"> {{\Illuminate\Support\Str::limit($categoryItem->title,40)}}</td>

                              <td>
                                  <a wire:click.prevent="EditCategory({{$categoryItem->id}})" class="btn btn-outline-secondary"  data-bs-toggle="modal" data-bs-target="#CategoryModel" href="#"><i class="bi bi-pencil-fill text-primary"></i></a>
                                  <a wire:click.prevent="DeleteCategory({{$categoryItem->id}})" class="btn btn-outline-secondary" href="#"><i class="bi bi-trash-fill text-danger"></i></a>

                              </td>
                          </tr>
                      @empty
                          <tr><td colspan="4" class="text-danger text-center"><h5>Not found data </h5></td></tr>
                      @endforelse
                      </tbody>
                  </table>
                  <div class="pagination justify-content-center">
                      {{ $data->links() }}
                    {{--  {{ $data->links('vendor.custom-pagination') }}--}}


                  </div>
              </div>
                <!-- End Table with hoverable rows -->
            </div>

    </div>
    <!-- End Top Categoty  -->




    {{--CategoryModel--}}
    <div wire:ignore.self class="modal fade" id="CategoryModel" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                </div>
                <div class="modal-body mt-1">
                    <form>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input wire:model="title" type="text" class="form-control" id="inputText">
                                <span>@error('title') <p class="text-danger">{{$message}} @enderror</span>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    @if($editMode == true)
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button wire:click="UpdateCategory" type="button" class="btn btn-primary">Update</button>
                    @else
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button wire:click="SaveCategory" type="button" class="btn btn-primary">Save</button>
                    @endif
                </div>
            </div>
        </div>
    </div>



</div>
<script>
    document.addEventListener('livewire:initialized',()=>{
        @this.on('close-category',(event)=>{
            //alert('product created/updated')
            var myModalEl=document.querySelector('#CategoryModel')
            var modal=bootstrap.Modal.getOrCreateInstance(myModalEl)

            setTimeout(() => {
                modal.hide();
            @this.dispatch('reset-modal');
            }, 1000);
        })

        var mymodal=document.getElementById('CategoryModel')
        mymodal.addEventListener('hidden.bs.modal',(event)=>{
        @this.dispatch('reset-modal');
        })
    })
</script>
