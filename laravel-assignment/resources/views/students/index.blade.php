<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
</head>
<body>
    <h1>Student List</h1>

    <div style="display: flex; flex-wrap: wrap;">
        @foreach ($students as $student)
            <x-student-card :student="$student" />
        @endforeach
    </div>
</body>
</html>
