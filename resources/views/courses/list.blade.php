<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course CRUD Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class='bg-dark text-white py-2 text-center'>
        <h2>Course CRUD</h2>
    </div>

    <div class="container">
        <div class="row d-flex justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('courses.create')}}" class="btn btn-info fw-bold px-3"><i class="fa-solid fa-plus"></i> Add Course</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
            <div class="col-md-10 mt-4">
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            </div>
            @endif
            <div class="col-md-10">
                <div class="card shadow-lg my-3">
                    <div class="card-header text-center bg-dark text-white">
                        <h4>Courses</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-secondary table-striped  align-middle">
                                <thead>
                                    <tr>
                                        {{-- <th>ID</th> --}}
                                        <th>Images</th>
                                        <th>Course Name</th>
                                        <th>Course Description</th>
                                        <th>Created At</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @if ($courses->isNotEmpty())
                                    @foreach ($courses as $course)
                                    <tr>
                                        {{-- <td>{{ $course->id }}</td> --}}

                                        <td>
                                            @if ($course->image != "")
                                                <img width="50" src="{{ asset('uploads/courses/'.$course->image)}}" alt="">
                                            @endif
                                        </td>

                                        <td>{{ $course->name }}</td>
                                        
                                        <td>{{ $course->description }}</td>

                                        <td>{{ \Carbon\Carbon::parse($course->created_at)->format('d M Y') }}</td>

                                        <td>
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <a href="{{ route('courses.edit', $course->id)}}" class="btn btn-dark px-4 d-flex align-items-center justify-content-center gap-1"><span><i class="fa-solid fa-pen"></i></span><span>Edit</span></a>
                                                <a href="#" onclick="deleteCourse({{ $course->id }});" class="btn btn-danger d-flex align-items-center justify-content-center gap-1"><span><i class="fa-solid fa-trash-can"></i></span><span>Delete</span></a>
                                            </div>
                                            <form id="delete-course-form-{{ $course->id }}" action="{{ route('courses.destroy', $course->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>


<script>
    function deleteCourse(id) {
        if (confirm("Are you sure you want to delete this course?")) {
            document.getElementById('delete-course-form-' + id).submit();
        }
    }
</script>