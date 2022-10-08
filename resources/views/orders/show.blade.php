<x-orders.main title="Información de Orden">
    <a href="{{ route('orders.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Regresar</a>
    <h2 class="font-semibold mb-4 mt-3">Información de las compras</h2>
    <h2 class="font-semibold">Usuario: {{ $order->user->name }}</h2>
    <table class="min-w-full divide-y divide-cool-gray-200">
        <thead>
            <tr class="border-b-2">
                <th scope="col" class="px-6 py-3 bg-cool-gray-50"># id de Producto</th>
                <th scope="col" class="px-6 py-3 bg-cool-gray-50">Producto</th>
                <th scope="col" class="px-6 py-3 bg-cool-gray-50">Precio</th>
                <th scope="col" class="px-6 py-3 bg-cool-gray-50">Impuesto</th>
                <th scope="col" class="px-6 py-3 bg-cool-gray-50">Monto del impuesto</th>
                <th scope="col" class="px-6 py-3 bg-cool-gray-50">Precio con impuesto</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-cool-gray-200">
            @foreach($order->products as $product)
                <tr class="bg-gray-200 border-b">
                    <th scope="row" class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-cool-gray-900">{{ $product->id }}</th>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-cool-gray-900">{{ $product->name }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-cool-gray-900">{{ $product->price }} $</td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-cool-gray-900">{{ $product->tax }} %</td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-cool-gray-900">{{ $product->tax_amount }} $</td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-cool-gray-900">{{ $product->price_with_tax }} $</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h3 class="font-semibold mt-3">Id de Orden: {{ $order->id }}</h3>
    <h3 class="font-semibold">Estado: {{ $order->status }}</h3>
    <h3 class="font-semibold">Total: {{ $order->total }} $</h3>
    <h3 class="font-semibold">Impuesto total: {{ $order->total_tax }} $</h3>
    <h3 class="font-semibold">Total con impuesto: {{ $order->total_with_tax }} $</h3>
    <h3 class="font-semibold">Comentario: {{ $order->comments }}</h3>
</x-orders.main>
