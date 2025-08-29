<?php
namespace App\Livewire\Tienda;

use App\Models\Productos;
use Livewire\Component;

class ProductosList extends Component
{
    public ?Productos $selected = null;

    public $showModal = false;

    public $content = '';

    public function showDetails(int $productId): void
    {
        $this->selected = Productos::with('categorias')->findOrFail($productId);

        $this->dispatch('open-producto-modal');
    }

    public function closeModal(): void
    {
        $this->selected = null;
        $this->dispatch('close-producto-modal');
    }

    public function render()
    {
        $productos = Productos::query()
            ->with('categorias:id,nombre')
            ->orderByDesc('id')
            ->get();

        return view('livewire.tienda.productos-list', [
            'productos' => $productos,
        ]);
    }
}
