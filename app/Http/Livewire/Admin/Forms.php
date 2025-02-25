<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Forms extends Component
{
    public $userId, $username, $email, $password, $phone, $address, $role;
    public $showModal = false; // Modal toggle
    public $isEditMode = false; // Mode to check if editing
    public $showDeleteModal = false;
    public $deleteUserId;
    protected $listeners = ['refreshComponent' => '$refresh']; // Refresh listener

    protected function rules()
    {
        return [
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId, // 👈 Ignore current user email
            'password' => 'nullable|min:6',
            'phone' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'role' => 'nullable',
        ];
    }
    

    public function openModal()
    {
        $this->resetFields();
        $this->isEditMode = false;
        $this->showModal = true;
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);

        $this->userId = $user->id;
        $this->username = $user->name;
        $this->email = $user->email;
        $this->password = ''; // Don't fetch existing password
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->role = $user->role;

        $this->isEditMode = true;
        $this->showModal = true;
    }

    public function saveUser()
    {
        try {
            $this->validate();

            if ($this->isEditMode) {
                // Update User
                $user = User::findOrFail($this->userId);
                $user->update([
                    'name' => $this->username,
                    'email' => $this->email,
                    'password' => $this->password ? Hash::make($this->password) : $user->password,
                    'phone' => $this->phone,
                    'address' => $this->address,
                    'role' => $this->role,
                ]);

                $message = 'User updated successfully!';
            } else {
                // Create New User
                User::create([
                    'name' => $this->username,
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                    'phone' => $this->phone,
                    'address' => $this->address,
                    'role' => $this->role,
                ]);

                $message = 'User added successfully!';
            }

            $this->closeModal();
            $this->emit('showToastr', 'success', $message);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->emit('showToastr', 'error', collect($e->validator->errors()->all())->implode('<br>'));
        } catch (\Exception $e) {
            $this->emit('showToastr', 'error', 'Something went wrong! Please try again.');
        }
    }

    public function closeModal()
    {
        
        $this->resetFields();
        $this->showModal = false;
        $this->emit('refreshComponent');
        return redirect()->route('admin.forms');
    }

    private function resetFields()
    {
        $this->reset(['userId', 'username', 'email', 'password', 'phone', 'address', 'role']);
        $this->resetValidation();
    }
    public function deleteUser($Uid)
    {
        $this->deleteUserId = $Uid;
        $this->showDeleteModal = true; // Modal ko dikhane ke liye true karna
    }
    
    public function closeDeleteModal()
    {
        $this->showDeleteModal = false; // Modal ko hide karna
    }
    
    public function confirmDelete()
    {
        if ($this->deleteUserId) {
            User::find($this->deleteUserId)?->delete();
            $this->emit('showToastr', 'success', 'user Deleted');
        }
        
        $this->closeDeleteModal();
    }

    public function render()
    {
        $users = User::all();
        return view('livewire.admin.forms', compact('users'));
    }


}
