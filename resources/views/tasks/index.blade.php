<!DOCTYPE html>
<html>
<head>
    <title>Task Management</title>
    @livewireStyles
    <link rel="stylesheet" href="{{  asset('css/bootstrap.min.css') }} " />

</head>
<body>
    <div class="container">

        <form method="{{ $mode_is_edit ? 'POST' : 'POST'}}" action="{{ $mode_is_edit ? route('task-update', $task->id) : route('task-store') }}">
            @if(false && $mode_is_edit) @method('PUT') @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Task name</label>
                    <input name="name" type="name" class="form-control" id="name" value="{{ old('name', isset($task->name) ? $task->name : null) }}" aria-describedby="nameHelp" placeholder="Enter task name">
                </div>
                <div class="form-group col-md-2">
                    <label for="priority">Priority</label>
                    <input name="priority" type="number" class="form-control" id="priority" value="{{ old('priority', isset($task->priority) ? $task->priority : null) }}" aria-describedby="priorityHelp" placeholder="Priority">
                </div>
                <button type="submit" class="btn btn-primary"> {{ $mode_is_edit ? 'Edit' : 'Add'}}</button>
            </div>
        </form>


        <h1>All tasks</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        <div class="row bg-primary text-white p-2">
            <div class="col-md-1">ID</div>
            <div class="col-md-4">Name</div>
            <div class="col-md-2">Priority</div>
            <div class="col-md-3">Date</div>
            <div class="col-md-2">Action</div>
        </div>

        @include('tasks.task-order')
    </div>

</body>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js" defer></script>
</html>
