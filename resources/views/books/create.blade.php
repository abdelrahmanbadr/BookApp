<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('books.create') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 required col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" placeholder="Book Title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Author" class="col-md-4 required col-form-label text-md-right">{{ __('Author') }}</label>

                            <div class="col-md-6">
                                <input id="Author" type="text" placeholder="Author Name" class="form-control{{ $errors->has('authorName') ? ' is-invalid' : '' }}" name="authorName" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('authorName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('authorName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>