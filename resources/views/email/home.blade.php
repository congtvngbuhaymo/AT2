<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Send Email</title>

    <style type="text/css">
        .panel {
            width: 500px;
            margin: 0 auto;
            border: 1px solid #7fbb7a;
            margin-top: 10px;
            padding-top: 15px;
            border-radius: 5px;
        }
    </style>

  </head>

  <body class="">
    <nav class="navbar navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="#">
            <img src="/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24">
          </a>
        </div>
      </nav>

    <div class="container panel">
        <h3 align="center">Sending an Email </h3><br />
        @if ($message = Session::get('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
            </svg>
            <div>
                <i class="fa fa-check"></i>&nbsp;<strong>{{ $message }}</strong>
            </div>
        </div>
        @endif
    <form method="post" action="{{ route('sendmail.send') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror" value="{{ old('fullname') }}" />
            @error('fullname')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" />
            @error('email')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Leave Message</label>
            <textarea name="message" class="form-control @error('message') is-invalid @enderror" alue="{{ old('message') }}"></textarea>
            @error('message')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group mt-3 mb-3">
            <input type="submit" name="submit" class="btn btn-primary w-100" value="submit" />
        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</div>
  </body>
</html>
