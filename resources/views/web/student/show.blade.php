@extends('web.layout')

@section('title') 
<title>list of students</title>
@endsection
@section('main')
<main role="main" class="flex-shrink-0">
        <div class="container">
            <h1>List of User</h1>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Img</th>
                    <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$student->name}}</td>
                    <td>{{$student->email}}</td>
                    <td><img src="{{asset("uploads/$student->img")}}" width="150px" alt=""></td>
                    <td>
                        
                        <a href="{{url("edit/$student->id")}}"><button class="btn btn-primary btn-sm">Edit</button></a>
                        <a href="{{url("delete/$student->id")}}"><button class="btn btn-danger btn-sm">delete</button></a>
                        
                    </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </main>
      
@endsection
  