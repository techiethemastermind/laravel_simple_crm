<x-app-layout>

    @push('after-styles')
    <style>
        table thead th {
            text-align: left;
        }
        .action button, .action a {
            padding: 6px 15px;
            border: 1px solid #333;
            border-radius: 5px;
        }
        .action button[disabled] {
            background-color: #ddd;
        }
    </style>
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table id="tbl_customers" class="w-full whitespace-no-wrapw-full whitespace-no-wrap">
                        <thead>
                            <tr class="font-bold">
                                <th class="p-2">No</th>
                                <th class="p-2">Name</th>
                                <th class="p-2">Phone</th>
                                <th class="p-2">Email</th>
                                <th class="p-2">Budget</th>
                                <th class="p-2">Message</th>
                                <th class="p-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                            <tr>
                                <td class="p-2">{{ $loop->iteration }}</td>
                                <td class="p-2">{{ $customer->name }}</td>
                                <td class="p-2">{{ $customer->phone }}</td>
                                <td class="p-2">{{ $customer->email }}</td>
                                <td class="p-2">{{ $customer->budget }}</td>
                                <td class="p-2">{{ $customer->message }}</td>
                                <td class="p-2 action">
                                    @if($customer->wp_account == 0)
                                    <button type="button" data-id="{{ $customer->id }}">Create WordPress account</button>
                                    @else
                                    <button type="button" disabled>WordPress Account created</button>
                                    @endif
                                    <a href="{{ route('dashboard.account.view', $customer->id) }}">View Profile</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('after-scripts')

    <script>

        $(function() {

            $('#tbl_customers').on('click', 'button', (e) => {
                
                let button = $(e.target);
                let customer_id = button.attr('data-id');
                
                $.ajax({
                    method: "POST",
                    url: "{{ route('dashboard.account.create') }}",
                    data: {
                        id: customer_id
                    },
                    success: (res) => {
                        if (res.success) {
                            button.text('WordPress Account created');
                            button.attr('disabled', 'disabled');
                        } else {
                            alert(res.message);
                        }
                    },
                    error: (err) => {
                        console.log(res);
                    }
                });
            });
        })
    </script>

    @endpush
</x-app-layout>
