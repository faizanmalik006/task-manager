@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Tasks</h1>
                <form action="{{ route('tasks.index') }}" method="GET">
                    <select name="project_id" onchange="this.form.submit()">
                        <option value="">All Projects</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}"
                                {{ request()->input('project_id') == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
                <ul id="sortable">
                    @foreach ($tasks as $task)
                        <li id="{{ $task->id }}">{{ $task->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection


<script>
    new Sortable(document.getElementById('sortable'), {
        animation: 150,
        onEnd: function(evt) {
            var taskIds = [];
            $('#sortable li').each(function() {
                taskIds.push($(this).attr('id'));
            });
            $.ajax({
                url: '{{ route('tasks.reorder') }}',
                type: 'POST',
                data: {
                    taskIds: taskIds
                },
                success: function(response) {
                    // Handle success
                },
                error: function(xhr) {
                    // Handle error
                }
            });
        }
    });
</script>
