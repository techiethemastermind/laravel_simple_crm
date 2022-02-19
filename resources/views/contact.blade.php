<x-guest-layout>

    @push('after-styles')

    <style>
        .inline-block {
            display: inline-block;
        }

        .w-125 {
            width: 125px;
        }

        .mb-2 {
            margin-bottom: 15px;
        }

        button {
            padding: 6px 15px;
            border: 1px solid #333;
            border-radius: 5px;
        }

        .alert-danger {
            color: red;
        }

        .alert-success {
            color: green;
        }
    </style>

    @endpush

    <!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ __('Contact Us') }}
        </div>
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Alert User -->
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" class="p-2">
                        @csrf

                        <div class="p-2">
                            <label for="name" class="inline-block w-125">Name:</label>
                            <input type="text" id="name" name="name" class="ml-4">

                            <!-- Show error -->
                                @if ($errors->has('name'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>

                        <div class="p-2">
                            <label for="phone" class="inline-block w-125">Phone Number:</label>
                            <input type="text" id="phone" name="phone" class="ml-4">

                            <!-- Show error -->
                            @if ($errors->has('phone'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif 
                        </div>

                        <div class="p-2">
                            <label for="email" class="inline-block w-125">Email:</label>
                            <input type="email" id="email" name="email" class="ml-4">

                            <!-- Show error -->
                            @if ($errors->has('email'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif 
                        </div>

                        <div class="p-2">
                            <label for="budget" class="inline-block w-125">Desired Budget:</label>
                            <input type="text" id="budget" name="budget" class="ml-4">

                            <!-- Show error -->
                            @if ($errors->has('budget'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('budget') }}
                                </div>
                            @endif 
                        </div>

                        <div class="p-2">
                            <label for="message" class="inline-block w-125 mb-2">Message:</label> <br>
                            <textarea name="message" id="message" cols="40" rows="3"></textarea>

                            <!-- Show error -->
                            @if ($errors->has('message'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('message') }}
                                </div>
                            @endif 
                        </div>
                        <div class="p-2">
                            <button type="submit" class="bg-blue-500">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
