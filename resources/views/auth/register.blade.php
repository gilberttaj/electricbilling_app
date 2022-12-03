<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row" style="margin-top:45px">
            <div class="col-md-4 offset-md-4">
            <h4>User Register</h4>
            <hr>
                <form action="{{ route('auth.create') }}" method="post">
                @csrf
                <div class="results">
                    @if(Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                    @endif

                </div>
                    <div class="form-group my-2">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter full name" value={{ old('name') }}>
                        <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group my-2">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email" value={{ old('email') }}>
                        <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group my-2">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                        <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group my-3">
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </div>

                    <div><a href="login">I already have an account!</a></div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
