<ul wire:sortable="updateTaskOrder">
    @foreach($tasks as $key => $value)
        <li class="row" wire:sortable.item="{{ $value->id }}" wire:key="task-{{ $value->id }}">

            <div class="col-md-1" style="z-index: 99999; cursor: move;"><h5 wire:sortable.handle>#{{ $value->id }}</h5></div>
            <div class="col-md-4">{{ $value->name }}</div>
            <div class="col-md-2">{{ $value->priority }}</div>
            <div class="col-md-3">{{ $value->created_at }}</div>
            <div class="col-md-2">
                <form action="{{ route('task-delete', $value->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="d-inline btn btn-outline-danger ">Delete</button>
                </form>
                    <a class="d-inline btn btn-small btn-info " href="{{ route('task-edit', $value->id )  }}">Edit</a>
            </div>
        </li>
        <hr />
    @endforeach
</ul>
