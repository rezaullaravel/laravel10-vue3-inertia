<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <div class="container all">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h4>User Login
                            <a href="{{ route('home') }}" class="btn btn-info " style="float: right;">Home</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        @if (session('message'))
                        <div  class="alert alert-danger">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                        @endif

                        <form action="{{ route('user.post.login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                              <label for="">Email <span class="text-danger">*</span></label>
                              <input  name="email" type="email" class="form-control">
                              @error('email')
                              <span class="text-danger">{{ $message }}</span>
                           @enderror

                            </div>

                            <div class="form-group">
                                <label for="">Password<span class="text-danger">*</span></label>
                                <input name="password"  type="password" class="form-control" >

                                @error('password')
                                   <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-info" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>




<style>
.all{
    background-color: #e5e3e97d;
    padding:13rem 0rem;
    margin-top: 7px;

}

</style>

