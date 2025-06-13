<div>
    <div class="row justify-content-center ">
    <div class="col-lg-12 col-md-10 col-sm-12">
        <div class="card  ">
            <div class="card-body">
                <div class="mt-3 mb-3 input-group">
                    <form wire:submit.prevent="save" class="input-group">
                        @if ($editMode == false)
                            <input
                                wire:model="newTodo"
                                type="text"
                                class="form-control"
                                placeholder="Yeni"
                                aria-label="Recipient's username"
                                aria-describedby="button-addon2"
                            />
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                                Göndər
                            </button>
                        @endif
                    </form>

                    @if ($editMode == true)
                        <div class="input-group mt-2">
                            <input
                                wire:model="newTodo"
                                type="text"
                                class="form-control"
                                aria-label="Recipient's username"
                                aria-describedby="button-addon2"
                            />
                            <button class="btn btn-outline-secondary" wire:click="update({{ $todoId }})" type="button" id="button-addon2">
                                Yenilə
                            </button>
                        </div>
                    @endif

                  </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-light">
                    @forelse ($todos as $item )
                    <li class="list-group-item d-flex align-items-center justify-content-between">
                        <div wire:click="toggle({{ $item->id }})" class="form-check d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" value="" id="checkboxExample1" @if ($item->is_completed==1) checked @endif />
                            @if ($item->is_completed== 1)
                                <label class="form-check-label text-decoration-line-through" for="checkboxExample1">{{ $item->title }}</label>
                            @elseif ($item->is_completed == 0)
                                <label class="form-check-label"   for="checkboxExample1">{{ $item->title }}</label>
                            @endif
                        </div>
                        <div>
                            <button type="button" wire:click="edit({{ $item->id }})" class="btn btn-primary rounded-pill btn-sm me-1" data-mdb-ripple-init>
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button type="button" wire:click="delete({{ $item->id }})" class="btn btn-danger rounded-pill btn-sm" data-mdb-ripple-init>
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    </li>
                    @empty
                    <li class="list-group-item d-flex align-items-center justify-content-center">
                        <div class="text-muted">
                            <i class="bi bi-exclamation-circle"></i> Hələ heç bir məlumat yoxdur.
                        </div>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
