@php
    $inputClass = $inputClass ?? 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full mt-1 block';
    $labelClass = $labelClass ?? 'block font-medium text-sm text-gray-700 dark:text-gray-300';
    $showEmailVerification = $showEmailVerification ?? false;
    $adminLayout = $adminLayout ?? false;
@endphp

<form method="post" action="{{ route('profile.update') }}" class="@unless($adminLayout) mt-6 space-y-6 @else @endunless">
    @csrf
    @method('patch')

    <div class="@unless($adminLayout) space-y-6 @else @endunless">
        <div class="@if($adminLayout) form-group @endif">
            <label for="name" class="{{ $labelClass }}">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="{{ $inputClass }} @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="@if($adminLayout) form-group @endif">
            <label for="email" class="{{ $labelClass }}">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="{{ $inputClass }} @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror

            @if ($showEmailVerification && $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" type="submit" class="underline text-sm text-gray-600 dark:hover:text-gray-100 rounded-md">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="@if($adminLayout) form-group @endif">
            <label for="mobile" class="{{ $labelClass }}">{{ __('Mobile') }}</label>
            <input id="mobile" name="mobile" type="text" class="{{ $inputClass }} @error('mobile') is-invalid @enderror" value="{{ old('mobile', $user->mobile) }}" autocomplete="tel">
            @error('mobile')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="@if($adminLayout) form-group @endif">
            <label for="address" class="{{ $labelClass }}">{{ __('Address') }}</label>
            <textarea id="address" name="address" rows="3" class="{{ $inputClass }} @error('address') is-invalid @enderror" autocomplete="street-address">{{ old('address', $user->address) }}</textarea>
            @error('address')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <hr class="@if($adminLayout) my-3 @else my-6 border-gray-200 dark:border-gray-700 @endif">

        <p class="@if($adminLayout) text-muted small @else text-sm text-gray-600 dark:text-gray-400 @endif">{{ __('Leave password blank to keep your current password.') }}</p>

        <div class="@if($adminLayout) form-group @endif">
            <label for="password" class="{{ $labelClass }}">{{ __('New password') }}</label>
            <input id="password" name="password" type="password" class="{{ $inputClass }} @error('password') is-invalid @enderror" autocomplete="new-password">
            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="@if($adminLayout) form-group @endif">
            <label for="password_confirmation" class="{{ $labelClass }}">{{ __('Confirm new password') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="{{ $inputClass }}" autocomplete="new-password">
        </div>
    </div>

    <div class="@if($adminLayout) mt-3 @else flex items-center gap-4 mt-6 @endif">
        @if($adminLayout)
            <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-light">{{ __('Cancel') }}</a>
        @else
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        @endif

        @if (session('success'))
            @if($adminLayout)
                <span class="text-success ml-2">{{ session('success') }}</span>
            @else
                <p class="text-sm text-green-600 dark:text-green-400">{{ session('success') }}</p>
            @endif
        @endif
    </div>
</form>

@if ($showEmailVerification && $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail)
    <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="hidden">
        @csrf
    </form>
@endif
