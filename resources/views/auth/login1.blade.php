@extends('layouts.master')


@section('content')

	<h2 class="title">Login Writher</h2>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> {{ isset($url) ? ucwords($url) : ""}} {{ __('Login') }}</div>

                    <div class="card-body">
                        @isset($url)
                        <form method="POST" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}">
                        @else
                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @endisset
                            @csrf

			{{-- EMAIL --}}
			<div class="field">
				<p class="control">
					<input class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" type="email" placeholder="email" value="{{ old('email') }}">
				</p>
				@if ($errors->has('email'))
					<p class="help is-danger">{{ $errors->first('email') }}</p>
				@endif
			</div>

			{{-- PASSWORD --}}
			<div class="field">
				<p class="control">
					<input class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" type="password" placeholder="password">
				</p>
				@if ($errors->has('password'))
					<p class="help is-danger">{{ $errors->first('password') }}</p>
				@endif
			</div>

			{{-- SUBMIT BUTTON --}}
			<div class="field">
				<p class="control">
					<button class="button is-warning">
						login
					</button>
				</p>
			</div>

		</div>
	</form>

@endsection
