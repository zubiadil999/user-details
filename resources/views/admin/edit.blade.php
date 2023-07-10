<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css">
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-8">
    <div class="max-w-md mx-auto bg-white rounded p-6 shadow">
        <h2 class="text-2xl font-semibold mb-6">{{ __('Edit Profile') }}</h2>

        <form action="{{ route('admin.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Display the form fields with their current values -->
            <div class="mb-6">
                <label for="profile_name" class="block text-gray-700 font-semibold mb-2">{{ __('Profile Name') }}</label>
                <input type="text" class="w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:border-blue-500 @error('profile_name') border-red-500 @enderror" name="profile_name" value="{{ $profile->profile_name }}" required>
                @error('profile_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="profile_image" class="block text-gray-700 font-semibold mb-2">{{ __('Profile Image') }}</label>
                <input type="file" class="w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:border-blue-500 @error('profile_image') border-red-500 @enderror" name="profile_image">
                @error('profile_image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-semibold mb-2">{{ __('Email') }}</label>
                <input type="email" class="w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:border-blue-500 @error('email') border-red-500 @enderror" name="email" value="{{ $profile->email }}" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="address" class="block text-gray-700 font-semibold mb-2">{{ __('Address') }}</label>
                <textarea class="w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:border-blue-500 @error('address') border-red-500 @enderror" name="address">{{ $profile->address }}</textarea>
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="pan_card_number" class="block text-gray-700 font-semibold mb-2">{{ __('PAN Card Number') }}</label>
                <input type="text" class="w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:border-blue-500 @error('pan_card_number') border-red-500 @enderror" name="pan_card_number" value="{{ $profile->pan_card_number }}" required>
                @error('pan_card_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="aadhar_card_number" class="block text-gray-700 font-semibold mb-2">{{ __('Aadhar Card Number') }}</label>
                <input type="text" class="w-full border border-gray-300 rounded py-2 px-3 focus:outline-none focus:border-blue-500 @error('aadhar_card_number') border-red-500 @enderror" name="aadhar_card_number" value="{{ $profile->aadhar_card_number }}" required>
                @error('aadhar_card_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white rounded py-2 px-4 hover:bg-blue-600">{{ __('Update') }}</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
