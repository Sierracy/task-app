
@props(['tasks'])

@if ($tasks->count())
    <div class="overflow-x-auto mt-6">
        <table class="table-auto border-collapse w-full">
            <thead>
                <tr class="font-medium text-gray-700 text-left bg-gray-200">
                    <th class="px-4 py-2">Assigned</th>
                    <th class="px-4 py-2">Task</th>
                    <th class="px-4 py-2">Due</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Priority</th>
                    <th class="px-4 py-2">Created</th>
                    <th class="px-4 py-2"></th>                          
                    <th class="px-4 py-2">Updated</th>
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr class="border-b border-gray-200 py-10 text-sm">
                        <td class="px-4 py-2">{{ $task->assigned_to }}</td>
                        <td class="px-4 py-2">{{ $task->description }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $task->due_date)->format('F j, Y ') }}</td>
                        <td class="px-4 py-2">{{ $task->status }}</td>
                        <td class="px-4 py-2">{{ $task->priority }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">{{ $task->created_at->format('g:i a') }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">{{ $task->created_at->format('F j, Y') }}</td>
                        
                        @if ( !$task->updated_at->equalTo($task->created_at) )
                        <td class="px-4 py-2 whitespace-nowrap">{{ $task->updated_at->format('g:i a') }}</td>
                        <td class="px-4 py-2 whitespace-nowrap">{{ $task->updated_at->format('F j, Y') }}</td>

                        @else
                        <td class="px-4 py-2 text-center">-</td>
                        <td class="px-4 py-2 text-center">-</td>
                        @endif

                        <td class="px-4 py-2">
                            <form action="{{ route('task.destroy', $task->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="underline">Delete</button>
                            </form>
                        </td>
                        <td class="px-4 py-4"><a href="{{ route('edit', $task) }}" class="underline">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$tasks->links()}}
    </div>
@else
    <p>There are no tasks.</p>
@endif
