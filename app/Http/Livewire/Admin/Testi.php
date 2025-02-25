<?php

namespace App\Http\Livewire\Admin;

use App\Models\Testimonial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Testi extends Component
{
    use WithFileUploads;

    public $proid, $name, $comment,  $image ;
    public $showModal = false;
    public $isEditMode = false;
    public $showDeleteModal = false;
    public $deleteUserId;
    public $existingImage;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'comment' => 'required|string|max:255',
            'image' => $this->isEditMode ? 'nullable|image' : 'required|image',
        ];
    }

    public function openModal()
    {
        $this->resetFields();
        $this->isEditMode = false;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function editProduct($id)
    {
        $pro = Testimonial::findOrFail($id);

        $this->proid = $pro->id;
        $this->name = $pro->name;
        $this->comment = $pro->comment;
        $this->existingImage = $pro->image; // Save existing image for delete later

        $this->isEditMode = true;
        $this->showModal = true;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
    }

    public function deleteProduct($id)
    {
        $this->deleteUserId = $id;
        $this->showDeleteModal = true;
    }

    public function confirmDelete()
    {
        if ($this->deleteUserId) {
            $product = Testimonial::find($this->deleteUserId);

            if ($product) {
                // Delete Image from Storage
                if ($product->image) {
                    Storage::delete('public/testimonial/' . $product->image);
                }

                $product->delete();
                $this->emit('showToastr', 'success', 'testimonial Deleted');
            }

            $this->closeDeleteModal();
        }
    }

    private function resetFields()
    {
        $this->reset(['proid', 'name', 'comment',  'image', 'existingImage']);
        $this->resetValidation();
    }

    public function saveProduct()
    {
        try {
            $this->validate();

            $imageName = $this->existingImage; // Default to existing image

            if ($this->image) {
                // Generate new filename
                $imageName = time() . '.' . $this->image->getClientOriginalExtension();
                $this->image->storeAs('public/testimonial', $imageName);

                // Delete old image if updating
                if ($this->isEditMode && $this->existingImage) {
                    Storage::delete('public/testimonial/' . $this->existingImage);
                }
            }

            if ($this->isEditMode) {
                // Update Product
                $products = Testimonial::findOrFail($this->proid);
                $products->update([
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'name' => $this->name,
                    'comment' => $this->comment,                  
                    'image' => $imageName,
                ]);

                $message = 'testimonial updated successfully!';
            } else {
                // Create New Product
                Testimonial::create([
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'name' => $this->name,
                    'comment' => $this->comment,                  
                    'image' => $imageName,
                ]);

                $message = 'testimonial added successfully!';
            }

            $this->closeModal();
            $this->emit('showToastr', 'success', $message);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->emit('showToastr', 'error', collect($e->validator->errors()->all())->implode('<br>'));
        } catch (\Exception $e) {
            $this->emit('showToastr', 'error', 'Something went wrong! Please try again.');
        }
    }
    public function render()
    {
        $testi = Testimonial::all();
        return view('livewire.admin.testi', compact('testi'));
    }
}
