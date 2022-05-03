<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Custom') }}
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
                    {data: 'reference_photo', name: 'reference_photo'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'address', name: 'address'},
                    {data: 'location', name: 'location'},
                    {data: 'date', name: 'date'},
                    {data: 'furniture_for', name: 'furniture_for'},
                    {data: 'furniture_type', name: 'furniture_type'},
                    {data: 'description', name: 'description'},
                ]
            })
        </script>
    </x-slot>

    <div class="py-12">
        <div class="w-auto mx-auto sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden sm-rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="crudTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Reference Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Location</th>
                                <th>Date</th>
                                <th>Kebutuhan Furniture</th>
                                <th>Tipe Furniture</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
