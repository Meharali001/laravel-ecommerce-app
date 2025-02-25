<div>
    <div class="main-content">
        <!-- Button to Open Modal -->
        <button class="btn btn-primary" wire:click="openModal">Add User</button>

        <!-- Bootstrap Modal -->
        @if($showModal)
            <div class="modal show d-block" id="modalId" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Register User</h5>
                            <button type="button" class="close" wire:click="closeModal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="saveUser">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" wire:model="username" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" wire:model="email" class="form-control">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" wire:model="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" wire:model="phone" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" wire:model="address" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select wire:model="role" class="form-control">
                                        <option value="">Select Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                    @error('role') <span class="text-danger">{{ $message }}</span> @enderror
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
        {{-- @dd($users) --}}
        

        <div class="row m-t-30">
            <div class="col-md-12">
                <!-- DATA TABLE-->
                <div class="table-responsive m-b-40">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>email</th>
                                <th>phone</th>
                                <th>role</th>
                                <th>adress</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user )
                            <tr>
                                <td>{{ $user->name  ?? '_'}}</td>
                                <td>{{ $user->email  ?? '_'}}</td>
                                <td>{{ $user->phone  ?? '_'}}</td>
                                <td>{{ $user->role  ?? '_'}}</td>
                                <td>{{ $user->address  ?? '_'}}</td>
                                

                            </tr>
                                
                            @endforeach

                           
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE-->
            </div>
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <h3 class="title-5 m-b-35">data table</h3>
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="rs-select2--light rs-select2--md">
                            <select class="js-select2" name="property">
                                <option selected="selected">All Properties</option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <div class="rs-select2--light rs-select2--sm">
                            <select class="js-select2" name="time">
                                <option selected="selected">Today</option>
                                <option value="">3 Days</option>
                                <option value="">1 Week</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <button class="au-btn-filter">
                            <i class="zmdi zmdi-filter-list"></i>filters</button>
                    </div>
                    <div class="table-data__tool-right">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small" wire:click="openModal">
                            <i  class="zmdi zmdi-plus"></i>add item</button>
                        <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                            <select class="js-select2" name="type">
                                <option selected="selected">Export</option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>
                                    <label class="au-checkbox">
                                        <input type="checkbox">
                                        <span class="au-checkmark"></span>
                                    </label>
                                </th>
                                <th>name</th>
                                <th>email</th>
                                <th>phone</th>
                                <th>role</th>
                                <th>adress</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user )
                            <tr class="tr-shadow">
                                <td>
                                    <label class="au-checkbox">
                                        <input type="checkbox">
                                        <span class="au-checkmark"></span>
                                    </label>
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <span class="block-email">{{ $user->email }}</span>
                                </td>
                                <td class="desc">{{ $user->phone }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <span class="status--process">{{ $user->address }}</span>
                                </td>
                                {{-- <td>$679.00</td> --}}
                                <td>
                                    <div class="table-data-feature">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                            <i class="zmdi zmdi-mail-send"></i>
                                        </button>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" wire:click="editUser({{ $user->id }})">
                                        
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" wire:click="deleteUser({{ $user->id }})">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                        {{-- <button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#staticModal">
											Static
										</button> --}}
                                        {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-more"></i>
                                        </button> --}}
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach

                            

                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
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

