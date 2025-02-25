<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
// use Livewire\WithFileUploads;

class EditProfile extends Component
{
    use WithFileUploads; // File upload ke liye required

    public $existingImage;
    public $AdminId, $name, $email, $password, $phone, $address, $role, $note, $image;
    public $isEditMode = false;

    public function role(){
        return [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'role' => 'nullable',
        ];
    }

    // Automatically load user data on component mount
    public function mount()
    {
        $admin = Auth::guard('admin')->user();
    
        $this->AdminId = $admin->id;
        $this->name = $admin->name;
        $this->email = $admin->email;
        $this->phone = $admin->phone;
        $this->address = $admin->address;
        $this->role = $admin->role;
        $this->existingImage = $admin->image;
    }


    

    public function saveUser()
    {
        try {
            $this->validate([
                'name' => 'required|string|max:255',
                'phone' => 'nullable',
                'address' => 'nullable|string|max:255',
                'role' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);
    
            $admin = Admin::findOrFail($this->AdminId);
    
            // Check if new image is uploaded
// Check if new image is uploaded
if ($this->image) {
    $filename = time() . '_' . uniqid() . '.' . $this->image->getClientOriginalExtension();
    $imagePath = $this->image->storeAs('admin_images', $filename, 'public');

    // Delete old image if exists
    if ($admin->image) {
        \Storage::disk('public')->delete('admin_images/' . $admin->image);
    }

    $admin->image = $filename; // ✅ Only filename is saved in DB
}
    
            // Update Other Details
            $admin->update([
                'name' => $this->name,
                'phone' => $this->phone,
                'address' => $this->address,
                'role' => $this->role,
            ]);

            
            $this->emit('refreshHeaderImage');
            $this->emit('showToastr', 'success', 'User updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->emit('showToastr', 'error', collect($e->validator->errors()->all())->implode('<br>'));
        } catch (\Exception $e) {
            $this->emit('showToastr', 'error', 'Something went wrong! Please try again.');
        }
    }
    
    

    

    public function render()
    {
        return view('livewire.admin.edit-profile');
    }
}
