<div class="main-content">
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Profile</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="saveUser">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" wire:model="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" wire:model="email" class="form-control" readonly>
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
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
                    <div class="form-group">
                        <label>Profile Image</label>
                        <input type="file" wire:model="image" class="form-control">
                    
                        <!-- Show Preview -->
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" class="mt-2" width="100">
                        @elseif ($existingImage)
                            <img src="{{ asset('storage/admin_images/' . $existingImage) }}" class="mt-2" width="100">
                        @endif
                    
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
