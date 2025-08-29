<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">
        Prueba Técnica - Programador Laravel Mid-Level
    </h1>
    <h2 class="text-lg text-gray-600 mb-8">Catálogo de productos</h2>

    {{-- GRID DE TARJETAS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($productos as $p)
            @php
                $img = $p->imagen
                    ? (Str::startsWith($p->imagen, ['http://', 'https://'])
                        ? $p->imagen
                        : Storage::url($p->imagen))
                    : asset('images/placeholder.svg');
            @endphp

            <article class="rounded-2xl border shadow-sm overflow-hidden bg-white flex flex-col">
                <img class="h-44 w-full object-cover" src="{{ $img }}" alt="{{ $p->nombre }}">
                <div class="p-4 flex-1 flex flex-col">
                    <h3 class="font-semibold text-lg leading-tight">{{ $p->nombre }}</h3>
                    <p class="text-sm text-gray-500">{{ $p->categorias?->nombre }}</p>
                    <div class="mt-3 font-bold text-xl">
                        ${{ number_format($p->precio, 2, ',', '.') }}
                    </div>

                    <div class="mt-auto pt-4">
                        <button type="button"
                            class="w-full inline-flex items-center justify-center gap-2 rounded-xl border px-4 py-2 hover:bg-gray-50 active:scale-[0.99] transition"
                            wire:click="showDetails({{ $p->id }})"
                            x-on:click="$wire.showModal = true">
                            Ver detalles
                        </button>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full text-center text-gray-500">
                No hay productos disponibles.
            </div>
        @endforelse
    </div>

    {{-- MODAL (JS + Livewire) --}}
    <div id="product-modal" wire:show="showModal" class="fixed inset-0 z-50 " aria-hidden="true">
        {{-- overlay --}}
        <div class="absolute inset-0 bg-black/50"></div>

        {{-- dialog --}}
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="w-full max-w-2xl rounded-2xl bg-white shadow-xl {{-- overflow-hidden --}}" role="dialog"
                aria-modal="true" aria-labelledby="product-modal-title" tabindex="-1">
                <div class="flex items-center justify-between px-5 py-4 border-b">
                    <h3 id="product-modal-title" class="text-lg font-semibold">
                        {{ $selected?->nombre ?? 'Producto' }}
                    </h3>

                    <button type="button" class="rounded-lg p-2 hover:bg-gray-100" title="Cerrar"
                        wire:click="closeModal" data-modal-close>
                        ✕
                    </button>
                </div>

                <div class="p-5 space-y-4">
                    @if ($selected)
                        @php
                            $img = $selected->imagen
                                ? (Str::startsWith($selected->imagen, ['http://', 'https://'])
                                    ? $selected->imagen
                                    : Storage::url($selected->imagen))
                                : asset('images/placeholder.svg');
                        @endphp

                        <div class="flex flex-col sm:flex-row gap-5">
                            <img src="{{ $img }}" alt="{{ $selected->nombre }}"
                                class="w-full sm:w-56 h-56 object-cover rounded-xl border">

                            <div class="flex-1 grid gap-2">
                                <div class="text-sm text-gray-500">Categoría</div>
                                <div class="font-medium">{{ $selected->categorias?->nombre ?? '—' }}</div>

                                <div class="text-sm text-gray-500 mt-3">Precio</div>
                                <div class="font-semibold text-lg">
                                    ${{ number_format($selected->precio, 2, ',', '.') }}
                                </div>

                                <div class="text-sm text-gray-500 mt-3">Stock</div>
                                <div>
                                    @if (($selected->stock ?? 0) > 0)
                                        <span
                                            class="inline-flex items-center gap-2 text-green-700 bg-green-100 px-2 py-1 rounded-full text-xs">
                                            Disponible · {{ $selected->stock }} uds
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-2 text-red-700 bg-red-100 px-2 py-1 rounded-full text-xs">
                                            Agotado
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h4 class="font-semibold mb-1">Descripción</h4>
                            <div class="prose max-w-none">
                                {!! $selected->descripcion ?? '<p class="text-gray-500">Sin descripción</p>' !!}
                            </div>
                        </div>
                    @else
                        <div class="text-center text-gray-500">
                            Cargando…
                        </div>
                    @endif
                </div>

                <div class="px-5 py-4 border-t flex items-center justify-end">
                    <button type="button" class="rounded-xl border px-4 py-2 hover:bg-gray-50" wire:click="closeModal"
                        data-modal-close>
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt-8">
    {{ $productos->onEachSide(1)->links() }}
</div>
