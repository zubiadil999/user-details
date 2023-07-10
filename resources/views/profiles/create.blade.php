<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css">

    <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

<div class="container mx-auto">
    <div class="max-w-md bg-white rounded-lg overflow-hidden shadow-md">
        <div class="py-4 px-6 bg-primary">
            <h2 class="text-xl font-semibold text-white">{{ __('User Form') }}</h2>
        </div>

        <div class="px-6 py-4">
            <form action="{{ route('form.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="profile_name" class="block text-gray-700 font-bold mb-2">{{ __('Profile Name') }}</label>
                    <input type="text" class="form-control @error('profile_name') is-invalid @enderror" name="profile_name" value="{{ old('profile_name') }}" required autofocus>
                    @error('profile_name')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="profile_image" class="block text-gray-700 font-bold mb-2">{{ __('Profile Image') }}</label>
                    <input type="file" class="form-control @error('profile_image') is-invalid @enderror" name="profile_image" required>
                    @error('profile_image')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">{{ __('Email') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-gray-700 font-bold mb-2">{{ __('Address') }}</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="pan_card_number" class="block text-gray-700 font-bold mb-2">{{ __('PAN Card Number') }}</label>
                    <input type="text" class="form-control @error('pan_card_number') is-invalid @enderror" name="pan_card_number" value="{{ old('pan_card_number') }}" required>
                    @error('pan_card_number')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="aadhar_card_number" class="block text-gray-700 font-bold mb-2">{{ __('Aadhar Card Number') }}</label>
                    <input type="text" class="form-control @error('aadhar_card_number') is-invalid @enderror" name="aadhar_card_number" value="{{ old('aadhar_card_number') }}" required>
                    @error('aadhar_card_number')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    @if(session('success'))
        swal("Success!", "{{ session('success') }}", "success");
    @endif
</script>

</body>
</html>
