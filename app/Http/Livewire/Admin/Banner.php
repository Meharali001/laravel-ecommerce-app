<?php

namespace App\Http\Livewire\Admin;

use App\Models\SiteBanner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Banner extends Component
{
    use WithFileUploads;

    public $proid, $brand, $type, $slogan, $description, $image ;
    public $showModal = false;
    public $isEditMode = false;
    public $showDeleteModal = false;
    public $deleteUserId;
    public $existingImage;

    protected function rules()
    {
        return [
            'brand' => 'required|string|max:255',
            'slogan' => 'required|string|max:255',
            'description' => 'required|string|max:255',
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
        $pro = SiteBanner::findOrFail($id);

        $this->proid = $pro->id;
        $this->brand = $pro->brand;
        $this->type = $pro->type;
        $this->description = $pro->description;
        $this->slogan = $pro->slogan;
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
            $product = SiteBanner::find($this->deleteUserId);

            if ($product) {
                // Delete Image from Storage
                if ($product->image) {
                    Storage::delete('public/banner/' . $product->image);
                }

                $product->delete();
                $this->emit('showToastr', 'success', 'Product Deleted');
            }

            $this->closeDeleteModal();
        }
    }

    private function resetFields()
    {
        $this->reset(['proid', 'brand', 'type', 'slogan', 'description', 'image', 'existingImage']);
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
                $this->image->storeAs('public/banner', $imageName);

                // Delete old image if updating
                if ($this->isEditMode && $this->existingImage) {
                    Storage::delete('public/banner/' . $this->existingImage);
                }
            }

            if ($this->isEditMode) {
                // Update Product
                $products = SiteBanner::findOrFail($this->proid);
                $products->update([
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'brand' => $this->brand,
                    'slogan' => $this->slogan,
                    'type' => $this->type,
                    'description' => $this->description,
                    'brand' => $this->brand,                    
                    'image' => $imageName,
                ]);

                $message = 'Product updated successfully!';
            } else {
                // Create New Product
                SiteBanner::create([
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'brand' => $this->brand,
                    'slogan' => $this->slogan,
                    'type' => $this->type,
                    'description' => $this->description,
                    'brand' => $this->brand,                    
                    'image' => $imageName,
                ]);

                $message = 'Banner added successfully!';
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
        $banners = SiteBanner::all();
        return view('livewire.admin.banner',compact('banners'));
    }
}
