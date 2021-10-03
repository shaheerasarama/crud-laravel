@extends('web.layout')

@section('main')
        
    <main role="main" class="flex-shrink-0">
        <div class="container">
            @include('web.inc.message')
            <h1>Create New User</h1>
            <form action="{{url('storestudent')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                   
                </div>

                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="email" class="form-control" id="name" name="email" placeholder="Enter email">
                    
                </div>

                <div class="form-group">
                    <label for="name">Img</label>
                    <input type="file" class="form-control" id="name" name="img" >
                    
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </main>
      
@endsection
  