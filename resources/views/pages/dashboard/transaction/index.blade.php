<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction') }}
        </h2>
    </x-slot>

    <x-slot name="script">
        <script>
            //AJAX Datatable

            var datatable = $('#crudTable').DataTable({
                ajax: {
                    url: '{!! url()->current() !!}'
                },
                columns : [
                    {data: 'id', name: 'id', width: '5%'},
                    {data: 'name', name: 'name', width: '5%'},
                    {data: 'email', name: 'email', width: '5%'},
                    {data: 'phone', name: 'phone', width: '5%'},
                    {data: 'courier', name: 'courier', width: '5%'},
                    {data: 'total_price', name: 'total_price', width: '5%'},
                    {data: 'status', name: 'status', width: '5%'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '10% '
                    }
                ]
            })
        </script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden sm-rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="crudTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Courier</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
