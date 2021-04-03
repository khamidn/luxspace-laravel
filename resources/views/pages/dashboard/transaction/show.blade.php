<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transaction &raquo; #{{ $transaction->id }} {{ $transaction->name}}
        </h2>
    </x-slot>

    <x-slot name="script">
        <script>
            //Ajax DataTable

            var datatable = $('#crudTable').DataTable({
                ajax: {
                    url: '{!! url()->current() !!}'
                },
                columns: [
                    { data: 'id', name: 'id', width: '5%'},
                    { data: 'product.name', name: 'product.name'},
                    { data: 'product.price', name: 'product.price'},
                ],                
            })
        </script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight mb-5">Transaction Details</h2>
            <div class="bg-white overflow-hidden shadow sm:rounded-lg mb-10">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full">
                        <tbody>
                            <tr>
                                <th class="border px-6 py-4 text-right">Name</th>
                                <th class="border px-6 py-4">{{ $transaction->name }}</th>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Email</th>
                                <th class="border px-6 py-4">{{ $transaction->email }}</th>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Address</th>
                                <th class="border px-6 py-4">{{ $transaction->address }}</th>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Phone</th>
                                <th class="border px-6 py-4">{{ $transaction->phone }}</th>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Courier</th>
                                <th class="border px-6 py-4">{{ $transaction->courier }}</th>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Payment</th>
                                <th class="border px-6 py-4">{{ $transaction->payment }}</th>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">payment URL</th>
                                <th class="border px-6 py-4">{{ $transaction->payment_url }}</th>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Total Price</th>
                                <th class="border px-6 py-4">{{ number_format($transaction->total_price) }}</th>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Status</th>
                                <th class="border px-6 py-4">{{ $transaction->status }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight mb-5">Transaction Item</h2>
            <div class="shadow overlflow-hidden sm-rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="crudTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>