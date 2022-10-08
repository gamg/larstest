<x-orders.main title="Mis Ordenes">
    @if(session()->has('message'))
        <h2 class="text-indigo-700 bg-indigo-50 p-6">{{ session('message') }}</h2>
    @endif
    <a href="{{ route('orders.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Crear Orden</a>
    <table class="min-w-full divide-y divide-cool-gray-200 mt-4">
        <thead>
        <tr class="border-b-2">
            <th scope="col" class="px-6 py-3 bg-cool-gray-50"># id</th>
            <th scope="col" class="px-6 py-3 bg-cool-gray-50">Total</th>
            <th scope="col" class="px-6 py-3 bg-cool-gray-50">Impuesto total</th>
            <th scope="col" class="px-6 py-3 bg-cool-gray-50">Total con impuesto</th>
            <th scope="col" class="px-6 py-3 bg-cool-gray-50">Estado</th>
            <th scope="col" class="px-6 py-3 bg-cool-gray-50">Acciones</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-cool-gray-200">
        @forelse($orders as $order)
            <tr class="bg-gray-200 border-b">
                <th scope="row" class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-cool-gray-900">{{ $order->id }}</th>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-cool-gray-900">{{ $order->total }} $</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-cool-gray-900">{{ $order->total_tax }} $</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-cool-gray-900">{{ $order->total_with_tax }} $</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-cool-gray-900">{{ $order->status }}</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-cool-gray-900">
                    <a href="{{ route('orders.show', [$order]) }}" class="text-xl"><i class="fa-solid fa-circle-info"></i></a>
                    <a href="{{ route('orders.edit', [$order]) }}" class="text-xl"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a class="text-xl" href="{{ route('orders.destroy', [$order]) }}"
                       onclick="event.preventDefault(); document.getElementById('destroy-form-{{$order->id}}').submit();">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                    <form id="destroy-form-{{$order->id}}" action="{{ route('orders.destroy', [$order]) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
        @empty
            <h3>No se han creado Ordenes!</h3>
        @endforelse
        </tbody>
    </table>
</x-orders.main>

