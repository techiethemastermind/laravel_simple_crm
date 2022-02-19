<x-app-layout>

    @push('after-styles')
    <style>
        .inline-block {
            display: inline-block;
        }

        .w-125 {
            width: 125px;
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
                    <div class="p-2">
                        <label class="inline-block w-125">Name:</label>
                        <label class="inline-block" class="ml-4">{{ $customer->name }}</label>
                    </div>
                    <div class="p-2">
                        <label class="inline-block w-125">Email:</label>
                        <label class="inline-block" class="ml-4">{{ $customer->email }}</label>
                    </div>
                    <div class="p-2">
                        <label class="inline-block w-125">Phone:</label>
                        <label class="inline-block" class="ml-4">{{ $customer->phone }}</label>
                    </div>
                    <div class="p-2">
                        <label class="inline-block w-125">Budget:</label>
                        <label class="inline-block" class="ml-4">{{ $customer->budget }}</label>
                    </div>
                    <div class="p-2">
                        <label class="inline-block w-125">Message:</label>
                        <label class="inline-block" class="ml-4">{{ $customer->message }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('after-scripts')

    <script>

        $(function() {

            //
        })
    </script>

    @endpush
</x-app-layout>
