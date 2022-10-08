@inject('products', 'App\Services\Products')

<x-orders.main title="Editar orden">
    <a href="{{ route('orders.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Regresar</a>
    <div class="w-full px-6 py-4">
        <form method="POST" action="{{ route('orders.update', [$order]) }}">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="status" value="Estado"/>

                <x-orders.select id="status" name="status">
                    <option value="Inactiva" {{ (old('status') == 'Inactiva' || $order->status == 'Inactiva') ? 'selected' : '' }}>Inactiva</option>
                    <option value="Activa" {{ (old('status') == 'Activa' || $order->status == 'Activa') ? 'selected' : '' }}>Activa</option>
                    <option value="Completada" {{ (old('status') == 'Completada' || $order->status == 'Completada') ? 'selected' : '' }}>Completada</option>
                </x-orders.select>

                @error('status')<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>

            <div class="mt-4">
                <x-input-label for="comments" value="Comentarios" />

                <x-orders.textarea id="comments" name="comments">
                    {{ old('comments') ?? $order->comments }}
                </x-orders.textarea>

                @error('comments')<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>

            <div class="mt-4">
                <x-input-label for="product" value="Productos"/>

                <x-orders.select id="product" name="products[]" placeholder="Seleccione Productos" multiple size='15'>
                    @foreach ($products->get() as $product)
                        @php
                            $result = false;
                            foreach ($order->products as $orderProduct) {
                                if ($orderProduct->id == $product->id) {
                                    $result = true;
                                    break;
                                }
                            }
                        @endphp
                        <option value="{{ $product->id }}" {{ $result ? 'selected' : ''}}>
                            {{ $product->name }} - {{ $product->price }}$
                        </option>
                    @endforeach
                </x-orders.select>

                @error('products')<div class="mt-1 text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>

            <div class="mt-4">
                <x-primary-button>Actualizar</x-primary-button>
            </div>
        </form>
    </div>
</x-orders.main>
