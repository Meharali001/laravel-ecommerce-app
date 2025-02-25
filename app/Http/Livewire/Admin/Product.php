<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Product extends Component
{
    use WithFileUploads;

    public $proid, $name, $color, $price, $qty,  $type, $image , $brand, $description , $material ;
    public $showModal = false;
    public $isEditMode = false;
    public $showDeleteModal = false;
    public $deleteUserId;
    public $existingImage;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
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
        $pro = ProductModel::findOrFail($id);

        $this->proid = $pro->id;
        $this->name = $pro->name;
        $this->color = $pro->color;
        $this->price = $pro->price;
        $this->qty = $pro->qty;
        $this->brand = $pro->brand;
        $this->description = $pro->description;
        $this->material = $pro->material;
        $this->type = $pro->type;
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
            $product = ProductModel::find($this->deleteUserId);

            if ($product) {
                // Delete Image from Storage
                if ($product->image) {
                    Storage::delete('public/products/' . $product->image);
                }

                $product->delete();
                $this->emit('showToastr', 'success', 'Product Deleted');
            }

            $this->closeDeleteModal();
        }
    }

    private function resetFields()
    {
        $this->reset(['proid', 'name', 'color', 'price', 'type', 'image', 'existingImage']);
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
                $this->image->storeAs('public/products', $imageName);

                // Delete old image if updating
                if ($this->isEditMode && $this->existingImage) {
                    Storage::delete('public/products/' . $this->existingImage);
                }
            }

            if ($this->isEditMode) {
                // Update Product
                $products = ProductModel::findOrFail($this->proid);
                $products->update([
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'name' => $this->name,
                    'color' => $this->color,
                    'type' => $this->type,
                    'price' => $this->price,
                    'qty' => $this->qty,
                    'material' => 'stainless steel',
                    'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magnam, autem earum. Perspiciatis deleniti aliquam odio, quaerat ut eveniet pariatur laboriosam qui tempora animi illo nisi voluptates ullam? Quidem, accusamus reprehenderit!',
                    'brand' => $this->brand,
                    
                    'image' => $imageName,
                ]);

                $message = 'Product updated successfully!';
            } else {
                // Create New Product
                ProductModel::create([
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'name' => $this->name,
                    'color' => $this->color,
                    'type' => $this->type,
                    'price' => $this->price,
                    'qty' => $this->qty,
                    'material' => 'stainless steel',
                    'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magnam, autem earum. Perspiciatis deleniti aliquam odio, quaerat ut eveniet pariatur laboriosam qui tempora animi illo nisi voluptates ullam? Quidem, accusamus reprehenderit!',
                    'brand' => $this->brand,
                    'image' => $imageName,
                ]);

                $message = 'Product added successfully!';
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
        $products = ProductModel::all();
        return view('livewire.admin.product', compact('products'));
    }
}

