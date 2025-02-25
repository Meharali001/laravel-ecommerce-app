<div>
    <div class="main-content">
        
        <!-- Button to Open Modal -->
        <button class="au-btn au-btn-icon au-btn--green au-btn--small" wire:click="openModal">
            <i  class="zmdi zmdi-plus"></i>add item</button>

        <!-- Bootstrap Modal -->
        @if($showModal)
            <div class="modal show d-block" id="modalId" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Product</h5>
                            <button type="button" class="close" wire:click="closeModal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="saveProduct">
                                <div class="form-group">
                                    <label>Brand</label>
                                    <input type="text" wire:model="brand" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>type</label>
                                    <input type="text" wire:model="type" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Slogan</label>
                                    <input type="text" wire:model="slogan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" wire:model="description" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Profile Image</label>
                                    <input type="file" wire:model="image" class="form-control">
                                
                                    <!-- Show Preview -->
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" class="mt-2" width="100">
                                    @elseif ($existingImage)
                                        <img src="{{ asset('storage/banner/' . $existingImage) }}" class="mt-2" width="100">
                                    @endif
                                
                                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                                    <button type="submit" class="btn btn-success">{{ $isEditMode ? 'Update' : 'Submit' }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row m-t-30">
            <div class="col-md-12">
                <!-- DATA TABLE-->
                <div class="table-responsive m-b-40">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>date</th>
                                <th>Brand</th>
                                <th>Slogan</th>
                                <th>type</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($products) --}}
                            @foreach ($banners as $pro )
                            <tr>
                                <td>{{  $pro->created_at ?? '_' }}</td>
                                <td>{{ $pro->brand ?? '_' }}</td>
                                <td>{{ $pro->slogan ?? '_' }}</td>
                                <td>{{ $pro->type ?? '_' }}</td>
                                <td>{{ $pro->description ?? '_' }}</td>
                                <td><img src="{{ asset('storage/banner/'. $pro->image ?? '' ) }} " width="100" height="100" alt="{{ $pro->name }}"></td>
                                <td>
                                    <div class="table-data-feature">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                            <i class="zmdi zmdi-mail-send"></i>
                                        </button>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" wire:click="editProduct({{ $pro->id }})">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" wire:click="deleteProduct({{ $pro->id }})">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-more"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                                
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE-->
            </div>
        </div>
    </div>
        <!-- Delete Confirmation Modal -->
        @if ($showDeleteModal)
        <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Confirmation</h5>
                        <button type="button" class="close" wire:click="closeDeleteModal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this user?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeDeleteModal">Cancel</button>
                        <button type="button" class="btn btn-danger" wire:click="confirmDelete">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
        </div>
    
</div>



